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

