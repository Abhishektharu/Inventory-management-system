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

--create in xampp--
description varchar(50) not null,
img varchar(50) not null,
-------------------------

created_by int,
created_at DateTime,
updated_at DateTime,
description varchar(50) not null,
img varchar(50) not null,


	
    FOREIGN KEY(created_by) REFERENCES users(id)
)


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
create table supplier(
id int primary key auto_increment,
supplier_name varchar(50),
supplier_location varchar(50),
email varchar(50),
created_by integer,
created_at DateTime,
updated_at DateTime,

foreign key(created_by) references users(id)
)

create table product_supplier(
    id INTEGER,
    supplier INTEGER,
    product INTEGER,
    quantity_ordered INTEGER,
    quantity_received INTEGER,
    quantity_remaining INTEGER,
    status varchar(20),
    created_by INTEGER,
    created_at DateTime,
    updated_at DateTime,
    
    
    PRIMARY key(id),
    FOREIGN KEY(supplier) REFERENCES supplier(id),
    FOREIGN KEY(product) REFERENCES products(id),
    FOREIGN KEY(created_by) REFERENCES products(id)
    
    )
;