CREATE schema BookStore;

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
    insert into books (title, author_id, price, category, threshold, no_of_copies, created_at) values (title, author_id, price, category, threshold, 0, NOW());
    select max(id) from books into book_id;
    insert into book_editions(book_id, edition, publisher_id, publishing_year, no_of_copies, created_at) values (book_id, edition, publisher_id,publishing_year , no_of_copies, NOW());
    insert into book_isbns(book_id, publisher_id, isbn,created_at) values (book_id, publisher_id, isbn, NOW());
end;

create procedure index_books()
begin
    select books.id,books.title, authors.name, books.price, books.category, books.threshold, books.no_of_copies from books, authors where books.author_id = authors.id;
end;


create procedure get_book(in id int)
begin
    select * from books where books.id = id;
end;


create procedure update_book(in book_id int,in title varchar(45), in author_id int, in price float, in category varchar(20), in threshold int, in no_of_copies int)
begin
    update books set title = title, author_id = author_id, price = price, category = category, threshold = threshold, no_of_copies = no_of_copies,
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


call update_book_edition(10,1,1,1,2015,1);

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


create trigger decrease_no_of_copies after delete on book_editions for each row
begin
    update books set no_of_copies = (books.no_of_copies - OLD.no_of_copies)  where books.id = OLD.book_id;
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


create trigger delete_acrive_order after insert on history_orders for each row
begin
    delete from active_orders where active_orders.id = NEW.id;
end;

#---------------------------------------------------statistics-------------------------------------------------------------------

create procedure top_selling_books()
begin
    select book_id, title, sold_copies from statistics, books where statistics.book_id = books.id order by sold_copies desc limit 10;
    select first_name, last_name, spent_money from users order by spent_money desc limit 5;

end;


create procedure top_customers()
begin
    select first_name, last_name, spent_money from users order by spent_money desc limit 5;
end;
