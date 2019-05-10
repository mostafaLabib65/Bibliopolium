CREATE schema BookStore;
set foreign_key_checks =0;
drop index fk_BOOK_AUTHOR_idx on books;

alter table books drop foreign key fk_books_authors;

alter table books drop column author_id;

use BookStore;
create table authors
(
    id int auto_increment
        primary key,
    name varchar(45) not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    constraint authors_name_uindex
        unique (name)
);

create table authors_books
(
    book_id int,
    author_id int,
    primary key (book_id, author_id),
    constraint fk_book_authors_book foreign key (book_id) references books(id),
    constraint fk_book_authors_authors foreign key (author_id) references authors(id)
);

create table books
(
    id int auto_increment
        primary key,
    title varchar(45) not null,
    author_id int not null,
    price float not null,
    category varchar(20) not null,
    threshold int default 5 not null,
    no_of_copies int default 0 not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    constraint fk_books_authors
        foreign key (author_id) references authors (id)
);

create table active_orders
(
    id int auto_increment
        primary key,
    book_id int not null,
    quantity int not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    constraint fk_active_orders_books
        foreign key (book_id) references books (id)
);

create index fk_ACTIVE_ORDER_BOOK_idx
    on active_orders (book_id);

create index fk_BOOK_AUTHOR_idx
    on books (author_id);

create table history_orders
(
    id int not null
        primary key,
    book_id int not null,
    quantity int not null,
    order_created_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    status varchar(20) default 'confirmed' not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    constraint fk_history_orders_books
        foreign key (book_id) references books (id)
);

create index fk_ACTIVE_ORDER_BOOK_idx
    on history_orders (book_id);

create table migrations
(
    id int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch int not null
)
    collate=utf8mb4_unicode_ci;

create table password_resets
(
    email varchar(255) not null,
    token varchar(255) not null,
    created_at timestamp null
)
    collate=utf8mb4_unicode_ci;

create index password_resets_email_index
    on password_resets (email);

create table permissions
(
    id int unsigned auto_increment
        primary key,
    name varchar(255) not null,
    guard_name varchar(255) not null,
    created_at timestamp null,
    updated_at timestamp null
)
    collate=utf8mb4_unicode_ci;

create table model_has_permissions
(
    permission_id int unsigned not null,
    model_type varchar(255) not null,
    model_id bigint unsigned not null,
    primary key (permission_id, model_id, model_type),
    constraint model_has_permissions_permission_id_foreign
        foreign key (permission_id) references permissions (id)
            on delete cascade
)
    collate=utf8mb4_unicode_ci;

create index model_has_permissions_model_id_model_type_index
    on model_has_permissions (model_id, model_type);

create table publishers
(
    id int auto_increment
        primary key,
    name varchar(45) not null,
    address varchar(100) not null,
    phone_number varchar(20) not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    constraint Address_UNIQUE
        unique (address),
    constraint Phone_number_UNIQUE
        unique (phone_number),
    constraint publishers_name_uindex
        unique (name)
);

create table book_editions
(
    book_id int not null,
    edition int not null,
    publisher_id int not null,
    publishing_year int(4) null,
    no_of_copies int default 0 not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    primary key (book_id, edition),
    constraint fk_book_editions_books
        foreign key (book_id) references books (id),
    constraint fk_book_editions_publishers
        foreign key (publisher_id) references publishers (id)
);

create index fk_BOOK_EDITION_PUBLISHER_idx
    on book_editions (publisher_id);

create table book_isbns
(
    book_id int not null,
    publisher_id int not null,
    isbn varchar(20) not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    primary key (book_id, publisher_id),
    constraint book_isbns_isbn_uindex
        unique (isbn),
    constraint fk_book_isbns_books
        foreign key (book_id) references books (id),
    constraint fk_book_isbns_publishers
        foreign key (publisher_id) references publishers (id)
);

create index fk_BOOK_ISBN_PUBLISHER_idx
    on book_isbns (publisher_id);

create table role_credentials
(
    id tinyint not null
        primary key,
    role_name varchar(50) null,
    user_name varchar(50) not null,
    decrypted_password varchar(50) not null
);

