DROP TABLE Client;
DROP TABLE Admin;
DROP TABLE TypeCave;
DROP TABLE Cave;
DROP TABLE Notification;
DROP TABLE Capteur;
DROP TABLE Releve;
DROP TABLE ChoixUtilisateur;
DROP TABLE Produit;
DROP TABLE Contenir;

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

CREATE TABLE Notification (
    idNotification INT AUTO_INCREMENT PRIMARY KEY,
    DateNotification DATE,
    HeureNotification TIME,
    MessageNotification VARCHAR(255),
    idCave INT,
    CONSTRAINT fk_Notification_Cave FOREIGN KEY(idCave) REFERENCES Cave(idCave) ON DELETE CASCADE
);

CREATE TABLE Capteur (
    idCapteur INT AUTO_INCREMENT PRIMARY KEY,
    NomCapteur VARCHAR(50),
    TypeCapteur VARCHAR(50),
    ValeurCapteur FLOAT,
    StatusCapteur VARCHAR(20),
    idCave INT,
    CONSTRAINT fk_Capteur_Cave FOREIGN KEY(idCave) REFERENCES Cave(idCave) ON DELETE CASCADE
);

CREATE TABLE Releve (
    idReleve INT AUTO_INCREMENT PRIMARY KEY,
    DateReleve DATE,
    HeureReleve TIME,
    UniteReleve VARCHAR(10),
    ValeurReleve FLOAT,
    idCapteur INT,
    CONSTRAINT fk_Releve_Capteur FOREIGN KEY(idCapteur) REFERENCES Capteur(idCapteur) ON DELETE CASCADE
);

CREATE TABLE ChoixUtilisateur (
    idChoix INT AUTO_INCREMENT PRIMARY KEY,
    DateChoix DATE,
    HeureChoix TIME,
    UniteChoix VARCHAR(10),
    ValeurChoix FLOAT,
    idCapteur INT,
    CONSTRAINT fk_ChoixUtilisateur_Capteur FOREIGN KEY(idCapteur) REFERENCES Capteur(idCapteur) ON DELETE CASCADE
);

-- Insérer éventuellement la table INSTALLER et CONTROLLER, en cours de réflexion

CREATE TABLE Produit (
    idProduit INT AUTO_INCREMENT PRIMARY KEY,
    NomProduit VARCHAR(50),
    TypeProduit VARCHAR(50),
    AnneeProduit INT,
    idCave INT,
    QuantiteProduit INT,
    CONSTRAINT fk_Produit_Cave FOREIGN KEY(idCave) REFERENCES Cave(idCave) ON DELETE CASCADE
);

CREATE TABLE Contenir (
    idContenir INT AUTO_INCREMENT PRIMARY KEY,
    idProduit INT,
    idCave INT,
    QuantiteProduit INT,
    CONSTRAINT fk_Contenir_Produit FOREIGN KEY(idProduit) REFERENCES Produit(idProduit),
    CONSTRAINT fk_Contenir_Cave FOREIGN KEY(idCave) REFERENCES Cave(idCave)
);








INSERT INTO Client (EmailCli, NomCli, PrenomCli, MdpCli, DateNaissanceCli, AdresseCli, VilleCli, CodePostalCli) VALUES
('a@a', 'Doe', 'John', '123', '1985-06-15', '123 Main St', 'Paris', '75000'),
('jane.smith@example.com', 'Smith', 'Jane', 'securepass456', '1990-09-25', '456 Elm St', 'Lyon', '69000'),
('alice.brown@example.com', 'Brown', 'Alice', 'mypassword789', '1995-03-10', '789 Oak St', 'Marseille', '13000');

INSERT INTO Admin (NomAdmin, PrenomAdmin, MdpAdmin, EmailAdmin) VALUES
('Admin1', 'Ad', '123', 'ad@ad'),
('Admin2', 'User', 'adminpass2', 'admin2@example.com');

INSERT INTO TypeCave (idTypeCave, TempOptiC, LumOptiC, HumOptiC) VALUES
('Vin', 15, 50, 70),
('Fromage', 10, 40, 60),
('Cigare', 18, 30, 65);

