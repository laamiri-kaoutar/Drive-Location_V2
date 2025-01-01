-- Création de la base de données
CREATE DATABASE drive_location;
USE drive_location;

-- Table utilisateur
CREATE TABLE utilisateur (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100)  NOT NULL,
    email VARCHAR(200)  NOT NULL,
    image VARCHAR(250)  ,
    password VARCHAR(255) NOT NULL,
    role  ENUM('client' , 'admin') DEFAULT 'client'
);


CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);


CREATE TABLE vehicule (
    id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
    marque VARCHAR(100) NOT NULL,
    modele VARCHAR(100) NOT NULL,
    prix_par_jour DECIMAL(10,2) NOT NULL,
    disponibilite BOOLEAN DEFAULT TRUE,
    id_categorie INT,
    description TEXT,
    image VARCHAR(250),
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie) ON DELETE SET NULL
);


CREATE TABLE reservation (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    id_vehicule INT,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    status ENUM('pending', 'approved', 'declined') DEFAULT 'pending', 
    lieu_prise_en_charge VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule) ON DELETE CASCADE
);


CREATE TABLE avis (
    id_avis INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    id_vehicule INT,
    commentaire TEXT,
    note TINYINT(1) CHECK (note >= 1 AND note <= 5),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_vehicule) REFERENCES vehicule(id_vehicule) ON DELETE CASCADE
);
