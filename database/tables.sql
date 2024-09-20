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
stock int,
created_by int,
created_at DateTime,
updated_at DateTime,

FOREIGN key(created_by) references users(id)
);

create table suppliers(
id int primary key auto_increment,
supplier_name varchar(50),
supplier_location varchar(50),
email varchar(50),
created_by int,
created_at DateTime,
updated_at DateTime,

FOREIGN key(created_by) references users(id)
);

create table order_product(
    id INTEGER auto_increment,
    supplier int,
    product int,
    quantity_ordered INTEGER,
    quantity_received INTEGER,
    quantity_remaining INTEGER,
    status varchar(20),
    batch int,
    created_by int,
    created_at DateTime,
    updated_at DateTime,
    
    
     PRIMARY key(id),
     FOREIGN KEY(supplier) REFERENCES suppliers(id),
     FOREIGN KEY(product) REFERENCES products(id),
    FOREIGN KEY(created_by) REFERENCES users(id)
    
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


create table order_product_history(
    id INTEGER auto_increment,
    order_product_id int,
    qty_received int ,
    date_received DateTime,
    date_updated DateTime,

    PRIMARY key(id),
     FOREIGN KEY(order_product_id) REFERENCES order_product(id)
)