CREATE DATABASE sanninstore;
USE sanninstore;

CREATE TABLE brands (
	brand_id INT auto_increment,
    brand_name VARCHAR(255),
    PRIMARY KEY (brand_id)
);

CREATE TABLE ages (
	age_id INT auto_increment,
    age_name VARCHAR(13),
    description TEXT,
    PRIMARY KEY (age_id)
);

CREATE TABLE categories (
	category_id INT auto_increment,
    category_name VARCHAR(100),
    description TEXT,
    PRIMARY KEY (category_id)
);

CREATE TABLE countries (
	country_id INT auto_increment,
    country_name VARCHAR(100),
    PRIMARY KEY (country_id)
);

CREATE TABLE products (
	product_id INT auto_increment,
    product_name VARCHAR(255),
    quantity INT,
    price FLOAT,
    description TEXT,
    image TEXT,
    category_id INT,
    country_id INT,
    age_id INT,
    brand_id INT,
    PRIMARY KEY (product_id),
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (country_id) REFERENCES countries(country_id),
    FOREIGN KEY (age_id) REFERENCES ages(age_id),
    FOREIGN KEY (brand_id) REFERENCES brands(brand_id)
);

CREATE TABLE admins (
	admin_id INT auto_increment,
    email VARCHAR(255) unique,
    password VARCHAR(255),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    phone_number VARCHAR(13),
    level INT,
    PRIMARY KEY (admin_id)
);

CREATE TABLE customers (
	customer_id INT auto_increment,
    email VARCHAR(255) unique,
    password VARCHAR(255),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    phone_number VARCHAR(13),
    address TEXT,
    PRIMARY KEY (customer_id)
);

CREATE TABLE payment_methods (
	method_id INT auto_increment,
    method_name VARCHAR(100),
    PRIMARY KEY (method_id)
);

CREATE TABLE orders (
	order_id INT auto_increment,
    order_date DATETIME,
    order_status INT,
    receiver_name VARCHAR(255),
    receiver_phone VARCHAR(13),
    receiver_address TEXT,
    admin_id INT,
    customer_id INT,
    method_id INT,
    PRIMARY KEY (order_id),
    FOREIGN KEY (admin_id) REFERENCES admins(admin_id),
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
    FOREIGN KEY (method_id) REFERENCES payment_methods(method_id)
);

CREATE TABLE orders_details (
	order_id INT,
    product_id INT,
    sold_price FLOAT,
    sold_quantity INT,
    PRIMARY KEY (order_id, product_id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

/*================================================================*/

INSERT INTO brands(brand_name) VALUES
("Mojang Studios"),
("Disney"),
("Marvel"),
("DC"),
("Sega"),
("Nintendo");

INSERT INTO ages(age_name) VALUES
("1.5+"),
("4+"),
("6+"),
("9+"),
("13+"),
("18+");

INSERT INTO categories(category_name) VALUES
("Batman"),
("Minecraft"),
("Lunar New Year"),
("Valentine"),
("Disney"),
("Marvel");

INSERT INTO countries(country_name) VALUES
("United States"),
("Korea"),
("Italy"),
("China"),
("Japan"),
("Vietnam");

INSERT INTO products(product_name, quantity, price, description, image, category_id, country_id, age_id, brand_id) VALUES
("Auspicious Dragon", 100, 89.99, "", "images/products/product_1.webp", 3, 1, 6, 2),
("Batmobile™: Batman™ vs. The Joker™ Chase", 100, 47.99, "", "images/products/product_2.webp", 1, 2, 3, 4),
("Spring Festival Mickey Mouse", 100, 9.99, "", "images/products/product_3.webp", 5, 3, 1, 2),
("Nano Gauntlet", 100, 69.99, "", "images/products/product_4.webp", 3, 4, 2, 6),
("The Abandoned Mine", 100, 19.99, "", "images/products/product_5.webp", 2, 5, 4, 1),
("Heart Ornament", 100, 12.99, "", "images/products/product_6.webp", 4, 6, 5, 5);