create table roles
(
    id int unsigned auto_increment
        primary key,
    name varchar(255) not null,
    guard_name varchar(255) not null,
    role_credential_id tinyint null,
    created_at timestamp null,
    updated_at timestamp null,
    constraint roles_role_credentials_id_fk
        foreign key (role_credential_id) references role_credentials (id)
)
    collate=utf8mb4_unicode_ci;

create table model_has_roles
(
    role_id int unsigned not null,
    model_type varchar(255) not null,
    model_id bigint unsigned not null,
    primary key (role_id, model_id, model_type),
    constraint model_has_roles_role_id_foreign
        foreign key (role_id) references roles (id)
            on delete cascade
)
    collate=utf8mb4_unicode_ci;

create index model_has_roles_model_id_model_type_index
    on model_has_roles (model_id, model_type);

create table role_has_permissions
(
    permission_id int unsigned not null,
    role_id int unsigned not null,
    primary key (permission_id, role_id),
    constraint role_has_permissions_permission_id_foreign
        foreign key (permission_id) references permissions (id)
            on delete cascade,
    constraint role_has_permissions_role_id_foreign
        foreign key (role_id) references roles (id)
            on delete cascade
)
    collate=utf8mb4_unicode_ci;

create index roles_role_credential_id_index
    on roles (role_credential_id);

create table schema_migrations
(
    version varchar(255) not null
        primary key
);

create table statistics
(
    book_id int not null
        primary key,
    sold_copies int not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    constraint fk_statistics_books
        foreign key (book_id) references books (id)
);

create table users
(
    id bigint auto_increment
        primary key,
    user_name varchar(100) default 'john doe' not null,
    email varchar(100) not null,
    first_name varchar(100) null,
    last_name varchar(100) null,
    shipping_address varchar(100) null,
    phone_number varchar(20) null,
    spent_money float default 0 not null,
    password varchar(255) default '' not null,
    reset_password_token varchar(255) null,
    reset_password_sent_at datetime null,
    remember_created_at datetime null,
    created_at datetime not null,
    updated_at datetime not null,
    role tinyint default 0 not null,
    email_verified_at timestamp null,
    remember_token varchar(100) null,
    constraint index_users_on_email
        unique (email),
    constraint index_users_on_reset_password_token
        unique (reset_password_token),
    constraint users_role_credentials_id_fk
        foreign key (role) references role_credentials (id)
);

create table active_carts
(
    id int auto_increment
        primary key,
    user_id bigint not null,
    no_of_items int not null,
    status varchar(20) default 'active' not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    constraint active_carts_users_id_fk
        foreign key (user_id) references users (id)
);

create index fk_ACTIVE_CARTS_USER_idx
    on active_carts (user_id);

create table items
(
    cart_id int not null,
    book_id int not null,
    edition int not null,
    quantity int not null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    primary key (cart_id, book_id, edition),
    constraint Book_id_UNIQUE
        unique (book_id, cart_id, edition),
    constraint items_active_carts_cart_id_fk
        foreign key (cart_id) references active_carts (id)
            on update cascade on delete cascade,
    constraint items_book_editions_book_id_edition_fk
        foreign key (book_id, edition) references book_editions (book_id, edition)
            on update cascade
);

create table purchase_histories
(
    id int auto_increment
        primary key,
    user_id bigint not null,
    no_of_items int not null,
    total_price float not null,
    status varchar(20) default 'discarded' not null,
    cart_created_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    cart_updated_at timestamp null,
    created_at timestamp default CURRENT_TIMESTAMP not null,
    updated_at timestamp null,
    constraint purchase_histories_users_id_fk
        foreign key (user_id) references users (id)
);

