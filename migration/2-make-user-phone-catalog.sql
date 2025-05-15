DROP DATABASE IF EXISTS testforeign;
CREATE DATABASE testforeign;
USE testforeign;

CREATE TABLE CatalogPhone (
  id int NOT NULL,
  name VARCHAR(255),
  
  PRIMARY KEY (id)
);

CREATE TABLE PhoneNumbers (  
  id int NOT NULL AUTO_INCREMENT,
  catalog_phone_id int,
  number VARCHAR(24),

  PRIMARY KEY (id),

  INDEX catalog_phone_ind (catalog_phone_id),
  FOREIGN KEY (catalog_phone_id)
      REFERENCES CatalogPhone(id)
      ON DELETE CASCADE
);

CREATE TABLE Users (  
  id int NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(255),  
  LastName VARCHAR(255),  
  Email VARCHAR(255),
  Password VARCHAR(64),
  id_phone int,

  PRIMARY KEY (id),

  INDEX id_phone_ind (id_phone),
  FOREIGN KEY (id_phone)
      REFERENCES PhoneNumbers(id)
      ON DELETE CASCADE
);

INSERT INTO CatalogPhone (id, name) VALUES (1, 'Users');

INSERT INTO Users (FirstName, LastName, Email, Password, id_phone) VALUES ('<?= $current_user ?>', '<?= $current_user ?>', '<?= $current_user ?>@gmail.com', "Don\'t protected password", NULL);

GRANT ALL PRIVILEGES ON testforeign.* TO '<?= $current_user ?>'@'%';