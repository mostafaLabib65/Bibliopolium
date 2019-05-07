CREATE schema BookStore;

use BookStore;

create table authors
(
	auther_id int auto_increment
		primary key,
	name varchar(45) not null
);

create table books
(
	book_id int not null
		primary key,
	title varchar(45) not null,
	author_id int not null,
	price float not null,
	category varchar(20) not null,
	threshold int not null,
	no_of_copies int not null,
	constraint fk_books_authors
		foreign key (author_id) references authors (auther_id)
);

create table active_orders
(
	order_id int not null
		primary key,
	book_id int not null,
	quantity int not null,
	order_timestamp date not null,
	constraint fk_active_orders_books
		foreign key (book_id) references books (book_id)
);

create index fk_ACTIVE_ORDER_BOOK_idx
	on active_orders (book_id);

create index fk_BOOK_AUTHOR_idx
	on books (author_id);

create table history_orders
(
	order_id int not null
		primary key,
	book_id int not null,
	quantity int not null,
	order_timestamp date not null,
	status int not null,
	history_timestamp date not null,
	constraint fk_history_orders_books
		foreign key (book_id) references books (book_id)
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

create table publishers
(
	publisher_id int not null
		primary key,
	name varchar(45) not null,
	address varchar(100) not null,
	phone_number varchar(20) not null,
	constraint Address_UNIQUE
		unique (address),
	constraint Phone_number_UNIQUE
		unique (phone_number)
);

create table book_editions
(
	book_id int not null,
	edition int not null,
	publishing_year date not null,
	publisher_id int not null,
	no_of_copies int not null,
	primary key (book_id, edition),
	constraint fk_book_editions_books
		foreign key (book_id) references books (book_id),
	constraint fk_book_editions_publishers
		foreign key (publisher_id) references publishers (publisher_id)
);

create index fk_BOOK_EDITION_PUBLISHER_idx
	on book_editions (publisher_id);

create table book_isbns
(
	book_id int not null,
	publisher_id int not null,
	isbn int not null,
	primary key (book_id, publisher_id),
	constraint fk_book_isbns_books
		foreign key (book_id) references books (book_id),
	constraint fk_book_isbns_publishers
		foreign key (publisher_id) references publishers (publisher_id)
);

create index fk_BOOK_ISBN_PUBLISHER_idx
	on book_isbns (publisher_id);

create table role_credentials
(
	role_id tinyint not null
		primary key,
	role_name varchar(50) null,
	user_name varchar(50) not null,
	decrypted_password varchar(50) not null
);

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
	constraint fk_statistics_books
		foreign key (book_id) references books (book_id)
);

create table users
(
	id bigint null,
	user_name varchar(100) default 'john doe' not null
		primary key,
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
	constraint users_role_credentials_role_id_fk
		foreign key (role) references role_credentials (role_id)
);

create table active_carts
(
	user_name varchar(100) not null,
	cart_id int auto_increment
		primary key,
	timestamp date not null,
	status int not null,
	no_of_items int not null,
	constraint fk_active_carts_users
		foreign key (user_name) references users (user_name)
);

create index fk_ACTIVE_CARTS_USER_idx
	on active_carts (user_name);

create table items
(
	cart_id int not null,
	book_id int not null,
	quantity int not null,
	edition int not null,
	primary key (cart_id, book_id, edition),
	constraint Book_id_UNIQUE
		unique (book_id, cart_id, edition),
	constraint items_active_carts_cart_id_fk
		foreign key (cart_id) references active_carts (cart_id)
			on update cascade on delete cascade,
	constraint items_book_editions_book_id_edition_fk
		foreign key (book_id, edition) references book_editions (book_id, edition)
			on update cascade
);

create table purchase_histories
(
	user_name varchar(100) not null
		primary key,
	timestamp date not null,
	total_price float not null,
	constraint fk_PURCHASE_HISTORY_USER
		foreign key (user_name) references users (user_name)
);