create table purchase_items_histories
(
    purchase_history_id int not null,
    book_id int not null,
    edition_id int not null,
    quantity int not null,
    purchase_item_created_at timestamp default CURRENT_TIMESTAMP not null on update CURRENT_TIMESTAMP,
    purchase_item_updated_at timestamp null,
    created_at timestamp default CURRENT_TIMESTAMP null,
    updated_at timestamp null,
    primary key (book_id, purchase_history_id, edition_id),
    constraint purchase_items_histories_book_editions_book_id_edition_fk
        foreign key (book_id, edition_id) references book_editions (book_id, edition),
    constraint purchase_items_histories_purchase_histories_id_fk
        foreign key (purchase_history_id) references purchase_histories (id)
);

create index purchase_items_histories_book_id_edition_id_index
    on purchase_items_histories (book_id, edition_id);

create index purchase_items_histories_purchase_history_id_index
    on purchase_items_histories (purchase_history_id);


#-----------------------------------publisher table---------------------------------------------------------------------
CREATE PROCEDURE add_new_publisher(in publisher_name varchar(45), in address varchar(100), in phone varchar(20))
begin
    insert into publishers (name, address, phone_number) values (publisher_name, address, phone);
end;


CREATE procedure index_publishers()
begin
    select * from publishers;
end;


create procedure get_publisher(in id int)
begin
    select * from publishers where publishers.id = id;
end;

create procedure update_publisher(in id int, in name varchar(45), in address varchar(100), in phone_number varchar(20))
begin
    update publishers set publishers.name = name, publishers.address = address, publishers.phone_number = phone_number  where publishers.id = id;
end;

create procedure delete_publisher(in id int)
begin
    delete from publishers where publishers.id = id;
end;


#------------------------------------------Author table-------------------------------------------------------------
create procedure add_new_author(in author_name varchar(45))
begin
    insert into authors (name) values (author_name);
end;

create procedure update_author(in id int, in new_name varchar(45))
begin
    update authors set name = new_name where authors.id = id;
end;

create procedure get_author(in id int)
begin
    select * from authors where authors.id = id;
end;

create procedure delete_author(in id int)
begin
    delete from authors where authors.id = id;
end;

create procedure index_authors()
begin
    select * from authors;
end;

#-----------------------------------books table------------------------------------------------------
CREATE procedure add_new_book( in title varchar(45), in author_id int,
                               in price float, in category varchar(20), in threshold int, in no_of_copies int,
                               in publisher_id int, in publishing_year int, in edition int, in isbn int)

begin
    DECLARE book_id int;

    insert into books (title,  price, category, threshold, no_of_copies, created_at) values (title,  price, category, threshold, 0, NOW());
    select LAST_INSERT_ID() into book_id;
    insert into book_editions(book_id, edition, publisher_id, publishing_year, no_of_copies, created_at) values (book_id, edition, publisher_id,publishing_year , no_of_copies, NOW());
    insert into book_isbns(book_id, publisher_id, isbn,created_at) values (book_id, publisher_id, isbn, NOW());
    select book_id;
end;

create procedure index_books()
begin
    select books.id,books.title, books.price, books.category, books.threshold, books.no_of_copies from books;
end;


create procedure get_book(in id int)
begin
    select * from books where books.id = id;
end;


create procedure update_book(in book_id int,in title varchar(45), in price float, in category varchar(20), in threshold int, in no_of_copies int)
begin
    update books set title = title,  price = price, category = category, threshold = threshold, no_of_copies = no_of_copies,
                     updated_at = NOW() where books.id = book_id;
end;

create procedure delete_book(in book int)
begin
    delete from books where id = book;
end;




create trigger request_an_order after update on books for each row
begin
    if NEW.no_of_copies < NEW.threshold then
        if not exists(select book_id from active_orders where active_orders.book_id = NEW.id) then
            insert into active_orders(book_id, quantity, created_at) values (NEW.id, 2*(select threshold from books where books.id = NEW.id), now());
        end if;
    end if;
end;


create trigger discard_order after update on books for each row
begin
    declare order_id int;
    declare book_id int;
    declare quantity int;
    declare order_timestamp datetime;
    select active_orders.id, active_orders.book_id, active_orders.quantity, active_orders.created_at from active_orders where active_orders.book_id = OLD.id into order_id, book_id, quantity, order_timestamp;
    if NEW.threshold < NEW.no_of_copies then
        if  exists(select book_id from active_orders where active_orders.book_id = OLD.id) then
            insert into history_orders(id, book_id, quantity, order_created_at, status, created_at) values (order_id, book_id, quantity, order_timestamp,'Discard' , NOW());
        end if;
    end if;
