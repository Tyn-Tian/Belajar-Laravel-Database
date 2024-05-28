create database belajar_laravel_database;

create table categories
(
	id varchar(100) not null primary key,
    name varchar(100) not null,
    description text,
    created_at timestamp
) engine InnoDB;

create table counters
(
	id varchar(100) not null primary key,
    counter int not null default 0
) engine InnoDB;

insert into counters (id, counter) values ('sample', 0);

select * from counters;

create table products
(
	id varchar(100) not null primary key,
    name varchar(100) not null,
    description text,
    price int not null,
    category_id varchar(100) not null,
    created_at timestamp,
    constraint fk_category_id foreign key (category_id) references categories (id)
) engine InnoDB;

drop table products;

drop table categories;

drop table counters;

show tables;

select * from migrations;