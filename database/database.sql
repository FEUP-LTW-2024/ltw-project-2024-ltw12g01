DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS User;

PRAGMA foreign_keys = ON;

CREATE TABLE User (
    UserId INTEGER PRIMARY KEY,
    UserName NVARCHAR(120) NOT NULL,
    UserPassword NVARCHAR(25) NOT NULL
);

CREATE TABLE Item (
    ItemId INTEGER PRIMARY KEY,
    ItemBrand NVARCHAR(25) NOT NULL,
    ItemName NVARCHAR(120) NOT NULL,
    ItemPrice INTEGER NOT NULL,
    ItemOwner INTEGER NOT NULL,
    FOREIGN KEY(ItemOwner) REFERENCES User(UserId)
);

INSERT INTO User (UserId, UserName, UserPassword) VALUES (1, 'Alice', 'P@ssw0rd123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(2, 'Bob', 'SecurePass123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(3, 'Charlie', 'Str0ngP@ss!');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(4, 'David', 'Passw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(5, 'Emma', 'S3cureP@ss');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(6, 'Frank', 'P@ssw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(7, 'Grace', 'Str0ngP@ss!');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(8, 'Henry', 'P@ssw0rd123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(9, 'Isabella', 'SecurePass123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(10, 'Jack', 'Str0ngP@ss!');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(11, 'Katherine', 'Passw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(12, 'Leo', 'S3cureP@ss');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(13, 'Mia', 'P@ssw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(14, 'Nathan', 'SecurePass123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(15, 'Olivia', 'Str0ngP@ss!');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(16, 'Peter', 'Passw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(17, 'Quinn', 'S3cureP@ss');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(18, 'Rachel', 'P@ssw0rd123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(19, 'Samuel', 'SecurePass123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(20, 'Taylor', 'Str0ngP@ss!');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(21, 'Uma', 'Passw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(22, 'Victor', 'S3cureP@ss');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(23, 'Wendy', 'P@ssw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(24, 'Xavier', 'SecurePass123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(25, 'Yasmine', 'Str0ngP@ss!');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(26, 'Zachary', 'Passw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(27, 'Lily', 'S3cureP@ss');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(28, 'Noah', 'P@ssw0rd!23');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(29, 'Sophia', 'SecurePass123');
INSERT INTO User (UserId, UserName, UserPassword) VALUES(30, 'Ethan', 'Str0ngP@ss!');

-- Inserting sample data into Item table limited to shoes/sneakers
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (1, 'Nike', 'Air Jordan 1', 150, 1);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (2, 'Adidas', 'Yeezy Boost 350', 220, 2);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (3, 'Converse', 'Chuck Taylor All Star', 50, 3);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (4, 'Puma', 'RS-X', 120, 4);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (5, 'New Balance', '574', 80, 5);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (6, 'Vans', 'Old Skool', 60, 6);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (7, 'Reebok', 'Classic Leather', 70, 7);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (8, 'Under Armour', 'UA HOVR Phantom', 140, 8);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (9, 'Asics', 'GEL-Kayano 27', 160, 9);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (10, 'Skechers', 'D Lites', 70, 10);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (11, 'Fila', 'Disruptor II', 80, 11);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (12, 'Brooks', 'Ghost 13', 130, 12);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (13, 'Merrell', 'Moab 2 Vent', 100, 13);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (14, 'Salomon', 'Speedcross 5', 150, 14);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (15, 'Hoka One One', 'Bondi 7', 160, 15);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (16, 'Mizuno', 'Wave Rider 24', 150, 16);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (17, 'Keen', 'Targhee III Waterproof', 140, 17);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (18, 'Timberland', 'Classic 6-Inch Boot', 180, 18);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (19, 'Dr. Martens', '1460', 150, 19);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (20, 'UGG', 'Classic Short II', 160, 20);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (21, 'Birkenstock', 'Arizona', 100, 21);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (22, 'Crocs', 'Classic Clog', 50, 22);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (23, 'Teva', 'Original Universal', 70, 23);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (24, 'Hunter', 'Original Tall', 150, 24);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (25, 'Bogs', 'Classic High', 120, 25);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (26, 'Sorel', 'Caribou', 170, 26);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (27, 'Chaco', 'Z/Cloud', 110, 27);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (28, 'Toms', 'Alpargata', 50, 28);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (29, 'ECCO', 'Soft 7 Sneaker', 150, 29);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (30, 'Clarks', 'Desert Boot', 130, 30);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (31,'Saucony', 'Jazz Original', 70, 31);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (32,'Altra', 'Escalante', 130, 32);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (33,'La Sportiva', 'Bushido II', 145, 33);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (34,'Brooks', 'Adrenaline GTS 21', 150, 34);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (35,'Hoka One One', 'Clifton 7', 130, 35);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (36,'On', 'Cloudflow', 140, 36);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (37,'Under Armour', 'Charged Assert 8', 60, 37);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (38,'Saucony', 'Kinvara 12', 110, 38);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (39,'Newton', 'Fate 7', 150, 39);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (40,'Inov-8', 'Trailtalon 235', 120, 40);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (41,'Salomon', 'Sense Ride 3', 160, 41);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (42,'Merrell', 'Nova 2', 100, 42);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (43,'Vibram', 'FiveFingers V-Trail 2.0', 120, 43);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (44,'Adidas', 'Ultraboost 21', 180, 44);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (45,'Nike', 'Air Zoom Pegasus 37', 120, 45);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (46,'Hoka One One', 'Mach 4', 150, 46);
INSERT INTO Item (ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES (47,'Mizuno', 'Wave Sky Waveknit 4', 160, 47);