end;

#---------------------------------------------book edition table-------------------------------------------------------------------------------
create procedure add_new_edition(in book_id int, in publisher_id int, in publishing_year int, in no_of_copies int, in edition int)
begin
    insert into book_editions(book_id, edition, publisher_id, publishing_year, no_of_copies, created_at) values (book_id, edition, publisher_id,publishing_year, no_of_copies, now());
end;


create procedure index_book_editions()
begin
    select  book_editions.publisher_id, book_editions.book_id,books.title ,publishers.name, book_editions.edition, book_editions.publishing_year, book_editions.no_of_copies
    from book_editions, publishers, books where book_editions.publisher_id = publishers.id and books.id = book_editions.book_id;
end;

create procedure get_book_edition(in book_id int, in edition int)
begin
    select  book_editions.publisher_id, book_editions.book_id,books.title ,publishers.name, book_editions.edition, book_editions.publishing_year, book_editions.no_of_copies
    from book_editions, publishers, books where book_editions.publisher_id = publishers.id and books.id = book_id and book_editions.edition = edition;
end;


create procedure update_book_edition(in book_id int,in old_edition int ,in new_edition int, in publisher_id int,in publishing_year int ,in no_of_copies int)
begin
    update book_editions set book_editions.edition = new_edition, book_editions.publisher_id = publisher_id,
                             book_editions.publishing_year = publishing_year, book_editions.no_of_copies = no_of_copies
    where book_editions.edition = old_edition and book_editions.book_id = book_id;
end;



create procedure delete_book_edition(in book_id int, in edition int)
begin
    delete from book_editions where book_editions.book_id = book_id and book_editions.edition = edition;
end;

create trigger increase_no_of_copies after insert on book_editions for each row #done
begin
    update books set no_of_copies = (no_of_copies + NEW.no_of_copies) where books.id = NEW.book_id;
end;

create trigger update_no_of_copies after update on book_editions for each row
begin
    update books set no_of_copies = (no_of_copies + NEW.no_of_copies - OLD.no_of_copies)  where books.id = NEW.book_id;
end;

create trigger check_negative
    before UPDATE on book_editions
    for each row
begin
    declare book_name varchar(45);
    select books.title from books where books.id = OLD.book_id into book_name;
    if NEW.no_of_copies < 0 then
        set @message = concat('MSG Book: ', book_name, ' edition: ', NEW.edition, ' available copies: ', OLD.no_of_copies);
        SIGNAL SQLSTATE '42000' SET MESSAGE_TEXT = @message;
    end if;
end;

create trigger decrease_no_of_copies after delete on book_editions for each row
begin
    update books set no_of_copies = (books.no_of_copies - OLD.no_of_copies)  where books.id = OLD.book_id;
end;

create trigger delete_book_isbn after delete on book_editions for each row
begin
    delete from book_isbns where book_isbns.book_id = OLD.book_id and book_isbns.publisher_id = OLD.publisher_id;
end;

create trigger update_book_isbns_publisher_id after update on book_editions for each row
begin
    update book_isbns set publisher_id = NEW.publisher_id where book_isbns.book_id = OLD.book_id and book_isbns.publisher_id = OLD.publisher_id;
end;
#------------------------------------------------------book_isbns-----------------------------------------------------------------
create procedure add_new_isbn(in book_id int, in publisher_id int, in isbn int)
begin
    insert into book_isbns(book_id, publisher_id, isbn, created_at) values (book_id, publisher_id, isbn, now());
end;


CREATE procedure index_book_isbns()
begin
    select book_isbns.book_id, books.title, book_isbns.publisher_id,publishers.name, book_isbns.isbn from books, publishers, book_isbns where books.id = book_isbns.book_id and book_isbns.publisher_id = publishers.id;
