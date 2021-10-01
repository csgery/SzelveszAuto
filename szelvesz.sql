CREATE SCHEMA IF NOT EXISTS szelveszauto;
USE szelveszauto;

/* ************ USERS ************ */
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth` int(11) NOT NULL DEFAULT 2 COMMENT '0-admin\r\n1-staff\r\n2-customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `house_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone_number` (`phone_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` VALUES 
('admin','admin@asd.com','$2y$12$AMVktHnhVpWAaEUni4FrJeuMeVbY19X4cJZbCbgnEe9kivap566eO',0,'2021-05-02 12:00:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('marika','marikaStaff@asd.com','$2y$12$XDSscPRACz8eqt0P0vHutObWIxq7SkF5s.03SZ..FXrEDj5S/HJ.y',1,'2021-05-09 09:57:19',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('staff','staff@asd.com','$2y$12$Pva34P7VX6zVEtj3iObBJuYKasyfxw4q0lGDkUSQvwJ3LC6V12Bhu',1,'2021-05-08 18:20:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('staff2','staff2@asd.com','$2y$12$GldCQ6iWuSXK9xa3EoOvmewbt6eVSZNprvGLV5n1Z9D7loiqxAxlq',1,'2021-05-09 09:56:57',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
('andika','andrea@asd.com','$2y$12$ZHhXkHYr5XZbCOs8twBl5.WAf3hBmXlbwpbLvMfZ938mEX6uCE3AC',2,'2021-05-09 10:04:43','Andrea','Kis','+36972495734','3287','Debrecen','Jókai','47'),
('andrás','andras@asd.com','$2y$12$qrfRppoWylE7z1f8E7815u/5g6cLfbfa.DX1MfHWI5PNgRu30Ou7K',2,'2021-05-09 10:01:18','András','Kovács','+36996513448','3998','Kiskunhalas','Rákóczi út','28'),
('brigitta','brigitta@asd.com','$2y$12$TA6M9Vd1WaIoyYCmjG8tYugG2aQc5hWBGgalvp76ps1Gob5NjYHi6',2,'2021-05-09 10:03:03','Brigitta','Juhász','+36896542371','3552','Miskolc','Balogh Béla út','53'),
('józsef','jozsef@asd.com','$2y$12$ImAgKQJnui0DaHMpuFya2OXoqoOcXx3LqeX4Anyd1DQi6Rrcffn7S',2,'2021-05-02 12:58:39','József','Nagy','+36969845231','3466','Biatorbágy','Jókai út','79');


/****************   CSAK ADMIN   ********************/
-- DELETE FROM users;
-- INSERT INTO users VALUES ('admin','admin@asd.com','$2y$12$AMVktHnhVpWAaEUni4FrJeuMeVbY19X4cJZbCbgnEe9kivap566eO',0,'2021-05-02 12:00:28',NULL,NULL,NULL,NULL,NULL,NULL,NULL);


/* ************ CARS ************ */
DROP TABLE IF EXISTS `cars`;

CREATE TABLE `cars` (
  `id` varchar(255) NOT NULL,
  `image` text DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `colour` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-notDeleted\r\n1-deleted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `cars` VALUES 
('6097aa2771d617.31969057','public/img/cars/file_6097b0e0978eb1.51891603.jpg','Audi','A3','fehér',1500000,0),
('6097aa43702c14.72007348','public/img/cars/file_6097b0e69af055.62777682.jpg','Audi','A6','fekete',1500000,0),
('6097aa65dfb968.06208853','public/img/cars/file_6097b0ed4863b9.23263598.jpg','Audi','Q3','kék',3000000,0),
('6097aa854bf638.07315941','public/img/cars/file_6097b0f4a5f5a6.37097376.jpg','Audi','Q8','zöld',8000000,0),
('6097aabe621732.82905008','public/img/cars/file_6097b0fb2b4985.14197881.jpg','BMW','I8','szürke',10000000,0),
('6097aae8d39ed7.53003579','public/img/cars/file_6097b104c069f4.51224357.jpg','BMW','M3','arany',2000000,0),
('6097ab072168d6.96457716','public/img/cars/file_6097b10b906776.31608290.jpg','BMW','X6','fehér',7500000,0),
('6097ab35d59cd4.22651739','public/img/cars/file_6097b112cd8a39.50445885.jpg','Mercedes','AMG','fekete',12000000,0),
('6097ab538f1f18.34337522','public/img/cars/file_6097b11b567435.11448936.jpg','Mercedes','Benz C','szürke',5700000,0),
('6097abbf9e19f2.74901402','public/img/cars/file_6097b1242f47f6.10073283.jpg','Mercedes','GLC','fekete',12600000,0),
('6097abd9314702.85622109','public/img/cars/file_6097b12b2b1d88.21784589.jpg','Opel','Astra','szürke',1300000,0),
('6097abf816b7b1.21217914','public/img/cars/file_6097b134c2c290.60058351.jpg','Opel','Astra','piros',3750000,0),
('6097ac163f80f4.44312147','public/img/cars/file_6097b13e27a429.51590369.jpg','Opel','Corsa','piros',3000000,0),
('6097ac2ce7c6d4.68947267','public/img/cars/file_6097b1458d4962.50135893.jpg','Suzuki','Vitara','arany',7300000,0),
('6097ac57df9648.08949598','public/img/cars/file_6097b14c39d995.91111705.jpg','Toyota','Corolla','törtfehér',7750000,0);


/* ************ ORDERS ************ */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `order_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `car_id` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `preparing` int(11) NOT NULL DEFAULT 0,
  `is_shipped` int(11) NOT NULL DEFAULT 0,
  `is_arrived` int(11) NOT NULL DEFAULT 0,
  `arrived_at` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


/* ORDERS EXAMPLES */

/*
INSERT INTO `orders` VALUES 
('6097dbf0d26c30.39860797','andika','6097aa2771d617.31969057','2021-05-09 14:56:16',1,0,0,NULL),
('6097dc33aef089.17253151','andika','6097ab072168d6.96457716','2021-05-09 14:57:23',1,1,0,NULL),
('6097dc3d1aa988.12349398','andika','6097abf816b7b1.21217914','2021-05-09 14:57:33',1,1,1,'2021-05-09 14:57:55'),
('6097dc94bcb357.95810470','andrás','6097aa43702c14.72007348','2021-05-09 14:59:00',1,1,1,'2021-05-09 14:59:43'),
('6097dc9ebe4763.76198257','andrás','6097ac2ce7c6d4.68947267','2021-05-09 14:59:10',1,1,1,'2021-05-09 14:59:43'),
('6097dced399880.53383689','józsef','6097abd9314702.85622109','2021-05-09 15:00:29',1,1,0,NULL),
('6097dcf668a1b6.51891711','józsef','6097abbf9e19f2.74901402','2021-05-09 15:00:38',0,0,0,NULL),
('6097dd003f6701.40568195','józsef','6097aae8d39ed7.53003579','2021-05-09 15:00:48',0,0,0,NULL);
*/
