CREATE TABLE prefixe_yas (
    id   INTEGER PRIMARY KEY AUTOINCREMENT,
    code TEXT NOT NULL UNIQUE
);

INSERT INTO prefixe_yas (code) VALUES ('034'), ('038');

CREATE TABLE type_operation (
    id  INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE
);

INSERT INTO type_operation (nom) VALUES ('Dépôt'), ('Retrait'), ('Transfert');

CREATE TABLE bareme_frais (
    id                INTEGER PRIMARY KEY AUTOINCREMENT,
    type_operation_id INTEGER,
    montant_min       REAL NOT NULL,
    montant_max       REAL NOT NULL,
    frais             REAL NOT NULL,
    FOREIGN KEY(type_operation_id) REFERENCES type_operation(id)
);

INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES 
--Retrait
(2, 100, 1000, 100), (2, 1001, 5000, 150), (2, 5001, 10000, 275),
(2, 10001, 20000, 550), (2, 20001, 25000, 650), (2, 25001, 50000, 1300),
(2, 50001, 100000, 1900), (2, 100001, 250000, 3400), (2, 250001, 500000, 4700),
(2, 500001, 1000000, 8800), (2, 1000001, 2000000, 14700), (2, 2000001, 3000000, 19600),
(2, 3000001, 4000000, 24500), (2, 4000001, 5000000, 29400), (2, 5000001, 6000000, 34300),
(2, 6000001, 7000000, 39200), (2, 7000001, 8000000, 44100), (2, 8000001, 9000000, 49000),
(2, 9000001, 10000000, 53900), (2, 10000001, 11000000, 59000), (2, 11000001, 12000000, 64000),
(2, 12000001, 13000000, 69000), (2, 13000001, 14000000, 74000), (2, 14000001, 15000000, 79000),
(2, 15000001, 16000000, 84000), (2, 16000001, 17000000, 89000), (2, 17000001, 18000000, 94000),
(2, 18000001, 19000000, 98000), (2, 19000001, 20000000, 100000),
--Transfert
(3, 100, 1000, 70), (3, 1001, 5000, 70), (3, 5001, 10000, 150),
(3, 10001, 25000, 250), (3, 25001, 50000, 500), (3, 50001, 100000, 1000),
(3, 100001, 250000, 1900), (3, 250001, 500000, 1900), (3, 500001, 1000000, 3200),
(3, 1000001, 2000000, 3800), (3, 2000001, 3000000, 5000), (3, 3000001, 4000000, 6300),
(3, 4000001, 5000000, 7500), (3, 5000001, 6000000, 9400), (3, 6000001, 7000000, 10700),
(3, 7000001, 8000000, 12500), (3, 8000001, 9000000, 14400), (3, 9000001, 10000000, 15700),
(3, 10000001, 11000000, 17500), (3, 11000001, 12000000, 18800), (3, 12000001, 13000000, 20000),
(3, 13000001, 14000000, 21300), (3, 14000001, 15000000, 23200), (3, 15000001, 16000000, 25000),
(3, 16000001, 17000000, 26300), (3, 17000001, 18000000, 28200), (3, 18000001, 19000000, 30000),
(3, 19000001, 20000000, 31300);

CREATE TABLE compte_client (
    id_client        INTEGER PRIMARY KEY AUTOINCREMENT,
    numero_telephone TEXT NOT NULL UNIQUE,
    nom              TEXT NOT NULL,
    prenom           TEXT NOT NULL,
    solde            REAL NOT NULL DEFAULT 0,
);

CREATE TABLE operation (
    id_operation        INTEGER PRIMARY KEY AUTOINCREMENT,
    id_client           INTEGER,
    type_operation_id   INTEGER,
    montant             REAL NOT NULL DEFAULT 0,
    numero_destinataire TEXT DEFAULT NULL,
    date_operation      TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    frais               REAL NOT NULL,
    FOREIGN KEY(id_client) REFERENCES compte_client(id_client),
    FOREIGN KEY(type_operation_id) REFERENCES type_operation(id)
);

CREATE TABLE autre_operateur (
    id_autre_operateur INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe            TEXT NOT NULL UNIQUE,
    nom_operateur      TEXT NOT NULL
);

INSERT INTO autre_operateur (prefixe, nom_operateur) 
VALUES ('032', 'Orange'), ('037', 'Orange'),('033', 'Airtel');


CREATE TABLE historique_gain(
    id_historique_gain INTEGER PRIMARY KEY AUTOINCREMENT,
    montant_gain       REAL NOT NULL,
    date_gain          TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pourcentage_commission (
    id_pourcentage_commission INTEGER PRIMARY KEY AUTOINCREMENT,
    pourcentage               REAL NOT NULL
);

INSERT INTO pourcentage_commission (pourcentage) VALUES (0.10);

CREATE TABLE compte_admin (
    id_admin     INTEGER PRIMARY KEY AUTOINCREMENT,
    nom          TEXT NOT NULL,
    prenom       TEXT NOT NULL,
    email        TEXT NOT NULL UNIQUE,
    mot_de_passe TEXT NOT NULL
);

INSERT INTO compte_admin (nom, prenom, email, mot_de_passe) VALUES ('RAVELOMANANTSOA', 'Tony Mahefa', 'admin@example.com', 'admin123');