end;

create procedure get_isbn(in book_id int, in publisher_id int)
begin
    select book_isbns.book_id, books.title, book_isbns.publisher_id,publishers.name, book_isbns.isbn from books, publishers, book_isbns
    where books.id = book_isbns.book_id and book_isbns.publisher_id = publishers.id and book_isbns.book_id = book_id and book_isbns.publisher_id = publisher_id;

end;

CREATE PROCEDURE update_isbn(in book_id int, in publisher_id int, in isbn int)
begin
    update book_isbns set book_isbns.isbn = isbn where book_isbns.publisher_id = publisher_id and book_isbns.book_id = book_id;
end;

create procedure delete_isbn(in book_id int, in publisher_id int)
begin
    delete from book_isbns where book_isbns.book_id = book_id and book_isbns.publisher_id = publisher_id;
end;


#---------------------------------------------------------active orders-------------------------------------------------
create procedure index_active_orders()
begin
    select * from active_orders;
end;


create procedure add_new_order(in book_id int, in quantity int)
begin
    insert into active_orders(book_id, quantity, created_at) values (book_id, quantity, now());
end;


create procedure get_active_order(in id int)
begin
    select * from active_orders where active_orders.id = id;
end;

create procedure delete_from_active_order(in id int, in status varchar(20))
begin
    declare order_id int;
    declare book_id int;
    declare quantity int;
    declare order_timestamp datetime;
    declare max_edition int;
    select active_orders.id, active_orders.book_id, active_orders.quantity, created_at
    from active_orders where active_orders.id =  id into order_id, book_id, quantity, order_timestamp;
    insert into history_orders(id, book_id, quantity, order_created_at, status, created_at) values (id, book_id, quantity, order_timestamp,status , NOW());
    select max(edition) from book_editions where book_editions.book_id = book_id into max_edition;
    if status = 'Successful' then
        update book_editions set book_editions.no_of_copies = book_editions.no_of_copies + quantity where
                book_editions.book_id = book_id and book_editions.edition = max_edition;
    end if;
end;

#---------------------------------------------------------- history orders---------------------------------------------
create procedure index_history_orders()
begin
    select * from history_orders;
end;

create trigger delete_acrive_order after insert on history_orders for each row
begin
    delete from active_orders where active_orders.id = NEW.id;
end;

#---------------------------------------------------statistics-------------------------------------------------------------------

create procedure top_selling_books()
begin
    select book_id, title, sold_copies from statistics, books where statistics.book_id = books.id order by sold_copies desc limit 10;
end;


create procedure top_customers()
begin
    select first_name, last_name, spent_money from users order by spent_money desc limit 5;
end;


create procedure total_sales()
begin
    select purchase_items_histories.book_id as id ,sum(purchase_items_histories.quantity) * books.price as total_price from purchase_items_histories, books
    where purchase_items_histories.book_id = books.id
      and purchase_items_histories.created_at >= DATE_SUB((select max(purchase_items_histories.created_at) from  purchase_items_histories), INTERVAL 1 MONTH)
    group by purchase_items_histories.book_id;
end;

#-----------------------------------------------------Book authors--------------------------------------------------------------------------
create procedure add_new_book_author(in book_id int, in author_id int)
begin
    insert into authors_books values (book_id, author_id);
end;

create procedure index_book_authors()
begin
    select authors_books.book_id as book_id, books.title as title, authors.name as name, authors_books.author_id as author_id
    from authors_books, books, authors
    where authors_books.book_id = books.id and authors_books.author_id = authors.id;
end;

create procedure get_book_author(in book_id int, in author_id int)
begin
    select authors_books.book_id as book_id, books.title as title, authors.name as name, authors_books.author_id as author_id
    from authors_books, books, authors
    where authors_books.author_id = author_id and  authors_books.book_id = book_id and authors_books.book_id = books.id and authors_books.author_id = authors.id;
end;

create procedure delete_author_book(in book_id int, in author_id int)
begin
    delete from authors_books where authors_books.book_id = book_id and  authors_books.author_id = author_id;
