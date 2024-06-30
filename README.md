Clinic management software.
using mysql / mariadb database, php, html/css.
This will be a simple project to manage a clinic.

Patient Registration
Visits
Revisits
Recalling Data from database in tablular format.
Pharmacy
Lab
Accounts ... to begin with.

Your will have to install apache2 server and mysql or mariadb server. 
Install wamp server and it will do it automatically for you.

I am going ahead with mysql database.
Details as below, you can keep any db name, user and password. But for ease can use the below also
on your wamp server.

Create a database named "mydb"
You can use phpmyadmin, or create database on command line/terminal.

$host = "localhost";
$user = "root";
$pwd = "";//password should never be left blank on a live server.
$db = "mydb";

we will create tables in this as we progress and insert data from forms into these tables.

 
Create first table user_info.
In this table we will save patient info which will usually not change much like name, sex, adhaar no etc.

run this sql query in your database to create user _info table
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(333) NOT NULL,
  `age` int NOT NULL,
  `sex` varchar(99) NOT NULL,
  `unit_no` int NOT NULL,
  `diagnosis` varchar(999) NOT NULL,
  `date` date NOT NULL,
  `mobile` int NOT NULL,
  `address` varchar(999) NOT NULL,
  `notes` varchar(999) NOT NULL,
  `consultation` int NOT NULL,
  `ecg` int NOT NULL,
  `echo` int NOT NULL,
  `medicines` int NOT NULL,
  `lab` int NOT NULL,
  PRIMARY KEY (`unit_no`),
  UNIQUE KEY `unit_no` (`unit_no`),
  UNIQUE KEY `unit_no_2` (`unit_no`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `unit_no_3` (`unit_no`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



Regards
Robert
