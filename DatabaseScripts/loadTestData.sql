INSERT IGNORE INTO User (UNumber, Name, Phone) VALUES 
('0001', 'Kevin Lin', '6665554321'), 
('0002', 'Terry Liu', '6665554322');

INSERT IGNORE INTO Lot_Info (ZoneNumber, ZoneName, Capacity) VALUES 
(1, 'StateHouse', 200), 
(2, 'ShortNorth', 100), 
(3, 'NorthMarket', 50);

INSERT IGNORE INTO Venue (VNumber, VName) VALUES 
(1, 'Nationwide Arena'), 
(2, 'COSI'), 
(3, 'Huntington Park');

INSERT IGNORE INTO Distance (ZoneNumber, VNumber, Distance) VALUES 
(1, 1, 1), 
(1, 2, 4), 
(1, 3, 3), 
(2, 1, 2), 
(2, 2, 5), 
(2, 3, 4), 
(3, 1, 2), 
(3, 2, 4), 
(3, 3, 2);

INSERT IGNORE INTO Lot (ZoneNumber, Date, Space, Rate) VALUES 
('0001', '2023-11-11', 10, 2);
INSERT IGNORE INTO Lot (ZoneNumber, Date, Space, Rate) VALUES 
('0002', '2023-11-11', 10, 2);

INSERT IGNORE INTO Reservation (ConformationNum, UNumber, ZoneNumber, Date, Rate, Status) VALUES 
('0001', '0001', '0001', '2023-11-11', 2, 'Active'), 
('0002', '0001', '0001', '2023-11-11', 2, 'Active'), 
('0003', '0001', '0001', '2023-11-11', 2, 'Active');

insert IGNORE into Reservation values 
(NULL, '0002', '0001', '2023-11-11', 2, 'Past');

insert IGNORE into Reservation values 
(NULL, '0002', '0002', '2023-11-11', 4, 'Past');

insert IGNORE into Reservation values 
(NULL, '0002', '0001', '2023-11-11', 4, 'Past');

CREATE OR REPLACE VIEW available_spot AS SELECT ZoneNumber, Space - COUNT(*) AS 'available' FROM summary;