end;

create procedure get_book_authors(in book_id int)
begin
    select authors.name from authors, authors_books where authors_books.book_id = book_id and authors_books.author_id = authors.id;
end;


#---------------------------------------------------------------user_operations-----------------------------------------------------------------------------


create definer = root@localhost trigger update_cart_count_after_deletion
    after DELETE on items
    for each row
BEGIN
    CALL update_cart_count(OLD.cart_id, -OLD.quantity);
end;

create definer = root@localhost trigger update_cart_count_after_insert
    after INSERT on items
    for each row
BEGIN
    CALL update_cart_count(NEW.cart_id, New.quantity);
end;

create definer = root@localhost trigger update_cart_count_after_update
    after UPDATE on items
    for each row
BEGIN
    IF NEW.quantity != OLD.quantity THEN
        CALL update_cart_count(NEW.cart_id, -OLD.quantity + NEW.quantity);
    end if;
end;


create definer = root@localhost trigger update_statistics
    after INSERT on purchase_items_histories
    for each row
BEGIN
    INSERT into statistics(book_id, sold_copies, updated_at)
    VALUES (NEW.book_id, sold_copies + NEW.quantity, CURRENT_TIMESTAMP)
    ON DUPLICATE key update sold_copies = NEW.quantity + sold_copies, updated_at =CURRENT_TIMESTAMP;
end;

create definer = root@localhost procedure CREATE_USER(IN user_name_x varchar(100), IN email_x varchar(100),
                                                      IN first_name_x varchar(100), IN last_name_x varchar(100),
                                                      IN shipping_address_x varchar(100), IN phone_number_x varchar(100),
                                                      IN passwd_x varchar(255), IN role_x tinyint)
BEGIN
    DECLARE user_id bigint(20);
    DECLARE role_id int(11);

    INSERT into users(user_name, email, first_name, last_name, shipping_address, phone_number, password)
    VALUES (user_name_x, email_x, first_name_x, last_name_x, shipping_address_x, phone_number_x, passwd_x);

    SELECT LAST_INSERT_ID() into user_id;
    Select id from roles where roles.name = "customer" limit 1 into role_id;

    INSERT into model_has_roles VALUES (role_id,"App\\User",user_id);

    SELECT * from users where id = user_id;
end;


create definer = root@localhost procedure Login(IN email_x varchar(100), IN passwd_x varchar(100))
BEGIN
    DECLARE EXIT HANDLER FOR NOT FOUND
        BEGIN

        end;

    SELECT rc.user_name, rc.decrypted_password
    from users
             inner join model_has_roles on users.id = model_has_roles.model_id
             inner join roles on model_has_roles.role_id = roles.id
             inner join role_credentials rc on roles.role_credential_id = rc.id
    where email = email_x
    ORDER BY roles.id
    limit 1;

end;

