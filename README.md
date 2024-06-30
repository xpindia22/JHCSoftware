Clinic management software.
using mysql / mariadb database, php, html/css.
This will be a simple project to manage a clinic.

Patient Registration
Visits, Revisits, Recalling Data from database in tablular format.
Pharmacy, Lab, Accounts ... to begin with.

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


Regards
Robert
