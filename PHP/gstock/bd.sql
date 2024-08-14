CREATE TABLE Client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    telephone VARCHAR(20),
    adresse TEXT
);

CREATE TABLE Article (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_article VARCHAR(100),
    categorie VARCHAR(100),
    quantite INT,
    prix_unitaire DECIMAL(10, 2),
    date_expiration DATE,
    date_fabrication DATE
);

CREATE TABLE Fournisseur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    telephone VARCHAR(20),
    adresse TEXT
);

CREATE TABLE Vente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_article INT,
    id_client INT,
    quantite INT,
    prix DECIMAL(10, 2),
    date_vente DATE,
    FOREIGN KEY (id_article) REFERENCES Article(id),
    FOREIGN KEY (id_client) REFERENCES Client(id)
);

CREATE TABLE Commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_article INT,
    id_fournisseur INT,
    quantite INT,
    prix DECIMAL(10, 2),
    date_commande DATE,
    FOREIGN KEY (id_article) REFERENCES Article(id),
    FOREIGN KEY (id_fournisseur) REFERENCES Fournisseur(id)
);
