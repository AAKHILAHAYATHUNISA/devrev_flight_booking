"# devrev_task" 
"# devrev_task" 



DATABASE NAME = flight_booking

TABLES:
1.ADMIN TABLE:
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

USER : aakhila_hayathunisa
PASSWORD : 123

2.USERS TABLE
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(50) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  address VARCHAR(255) NOT NULL
);


3.FLIGHTS TABLE:
CREATE TABLE flights (
  id INT(11) NOT NULL AUTO_INCREMENT,
  airline_name VARCHAR(50) NOT NULL,
  city_source VARCHAR(50) NOT NULL,
  city_destination VARCHAR(50) NOT NULL,
  departure_time VARCHAR(50) NOT NULL,
  arrival_time VARCHAR(50) NOT NULL,
  price INT(11) NOT NULL,
  seat INT DEFAULT 60
);

4.BOOKING TABLE:
CREATE TABLE bookings (
  id INT(11) NOT NULL AUTO_INCREMENT,
  airline_name VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  city_source VARCHAR(255) NOT NULL,
  city_destination VARCHAR(255) NOT NULL,
  departure_time VARCHAR(255) NOT NULL,
  arrival_time VARCHAR(255) NOT NULL,
  price INT(11) NOT NULL,
  seat INT(11) NOT NULL,
  flight_id INT(11) NOT NULL
);



Links:
HOME
to login as user or admin : http://localhost/devrev_workspace/view_flights.php

USER
Signup : http://localhost/devrev_workspace/user/signup.php
Login : http://localhost/devrev_workspace/user/login.php
Option to login as existing user or new user : http://localhost/devrev_workspace/user/option.php
Filter : http://localhost/devrev_workspace/user/filter.php
Booking : http://localhost/devrev_workspace/user/booking.php
Mybooking : http://localhost/devrev_workspace/user/mybooking.php
Bogout : http://localhost/devrev_workspace/user/logout.php

ADMIN
Login : http://localhost/devrev_workspace/admin/login.php
Option : http://localhost/devrev_workspace/admin/option.php
Admin_actions : http://localhost/devrev_workspace/admin/admin_actions.php
Filter : http://localhost/devrev_workspace/admin/filter.php
Add_flight : http://localhost/devrev_workspace/admin/add_flight.php
Remove_flight : http://localhost/devrev_workspace/admin/remove_flight.php
Logout : http://localhost/devrev_workspace/admin/logout.php

Technologies Used:
 HTML
 CSS
 PHP








