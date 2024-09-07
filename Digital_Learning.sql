CREATE DATABASE digital_learning;
USE digital_learning;

CREATE TABLE Compte (
    email VARCHAR(50) PRIMARY KEY NOT NULL,
    password VARCHAR(8),
    role ENUM('STAGIAIRE', 'FORMATEUR', 'ADMINISTRATEUR') NOT NULL,
    etat VARCHAR(20),
    nom VARCHAR(20),
    prenom VARCHAR(20)
);

CREATE TABLE filiere (
    idFiliere VARCHAR(50) PRIMARY KEY NOT NULL,
    libelle VARCHAR(60),
    nombreGroup INT
);

CREATE TABLE Stagiaire (
    numeroInscription VARCHAR(10) PRIMARY KEY NOT NULL,
    nom VARCHAR(20),
    prenom VARCHAR(20),
    DateNaissance DATE,
    DateInscription DATE,
    PhotoProfil VARCHAR(250),
    numero_telephone int(15),
    cin VARCHAR(10),
    adress varchar(255),
    city VARCHAR(20),
    email VARCHAR(50),

    idFiliere VARCHAR(50),
    FOREIGN KEY (email) REFERENCES Compte(email),
    FOREIGN KEY (idFiliere) REFERENCES filiere(idFiliere),
    UNIQUE (email, nom, prenom)
);

CREATE TABLE formateur (
    matricule_formateur VARCHAR(10) PRIMARY KEY NOT NULL,
    nom VARCHAR(20),
    prenom VARCHAR(20),
    DateNaissance DATE,
    DATE_Embauche DATE,
    Photoprofil VARCHAR(250),
    numero_telephone int(15),
    cin VARCHAR(10),
    adress varchar(255),
    city VARCHAR(20),
    email VARCHAR(50),
    idFiliere VARCHAR(50),
    FOREIGN KEY (idFiliere) REFERENCES filiere(idFiliere),
    Affectaion VARCHAR(50),
    FOREIGN KEY (email) REFERENCES Compte(email),
    UNIQUE (email, nom, prenom)
);

CREATE TABLE administrateur (
    matricule_admin VARCHAR(10) PRIMARY KEY NOT NULL,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    DateNaissance DATE,
    DATE_Embauche DATE,
    Photoprofil VARCHAR(250),
    cin VARCHAR(10),
    address varchar(255),
    city VARCHAR(20),
    numero_telephone int(15),
    email VARCHAR(50),
    FOREIGN KEY (email) REFERENCES Compte(email),
    UNIQUE (email, nom, prenom)
);

CREATE TABLE module (
    sigle VARCHAR(10) PRIMARY KEY NOT NULL,
    description VARCHAR(150),
    masseHoraire INT,
    idFiliere VARCHAR(50),
    FOREIGN KEY (idFiliere) REFERENCES filiere(idFiliere),
    matricule_formateur VARCHAR(10),
    FOREIGN KEY (matricule_formateur) REFERENCES formateur(matricule_formateur)
);

CREATE TABLE Cours (
    idcours INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(200),
    description TEXT,
    sigle VARCHAR(10),
    Image_cours VARCHAR(250),
    FOREIGN KEY (sigle) REFERENCES module(sigle)
);

CREATE TABLE resources (
    idresource INT AUTO_INCREMENT PRIMARY KEY,
    idcours INT NOT NULL,
    type ENUM('exercise', 'tp', 'pdf', 'video','pageWeb') NOT NULL,
    title VARCHAR(255) NOT NULL,
    url VARCHAR(255) NOT NULL,
    FOREIGN KEY (idcours) REFERENCES Cours(idcours)
);

CREATE TABLE passerExam (
    numeroInscription VARCHAR(10),
    sigle VARCHAR(10),
    natureExam VARCHAR(20),
    note FLOAT,
    idNote int,
    FOREIGN KEY (numeroInscription) REFERENCES Stagiaire(numeroInscription),
    FOREIGN KEY (sigle) REFERENCES module(sigle)
);
