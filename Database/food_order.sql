CREATE DATABASE food_order;

-- DROP DATABASE food_order;

USE food_order;

CREATE TABLE tbl_admin (
  id int(10) UNSIGNED NOT NULL PRIMARY KEY,
  full_name varchar(100) NOT NULL,
  username varchar(100) NOT NULL,
  password varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tbl_admin (id, full_name, username, password) VALUES
(17, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

CREATE TABLE tbl_category (
  id int(10) UNSIGNED NOT NULL PRIMARY KEY,
  title varchar(100) NOT NULL,
  image_name varchar(255) NOT NULL,
  featured varchar(10) NOT NULL,
  active varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tbl_category (id, title, image_name, featured, active) VALUES
(1, 'Olahan Daging', 'Food_Category_830.jpg', 'Yes', 'Yes'),
(10, 'Olahan Nasi', 'Food_Category_994.jpg', 'Yes', 'Yes'),
(11, 'Minuman', 'Food_Category_982.jpg', 'Yes', 'Yes');

CREATE TABLE tbl_food (
  id int(10) UNSIGNED NOT NULL PRIMARY KEY,
  title varchar(100) NOT NULL,
  description text NOT NULL,
  price decimal(10,2) NOT NULL,
  image_name varchar(255) NOT NULL,
  category_id int(10) UNSIGNED NOT NULL,
  featured varchar(10) NOT NULL,
  active varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tbl_food (id, title, description, price, image_name, category_id, featured, active) VALUES
(1, 'Bakso', 'Diolah dari daging sapi pilihan', '5000.00', 'Food-Name-4481.jpg', 1, 'Yes', 'Yes'),
(2, 'Nasi Goreng', 'Digoreng dengan minyak pilihan dan dilengkapi sayur mayur				', '7000.00', 'Food-Name-5441.jpg', 10, 'Yes', 'Yes'),
(3, 'Nasi Pecel', 'Dicampur dengan sambal yang pedas\r\n						', '5000.00', 'Food-Name-8290.jpg', 10, 'Yes', 'Yes'),
(4, 'Ayam Geprek', 'Renyahnya hingga ke dalam\r\n						', '7000.00', 'Food-Name-279.jpg', 1, 'Yes', 'Yes'),
(5, 'Teh', 'Dicampur dengan gula yang pas	', '2000.00', 'Food-Name-8970.jpg', 11, 'Yes', 'Yes'),
(6, 'Kopi', ' Penenang hidup dan teman diskusi\r\n						', '2000.00', 'Food-Name-205.jpg', 11, 'Yes', 'Yes');

CREATE TABLE tbl_meja (
	id_table varchar(3) PRIMARY KEY,
    password varchar(10)
);

INSERT INTO tbl_meja VALUES
("M1", "meja1"),
("M2", "meja2"),
("M3", "meja3"),
("M4", "meja4");

-- DROP TABLE tbl_order;

CREATE TABLE tbl_order (
  id int(10) UNSIGNED NOT NULL PRIMARY KEY,
  id_table varchar(3), FOREIGN KEY (id_table) REFERENCES tbl_meja(id_table),
  food varchar(150) NOT NULL,
  price decimal(10,2) NOT NULL,
  qty int(11) NOT NULL,
  total decimal(10,2) NOT NULL,
  order_date datetime NOT NULL,
  status varchar(50) NOT NULL,
  customer_name varchar(150) NOT NULL,
  customer_contact varchar(20) NOT NULL,
  customer_address varchar(255) NOT NULL
);
-- SET FOREIGN_KEY_CHECKS = 0;

INSERT INTO tbl_order (id, id_table, food, price, qty, total, order_date, status, customer_name, customer_contact, customer_address) VALUES
(7, "M1", 'Kopi', '2000.00', 1, '2000.00', '2021-06-25 10:44:03', 'Delivered', 'Ardiansyah', '08512345678', 'Jalan Gajah Mada'),
(8, "M3", 'Nasi Goreng', '7000.00', 1, '7000.00', '2021-06-25 11:18:14', 'Ordered', 'admin''', '0835487946', 'Jalan Pahlawan'),
(9, "M3", 'Nasi Goreng', '7000.00', 5, '35000.00', '2021-06-28 12:30:17', 'Delivered', 'Zinedine Zidane', '08157846448', 'Jalan Majapahit');

CREATE TABLE tbl_cart (
	id_cart int(10) PRIMARY KEY,
	id_table varchar(3), FOREIGN KEY (id_table) REFERENCES tbl_meja(id_table),
	title varchar(150) NOT NULL,
	price decimal(10,2) NOT NULL,
	qty int(11) NOT NULL,
	sub_total decimal(10,2) NOT NULL
);

-- DROP TABLE tbl_cart;

ALTER TABLE `tbl_cart`
  MODIFY `id_cart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
  
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
