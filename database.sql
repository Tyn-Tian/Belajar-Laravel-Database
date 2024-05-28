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