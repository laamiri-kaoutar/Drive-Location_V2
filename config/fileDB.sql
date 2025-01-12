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


DELIMITER $$

CREATE PROCEDURE AddReservation(
    IN user_id INT,
    IN id_vehicule INT,
    IN date_debut DATE ,
    IN date_fin DATE ,
    IN lieu VARCHAR(255) 
)
BEGIN
    -- Insert a new reservation record
    INSERT INTO reservation(user_id , id_vehicule , date_debut , date_fin , lieu_prise_en_charge  ) 
    VALUES (user_id, id_vehicule, date_debut, date_fin, lieu);
END $$

DELIMITER ;

-- Table: Theme
CREATE TABLE theme (
    theme_id INT AUTO_INCREMENT PRIMARY KEY,
    theme_name VARCHAR(255) NOT NULL,
    description TEXT
);

-- Table: Article
CREATE TABLE article (
    article_id INT AUTO_INCREMENT PRIMARY KEY,
    article_title VARCHAR(255) NOT NULL,
    theme_id INT NOT NULL ,
    user_id INT NOT NULL,
    FOREIGN KEY (theme_id) REFERENCES theme(theme_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES utilisateur(user_id) ON DELETE CASCADE,
    content TEXT,
    image VARCHAR(255)
);




-- Table: Favorit
CREATE TABLE favorit (
    article_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    PRIMARY KEY (article_id, user_id),
    FOREIGN KEY (article_id) REFERENCES article(article_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES utilisateur(user_id) ON DELETE CASCADE
);

-- Table: Tag
CREATE TABLE tag (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    tag_title VARCHAR(255) NOT NULL,
    tag_color VARCHAR(50)
);

-- Table: Tagging (Relationship between Tag and Article)
CREATE TABLE tagging (
    tag_id INT NOT NULL,
    article_id INT NOT NULL,
    PRIMARY KEY (tag_id, article_id),
    FOREIGN KEY (tag_id) REFERENCES tag(tag_id) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES article(article_id) ON DELETE CASCADE
);

-- Table: Comment
CREATE TABLE comment (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    article_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    FOREIGN KEY (article_id) REFERENCES article(article_id) ON DELETE CASCADE ,
    FOREIGN KEY (user_id) REFERENCES utilisateur(user_id) ON DELETE CASCADE
);
