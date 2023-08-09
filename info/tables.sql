create database inventory;
use inventory;
create table users(
id int primary key auto_increment,
first_name varchar(50),
last_name varchar(50),
password varchar(100),
email varchar(50),
created_at DateTime,
updated_at DateTime

);

create table products(
id int primary key auto_increment,
product_name varchar(50),

description varchar(50) ,
img varchar(50) ,
created_by varchar(50),
created_at DateTime,
updated_at DateTime

);


CREATE TABLE stocks(
    id INTEGER,
    product_id int,
    created_by INTEGER,
    quantity INTEGER,
    created_at DATETIME,
    updated_at DATETIME,
    
    
    PRIMARY KEY(id),
    foreign key(product_id) references products(id),
    FOREIGN KEY(created_by) REFERENCES users(id)
    
);
create table suppliers(
id int primary key auto_increment,
supplier_name varchar(50),
supplier_location varchar(50),
email varchar(50),
created_by varchar(50),
created_at DateTime,
updated_at DateTime

-- foreign key(created_by) references users(id)-- 
);

create table order_product(
    id INTEGER,
    supplier INTEGER,
    product INTEGER,
    quantity_ordered INTEGER,
    quantity_received INTEGER,
    quantity_remaining INTEGER,
    status varchar(20),
    batch int,
    created_by INTEGER,
    created_at DateTime,
    updated_at DateTime,
    
    
     PRIMARY key(id)
--     FOREIGN KEY(supplier) REFERENCES supplier(id),
--     FOREIGN KEY(product) REFERENCES products(id),
--     FOREIGN KEY(created_by) REFERENCES products(id)
    
    )
;
create table product_suppliers(
    id INTEGER primary key auto_increment,
    supplier INTEGER,
    product INTEGER,
    created_at DateTime,
    updated_at DateTime
    
    )
;


