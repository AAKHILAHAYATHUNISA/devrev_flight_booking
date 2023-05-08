"# devrev_task" 
"# devrev_task" 



database name = flight_booking

tables:
1.admin:
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

2.users
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(50) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  address VARCHAR(255) NOT NULL
);


3.flights:
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

4.bookings:
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









