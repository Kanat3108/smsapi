CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user VARCHAR(30) NOT NULL,
    phone VARCHAR(30) NOT NULL ,
    code int(20) NOT NULL,
    trade int(2) NOT NULL ,
    portfolio int(2) NOT NULL ,
    experience int(2) NOT NULL,
    date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP

 );