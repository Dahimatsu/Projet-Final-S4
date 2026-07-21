CREATE TABLE promotion_transfert (
    id_promotion INTEGER PRIMARY KEY AUTOINCREMENT,
    pourcentage  REAL NOT NULL DEFAULT 0
);

INSERT INTO promotion_transfert (pourcentage)
VALUES (20);



