use BookStore;


CREATE PROCEDURE UPDATE_USER(IN id_x bigint, IN user_name_x varchar(100), IN email_x varchar(100),
                             IN first_name_x varchar(100), IN last_name_x varchar(100),
                             IN shipping_address_x varchar(100), IN phone_number_x varchar(100),
                             IN passwd_x varchar(255), IN role_x tinyint)
BEGIN
  Update users
  set user_name = user_name_x ,
      email = email_x ,
      first_name = first_name_x ,
      last_name = last_name_x ,
      shipping_address = shipping_address_x ,
      phone_number = phone_number_x ,
      password = COALESCE(passwd_x, password) ,
      role = role_x
  where users.id = id_x;

  Select * from users where id = id_x;
end;



CREATE PROCEDURE index_carts()
BEGIN
  SELECT active_carts.*, concat(last_name, ", ", first_name) as user_name, SUM(items.quantity * books.price) as total_price
  from active_carts
         inner join users u on active_carts.user_id = u.id
         left join items on active_carts.id = items.cart_id
         left join books on items.book_id = books.id
  GROUP BY active_carts.id;
end;



CREATE PROCEDURE search_books(IN title_s varchar(45), IN author varchar(45), IN price_low int,
                              IN price_high int, IN no_of_copies_low int, IN publisher varchar(45),
                              IN isbn_s varchar(20), IN category varchar(45))
BEGIN
  SELECT *
  from books
         inner join book_isbns bi on books.id = bi.book_id
         inner join publishers p on bi.publisher_id = p.id
         inner join authors a on books.author_id = a.id
  where title like concat("%", title_s, "%")
    and a.name like concat("%", author, "%")
    and price >= price_low
    and price <= price_high
    and no_of_copies >= no_of_copies_low
    and p.name like concat("%", publisher, "%")
    and bi.isbn like concat("%", isbn_s, "%")
    and books.category like concat("%",category,"%");
end;


CREATE PROCEDURE add_item(IN user_id_x bigint, IN book_id_x int, IN edition_x int,
                          IN quantity_x int)
BEGIN

  DECLARE user_name_x varchar(100);
  DECLARE cart_id_x int;
  DECLARE status_x varchar(100);
  DECLARE cur CURSOR FOR SELECT user_id, id, status from active_carts where user_id = user_id_x LIMIT 1;


  DECLARE CONTINUE HANDLER FOR NOT FOUND
    BEGIN
      INSERT into active_carts(user_id, status, no_of_items) VALUES (user_id_x, 'active', 0);

      CLOSE cur;
      OPEN cur;
      FETCH cur into user_name_x,cart_id_x,status_x;

    end;

  OPEN cur;
  FETCH cur into user_name_x,cart_id_x,status_x;


  INSERT INTO items(cart_id, book_id, quantity, edition)
  VALUES (cart_id_x, book_id_x, quantity_x, edition_x)
  ON DUPLICATE KEY UPDATE quantity = quantity_x;

end;



CREATE PROCEDURE remove_item(user_id bigint(20), book_id_x int, edition_x int)
BEGIN

  DECLARE user_name_x varchar(100);
  DECLARE cart_id_x int;
  DECLARE status_x varchar(100);
  DECLARE cur CURSOR FOR SELECT user_id, id, status from active_carts where user_id = user_id LIMIT 1;

  DECLARE EXIT HANDLER FOR NOT FOUND
    BEGIN
    END;

  OPEN cur;

  FETCH cur into user_name_x,cart_id_x,status_x;

  DELETE FROM items where cart_id = cart_id_x and book_id = book_id_x and edition = edition_x;
end;


CREATE PROCEDURE update_cart_count(cart_id_x int, increase int)
BEGIN
  UPDATE active_carts set no_of_items = no_of_items + increase where id = cart_id_x;
end;


CREATE TRIGGER update_cart_count_after_insert
  AFTER INSERT
  ON items
  FOR EACH ROW
BEGIN
  CALL update_cart_count(NEW.cart_id, New.quantity);
end;


CREATE TRIGGER update_cart_count_after_deletion
  AFTER DELETE
  ON items
  FOR EACH ROW
BEGIN
  CALL update_cart_count(OLD.cart_id, -OLD.quantity);
end;

CREATE TRIGGER update_cart_count_after_update
  AFTER UPDATE
  ON items
  FOR EACH ROW
BEGIN
  IF NEW.quantity != OLD.quantity THEN
    CALL update_cart_count(NEW.cart_id, -OLD.quantity + NEW.quantity);
  end if;
