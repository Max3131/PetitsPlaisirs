DROP TABLE Client;
DROP TABLE Admin;
DROP TABLE TypeCave;
DROP TABLE Cave;

CREATE TABLE Client (
    idClient INT AUTO_INCREMENT PRIMARY KEY,
    EmailCli VARCHAR(50) UNIQUE,
    NomCli VARCHAR(20),
    PrenomCli VARCHAR(30),
    MdpCli VARCHAR(50),
    DateNaissanceCli DATE,
    AdresseCli VARCHAR(50),
    VilleCli VARCHAR(20),
    CodePostalCli VARCHAR(5)
);

CREATE TABLE Admin (
    idAdmin INT AUTO_INCREMENT PRIMARY KEY,
    NomAdmin VARCHAR(100),
    PrenomAdmin VARCHAR(100),
    MdpAdmin VARCHAR(50),
    EmailAdmin VARCHAR(50) UNIQUE
);

CREATE TABLE TypeCave (
    idTypeCave VARCHAR(50) PRIMARY KEY,
    TempOptiC INT,
    LumOptiC INT,
    HumOptiC INT
);

CREATE TABLE Cave (
    idCave INT AUTO_INCREMENT PRIMARY KEY,
    NomCave VARCHAR(50),
    VolumeCave INT,
    AdresseCave VARCHAR(50),
    VilleCave VARCHAR(20),
    CodePostalCave VARCHAR(5),
    TypeCave VARCHAR(50),
    idClient INT,
    CONSTRAINT fk_Cave_Client FOREIGN KEY(idClient) REFERENCES Client(idClient),
    CONSTRAINT fk_Cave_TypeCave FOREIGN KEY(TypeCave) REFERENCES TypeCave(idTypeCave)
);

INSERT INTO TypeCave (idTypeCave, TempOptiC, LumOptiC, HumOptiC) VALUES
('Rouge', 15, 50, 70),
('Blanc', 10, 40, 60),
('Champagne', 8, 30, 50),
('Rosé', 12, 45, 65);

INSERT  INTO Cave (NomCave, VolumeCave, AdresseCave, VilleCave, CodePostalCave, TypeCave, idClient) VALUES
('Cave de Bordeaux', 1000, '1 Rue de la Liberté', 'Bordeaux', '33000', 'Rouge', 1),
('Cave de Bourgogne', 800, '2 Rue des Vins', 'Dijon', '21000', 'Blanc', 1),
('Cave de Champagne', 1200, '3 Avenue des Vins', 'Reims', '51100', 'Champagne', 1),
('Cave de Provence', 600, '4 Chemin des Vignes', 'Avignon', '84000', 'Rosé', 1);