create definer = root@localhost procedure UPDATE_USER(IN id_x bigint, IN user_name_x varchar(100), IN email_x varchar(100),
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
        password = COALESCE(passwd_x, password)
    where users.id = id_x;

    Select * from users where id = id_x;
end;

create definer = root@localhost procedure add_item(IN user_id_x bigint, IN book_id_x int, IN edition_x int, IN quantity_x int)
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

create definer = root@localhost procedure checkout_cart(IN user_id_x bigint, IN credit_card_number varchar(32))
BEGIN

    DECLARE v_finished INTEGER DEFAULT 0;

    DECLARE cart_id_x int(11);
    DECLARE purchase_history_id_x int(11);
    DECLARE book_id_x int(11);
    DECLARE price_x int(11);
    DECLARE edition_x int(11);
    DECLARE quantity_x int(11);
    DECLARE total_price_x int(11) DEFAULT 0;
    DECLARE cur CURSOR for SELECT cart_id, book_id, edition, quantity, price
                           from items
                                    inner join active_carts ac on items.cart_id = ac.id
                                    inner join books on items.book_id = books.id
                           where ac.user_id = user_id_x;

    DECLARE cur_2 CURSOR for SELECT id
                             from purchase_histories
                             where user_id = user_id_x
                             ORDER BY created_at DESC
                             limit 1;
    -- declare NOT FOUND handler
    DECLARE CONTINUE
        HANDLER
        FOR NOT FOUND
        SET v_finished = 1;

    IF not luhn_check(credit_card_number) THEN
        signal SQLSTATE '45000'
            SET MESSAGE_TEXT = "Invalid credit card number";
    end if;


    START TRANSACTION
        ;
        OPEN CUR;


        INSERT into purchase_histories(user_id, no_of_items, total_price, status, cart_created_at, cart_updated_at)
        SELECT user_id, no_of_items, concat(0), concat("confirmed"), created_at, updated_at
        from active_carts
        where user_id = user_id_x;

        OPEN CUR_2;
        FETCH cur_2 into purchase_history_id_x;


        items_list :
            LOOP
                FETCH CUR into cart_id_x,book_id_x,edition_x,quantity_x,price_x;

                IF v_finished = 1 THEN
                    LEAVE items_list;
                END IF;


                UPDATE book_editions
                SET no_of_copies = no_of_copies - quantity_x
                where book_id = book_id_x
                  and edition = edition_x;

                SET total_price_x = total_price_x + quantity_x * price_x;

                INSERT INTO purchase_items_histories(purchase_history_id, book_id, edition_id, quantity)
                VALUES (purchase_history_id_x, book_id_x, edition_x, quantity_x);

                DELETE FROM items where cart_id = cart_id_x and book_id = book_id_x and edition = edition_x;

            END LOOP items_list;

        UPDATE purchase_histories SET total_price = total_price_x where id = purchase_history_id_x;
        UPDATE users set spent_money = spent_money + total_price_x where users.id = user_id_x;

        DELETE from active_carts where user_id = user_id_x;
    COMMIT;

end;

create definer = root@localhost function luhn(p_number varchar(31)) returns char
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

create definer = root@localhost function luhn_check(p_number varchar(32)) returns tinyint(1)
begin
    declare luhn_number varchar(32);

    set luhn_number = substring(p_number, 1, length(p_number) - 1);
    set luhn_number = concat(luhn_number, luhn(luhn_number));

    return luhn_number = p_number;
end;

create definer = root@localhost procedure remove_item(IN user_id bigint, IN book_id_x int, IN edition_x int)
BEGIN

    DECLARE user_name_x varchar(100);
    DECLARE cart_id_x int;
    DECLARE status_x varchar(20);
    DECLARE cur CURSOR FOR SELECT user_id, id, status from active_carts where user_id = user_id LIMIT 1;

    DECLARE EXIT HANDLER FOR NOT FOUND
        BEGIN
        END;

    OPEN cur;

    FETCH cur into user_name_x,cart_id_x,status_x;

    DELETE FROM items where cart_id = cart_id_x and book_id = book_id_x and edition = edition_x;
end;

create
    definer = root@localhost procedure search_books(IN title_s varchar(45), IN author varchar(45), IN price_low int,
                                                    IN price_high int, IN no_of_copies_low int, IN publisher varchar(45),
                                                    IN isbn_s varchar(20), IN category varchar(45))
BEGIN
    SELECT books.*, GROUP_CONCAT(a.name SEPARATOR ", ") as authors
    from books
             inner join book_isbns bi on books.id = bi.book_id
             inner join publishers p on bi.publisher_id = p.id
             inner join authors_books ab on books.id = ab.book_id
             inner join authors a on ab.author_id = a.id
    where title like concat("%", title_s, "%")
      and a.name like concat("%", author, "%")
      and price >= price_low
      and price <= price_high
      and no_of_copies >= no_of_copies_low
      and p.name like concat("%", publisher, "%")
      and bi.isbn like concat("%", isbn_s, "%")
      and books.category like concat("%", category, "%")
    GROUP BY books.id;
end;


create definer = root@localhost procedure update_cart_count(IN cart_id_x int, IN increase int)
BEGIN
    UPDATE active_carts set no_of_items = no_of_items + increase where id = cart_id_x;

end;
