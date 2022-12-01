Drop table if exists Photo;
Drop table if exists users;
create table users(
    uID int NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL UNIQUE,
    password varchar(255) ,
    isadmin BOOLEAN,
	PRIMARY KEY (uID)
);

Drop table if exists Categorie;
create table Categorie (
	catID int NOT NULL AUTO_INCREMENT,
	nomCat varchar(250),
	PRIMARY KEY (catID)
);


create table Photo  (
	photoId int NOT NULL AUTO_INCREMENT,
	nomFich varchar(250),
    description varchar(250),
    catID int,
    uploaderID int,
    isPublic BOOLEAN,
	PRIMARY KEY (photoId),
    FOREIGN KEY (catID) REFERENCES Categorie(catId),
    FOREIGN KEY (uploaderID) REFERENCES users(uID)
);





INSERT INTO Categorie VALUES (1, 'animal');
INSERT INTO Categorie VALUES (2, 'home');
INSERT INTO Categorie VALUES (3, 'family');
INSERT INTO Categorie VALUES (4, 'health');
INSERT INTO Categorie VALUES (5, 'nature');
INSERT INTO Categorie VALUES (6, 'landscape');

INSERT INTO users VALUES (1, 'admin'  ,'admin', true);
INSERT INTO users VALUES (2, 'user1'  ,'user1', false);
INSERT INTO users VALUES (3, 'alice12','alice12', false);

INSERT INTO Photo VALUES (NULL,'photo1.jfif', 'la 1ere photo cat 2',2,1,true);
INSERT INTO Photo VALUES (NULL,'photo2.jfif', 'la 2eme photo cat 2',2,2,true);
INSERT INTO Photo VALUES (NULL,'photo3.jfif', 'la 3eme photo cat 3 u3',3,2,true);
INSERT INTO Photo VALUES (NULL,'photo4.jfif', 'la 4eme photo cat 4 u3',4,2,true);
INSERT INTO Photo VALUES (NULL,'ima.jpg', 'la 5eme photo cat 4 u2',4,2,true);