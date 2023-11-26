CREATE DATABASE IF NOT EXISTS CITYPARKING;
USE CITYPARKING;

CREATE TABLE IF NOT EXISTS USER (
    UNumber INT AUTO_INCREMENT, 
    Name VARCHAR(30), 
    Phone CHAR(10), 
    PRIMARY KEY (UNumber)
);

CREATE TABLE IF NOT EXISTS Lot_Info (
    ZoneNumber INT AUTO_INCREMENT, 
    ZoneName CHAR(30), 
    Capacity INT, 
    PRIMARY KEY (ZoneNumber)
);

CREATE TABLE IF NOT EXISTS Venue (
    VNumber INT AUTO_INCREMENT, 
    VName VARCHAR(25), 
    PRIMARY KEY (VNumber)
);

CREATE TABLE IF NOT EXISTS Distance (
    ZoneNumber INT, 
    VNumber INT, 
    Distance INT,
    PRIMARY KEY (ZoneNumber, VNumber),
    FOREIGN KEY (ZoneNumber) REFERENCES Lot_Info(ZoneNumber), 
    FOREIGN KEY (VNumber) REFERENCES Venue(VNumber)
);

CREATE TABLE IF NOT EXISTS Lot (
    ZoneNumber INT, 
    Date DATE, 
    Space INT, 
    Rate INT, 
    PRIMARY KEY (ZoneNumber, Date), 
    FOREIGN KEY (ZoneNumber) REFERENCES Lot_Info(ZoneNumber)
);


CREATE TABLE IF NOT EXISTS Reservation (
    ConformationNum INT AUTO_INCREMENT PRIMARY KEY, 
    UNumber INT, 
    ZoneNumber INT, 
    Date DATE, 
    Rate INT, 
    Status VARCHAR(15),
    FOREIGN KEY (UNumber) REFERENCES User(UNumber), 
    FOREIGN KEY (ZoneNumber, Date) REFERENCES Lot(ZoneNumber, Date)
);