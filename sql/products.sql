CREATE TABLE products (
   id int AUTO_INCREMENT NOT NULL,
   product_id int NOT NULL,
   name varchar(50) NOT NULL,
   price decimal(6,2) NOT NULL,
   description varchar(150) NOT NULL,
   image varchar(50) NOT NULL,
   PRIMARY KEY(id)
);


INSERT INTO products (id,product_id, name, price, description, image) VALUES
(1, 1, 'Lenovo Laptop', '1000.02','i5 processor', 'assets/Lenovo.jpg'),
(2, 1, 'HP Laptop', '1499.99', 'i3 processor', 'assets/HP.jpg'),
(3, 1, 'Dell Laptop', '1619.99', 'i7 processor', 'assets/Dell.jpg'),
(4, 2, 'Samsung', '504.99', 'snapdragon 830', 'assets/Samsung.jpg'),
(5, 2, 'iPhone', '999.99', 'snapdragon 780', 'assets/iPhone.jpg'),
(6, 2, 'Huawei', '819.99', 'snapdragon 860', 'assets/Huawei.jpg')