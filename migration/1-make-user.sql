USE test;

CREATE TABLE Users (  
  id int NOT NULL,  
  FirstName VARCHAR(255),  
  LastName VARCHAR(255),  
  Email VARCHAR(255),
  Password VARCHAR(64),
  id_phone VARCHAR(24),
  PRIMARY KEY (id)
);

INSERT INTO Users (id, FirstName, LastName, Email, Password, id_phone) VALUES (1, 'test', 'test', 'Test@gmail.com', "Don\'t protected password", 1);