end;
;




CREATE PROCEDURE view_cart(username_x varchar(100))
BEGIN
  SELECT * from items where cart_id in (SELECT cart_id from active_carts where user_id = username_x LIMIT 1);
end;


-- Function that calculates a Luhn (mod 10) check digit from a numeric string.
  -- The behavior is undefined if the string contains anything else than digits.
  -- Assumes that the string does not have a check digit added yet, so it starts
  -- with a weight of 2 at the last digit.
create function luhn(p_number varchar(31))
  returns char(1)
  sql security invoker
begin
  declare i, mysum, r, weight int;

  set weight = 2;
  set mysum = 0;
  set i = length(p_number);

  while i > 0 do
  set r = substring(p_number, i, 1) * weight;
  set mysum = mysum + if(r > 9, r - 9, r);
  set i = i - 1;
  set weight = 3 - weight;
  end while;

  return (10 - mysum % 10) % 10;
end;

-- Check if a numeric string has a valid check digit. Does this by cutting off
  -- the last digit, recalculating the Luhn check digit, and comparing the strings.
create function luhn_check(p_number varchar(32))
  returns boolean
  sql security invoker
begin
  declare luhn_number varchar(32);

  set luhn_number = substring(p_number, 1, length(p_number) - 1);
  set luhn_number = concat(luhn_number, luhn(luhn_number));

  return luhn_number = p_number;
end;

create
  definer = root@localhost procedure checkout_cart(IN user_id bigint, IN credit_card_number varchar(32))
BEGIN

  DECLARE v_finished INTEGER DEFAULT 0;

  DECLARE cart_id_x int(11);
  DECLARE book_id_x int(11);
  DECLARE edition_x int(11);
  DECLARE quantity_x int(11);
  DECLARE cur CURSOR for SELECT cart_id, book_id, edition, quantity from items;
  -- declare NOT FOUND handler
  DECLARE CONTINUE
    HANDLER
    FOR NOT FOUND
    SET v_finished = 1;

  IF not luhn_check(credit_card_number) THEN
    signal SQLSTATE '45000'
      SET MESSAGE_TEXT = "Invalid credit card number";
  end if;



  START TRANSACTION;
  OPEN CUR;
  items_list :
    LOOP
      FETCH CUR into cart_id_x,book_id_x,edition_x,quantity_x;
      UPDATE book_editions SET no_of_copies = no_of_copies - quantity_x where book_id = book_id_x and edition = edition_x;
    END LOOP items_list;
  COMMIT;

end;




CREATE USER 'customer'@'localhost' IDENTIFIED BY 'p@ssw0rd!';
CREATE USER 'manager'@'localhost' IDENTIFIED BY 'p@ssw0rd!';

CREATE PROCEDURE Login(email_x varchar(100), passwd_x varchar(100))
BEGIN
  DECLARE EXIT HANDLER FOR NOT FOUND
    BEGIN

    end;

  SELECT role_credentials.user_name, role_credentials.decrypted_password
  from users
         inner join role_credentials on users.role = role_credentials.role_id
  where email = email_x
    and password = passwd_x;

end;

CREATE PROCEDURE CREATE_USER(user_name_x varchar(100), email_x varchar(100), first_name_x varchar(100),
                             last_name_x varchar(100), shipping_address_x varchar(100), phone_number_x varchar(100),
                             passwd_x varchar(255), role_x tinyint(4))
BEGIN
  INSERT into users(user_name, email, first_name, last_name, shipping_address, phone_number, password,
                    role)
  VALUES (user_name_x, email_x, first_name_x, last_name_x, shipping_address_x, phone_number_x, passwd_x, role_x);
end;


CREATE PROCEDURE UPDATE_USER(id_x bigint(20), user_name_x varchar(100), email_x varchar(100), first_name_x varchar(100),
                             last_name_x varchar(100), shipping_address_x varchar(100), phone_number_x varchar(100),
                             passwd_x varchar(255), role_x tinyint(4))
BEGIN
  Update users
  set user_name = user_name_x and email = email_x
    and first_name = first_name_x
    and last_name = last_name_x and
                  shipping_address = shipping_address_x and
                  phone_number = phone_number_x and
                  password = passwd_x and
                  role = role_x
  where users.id = id_x;

  Select * from users where id = id_x;

end;


use BookStore;
SET FOREIGN_KEY_CHECKS = 0;
alter table active_carts
  modify cart_id int auto_increment;
SET FOREIGN_KEY_CHECKS = 1;