INSERT INTO Cave (NomCave, VolumeCave, AdresseCave, VilleCave, CodePostalCave, TypeCave, idClient) VALUES
('Cave de Bordeaux', 1000, '1 Rue de la Liberté', 'Bordeaux', '33000', 'Vin', 1),
('Cave de Bourgogne', 800, '2 Rue des Vins', 'Dijon', '21000', 'Vin', 1),
('Cave de Bourgogne', 800, '2 Rue des Vins', 'Dijon', '21000', 'Vin', 1),
('Cave de Champagne', 500, '3 Avenue des Bulles', 'Reims', '51100', 'Vin', 2),
('Cave de Provence', 700, '5 Chemin des Vins', 'Avignon', '84000', 'Vin', 2),
('Cave de Sancerre', 400, '6 Rue des Terroirs', 'Sancerre', '18300', 'Vin', 3),
('Cave de Roquefort', 1200, '3 Avenue des Fromages', 'Roquefort', '12250', 'Fromage', 2),
('Cave de La Havane', 600, '4 Chemin des Cigares', 'Havane', '10100', 'Cigare', 3);

INSERT INTO Notification (DateNotification, HeureNotification, MessageNotification, idCave) VALUES
('2025-05-01', '10:00:00', 'Temperature too high!', 1),
('2025-05-01', '10:00:00', 'Temperature too high!', 1),
('2025-05-02', '11:00:00', 'Humidity too low!', 2),
('2025-05-03', '12:00:00', 'Light level normal.', 3);

INSERT INTO Capteur (NomCapteur, TypeCapteur, ValeurCapteur, StatusCapteur, idCave) VALUES
('TempSensor1', 'Temperature', 12.5, 'On', 1),
<<<<<<< HEAD
('TempSensor2', 'Temperature', 13.0, 'On', 1),
('TempSensor1', 'Prise', 12.5, 'On', 1),
('TempSensor2', 'Prise', 13.0, 'On', 1),
('LightSensor1', 'Light', 300.0, 'On', 1),
('LightSensor2', 'Light', 350.0, 'On', 1),
('HumSensor1', 'Humidity', 60.0, 'On', 1),
('HumSensor2', 'Humidity', 65.0, 'On', 1),
('TempSensor3', 'Temperature', 14.0, 'On', 2),
('LightSensor3', 'Light', 400.0, 'On', 2),
('HumSensor1', 'Humidity', 65.0, 'On', 1);
=======
('HumSensor1', 'Humidity', 65.0, 'On', 1),
('LuxSensor1', 'Luminosite', 1888.0, 'On', 1),
('LuxSensor2', 'Luminosite', 1888.0, 'On', 2),
('LuxSensor3', 'Luminosite', 1888.0, 'On', 3);
>>>>>>> 125dd17ffb1ab23aaefc6dd4de8fb0b6edd81b0f

INSERT INTO Releve (DateReleve, HeureReleve, UniteReleve, ValeurReleve, idCapteur) VALUES
('2025-05-01', '12:00:00', 'Celsius', 12.5, 1),
('2025-05-01', '12:30:00', 'Percent', 65.0, 2),
('2025-05-01', '12:30:00', 'Lux', 1888.0, 3),
('2025-05-01', '12:30:00', 'Lux', 1888.0, 4),
('2025-05-01', '12:30:00', 'Lux', 1888.0, 5);

INSERT INTO ChoixUtilisateur (DateChoix, HeureChoix, UniteChoix, ValeurChoix, idCapteur) VALUES
('2025-05-02', '14:00:00', 'Celsius', 13.0, 1),
('2025-05-02', '14:30:00', 'Percent', 60.0, 2);
INSERT INTO Produit (NomProduit, TypeProduit, AnneeProduit, idCave, QuantiteProduit) VALUES
('Merlot', 'Vin Rouge', 2020, 1, 10),
('Cabernet Sauvignon', 'Vin Rouge', 2019, 1, 20),
('Chardonnay', 'Vin Blanc', 2021, 2, 30),
('Sauvignon Blanc', 'Vin Blanc', 2020, 2, 15),
('Pinot Noir', 'Vin Rouge', 2018, 3, 25),
('Syrah', 'Vin Rouge', 2017, 3, 5),
('Chardonnay', 'Vin Blanc', 2021, 2, 10);

INSERT INTO Contenir (idProduit, idCave, QuantiteProduit) VALUES
(1, 1, 50),
(2, 2, 30);

