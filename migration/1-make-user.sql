USE test;

CREATE TABLE Users (  
  id int NOT NULL AUTO_INCREMENT,
  FirstName VARCHAR(255),  
  LastName VARCHAR(255),  
  Email VARCHAR(255),
  Password VARCHAR(64),
  id_phone VARCHAR(24),
  PRIMARY KEY (id)
);

# CREATE TABLE Users (id int NOT NULL AUTO_INCREMENT, FirstName VARCHAR(255), LastName VARCHAR(255), Email VARCHAR(255), Password VARCHAR(64), id_phone VARCHAR(24), PRIMARY KEY (id));

INSERT INTO Users (FirstName, LastName, Email, Password, id_phone) VALUES ('test', 'test', 'Test@gmail.com', "Don\'t protected password", 1);