DROP TABLE Client;
DROP TABLE Admin;

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
    idTypeCave INT PRIMARY KEY,
    TypeCave VARCHAR(10),
    TempOptiC INT,
    LumOptiC INT,
    HumOptiC INT
);

CREATE TABLE Cave (
    idCave INT PRIMARY KEY,
    VolumeCave INT,
    AdresseCave VARCHAR(50),
    VilleCave VARCHAR(20),
    CodePostalCave VARCHAR(5),
    idTypeCave INT,
    CONSTRAINT fk_Cave_TypeCave FOREIGN KEY(idTypeCave) REFERENCES TypeCave(idTypeCave)
);
