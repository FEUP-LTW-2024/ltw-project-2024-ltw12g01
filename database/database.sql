DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Role;
DROP TABLE IF EXISTS UserRole;

PRAGMA foreign_keys = ON;

CREATE TABLE User (
    UserId INTEGER PRIMARY KEY AUTOINCREMENT,
    UserName NVARCHAR(120) UNIQUE NOT NULL,
    Email NVARCHAR(120) NOT NULL,
    UserType NVARCHAR(5) NOT NULL,
    UserPassword NVARCHAR(255) NOT NULL,
    ItemsListed INTEGER DEFAULT 0 
);

CREATE TABLE Role (
    RoleId INTEGER PRIMARY KEY AUTOINCREMENT,
    RoleName NVARCHAR(10) NOT NULL
);

CREATE TABLE Item (
    ItemId INTEGER PRIMARY KEY AUTOINCREMENT,
    ItemBrand NVARCHAR(120) NOT NULL,
    ItemName NVARCHAR(120) NOT NULL,
    ItemPrice DECIMAL(10,2) NOT NULL,
    ItemOwner INTEGER NOT NULL,
    ItemImage NVARCHAR(255), -- Não está implementado
    FOREIGN KEY(ItemOwner) REFERENCES User(UserId)
);

CREATE TABLE UserRole (
    UserId INTEGER NOT NULL,
    RoleId INTEGER NOT NULL,
    PRIMARY KEY (UserId, RoleId),
    FOREIGN KEY (UserId) REFERENCES User (UserId),
    FOREIGN KEY (RoleId) REFERENCES Role (RoleId)
);

INSERT INTO Role (RoleName) VALUES ('Buyer'), ('Seller'), ('Admin');

INSERT INTO User (UserName, Email, UserType, UserPassword, ItemsListed) VALUES 
('User1', 'user1@example.com', 'type1', 'password1', 1), 
('User2', 'user2@example.com', 'type1', 'password2', 1), 
('User3', 'user3@example.com', 'type1', 'password3', 1), 
('User4', 'user4@example.com', 'type1', 'password4', 1),
('User5', 'user5@example.com', 'type1', 'password5', 1), 
('User6', 'user6@example.com', 'type1', 'password6', 1), 
('User7', 'user7@example.com', 'type1', 'password7', 1), 
('User8', 'user8@example.com', 'type1', 'password8', 1),
('User9', 'user9@example.com', 'type1', 'password9', 1), 
('User10', 'user10@example.com', 'type1', 'password10', 1), 
('User11', 'user11@example.com', 'type1', 'password11', 0), 
('User12', 'user12@example.com', 'type1', 'password12', 0),
('User13', 'user13@example.com', 'type1', 'password13', 0), 
('User14', 'user14@example.com', 'type1', 'password14', 0), 
('User15', 'user15@example.com', 'type1', 'password15', 0), 
('User16', 'user16@example.com', 'type1', 'password16', 0),
('User17', 'user17@example.com', 'type1', 'password17', 0), 
('User18', 'user18@example.com', 'type1', 'password18', 0), 
('User19', 'user19@example.com', 'type1', 'password19', 0), 
('User20', 'user20@example.com', 'type1', 'password20', 0),
('User21', 'user21@example.com', 'type1', 'password21', 0), 
('User22', 'user22@example.com', 'type1', 'password22', 0), 
('User23', 'user23@example.com', 'type1', 'password23', 0), 
('User24', 'user24@example.com', 'type1', 'password24', 0),
('User25', 'user25@example.com', 'type1', 'password25', 0), 
('User26', 'user26@example.com', 'type1', 'password26', 0), 
('User27', 'user27@example.com', 'type1', 'password27', 0), 
('User28', 'user28@example.com', 'type1', 'password28', 0),
('User29', 'user29@example.com', 'type1', 'password29', 0), 
('User30', 'user30@example.com', 'type1', 'password30', 0), 
('User31', 'user31@example.com', 'type1', 'password31', 0), 
('User32', 'user32@example.com', 'type1', 'password32', 0),
('User33', 'user33@example.com', 'type1', 'password33', 0), 
('User34', 'user34@example.com', 'type1', 'password34', 0), 
('User35', 'user35@example.com', 'type1', 'password35', 0), 
('User36', 'user36@example.com', 'type1', 'password36', 0),
('User37', 'user37@example.com', 'type1', 'password37', 0), 
('User38', 'user38@example.com', 'type1', 'password38', 0), 
('User39', 'user39@example.com', 'type1', 'password39', 0), 
('User40', 'user40@example.com', 'type1', 'password40', 0),
('User41', 'user41@example.com', 'type1', 'password41', 0), 
('User42', 'user42@example.com', 'type1', 'password42', 0), 
('User43', 'user43@example.com', 'type1', 'password43', 0), 
('User44', 'user44@example.com', 'type1', 'password44', 0),
('User45', 'user45@example.com', 'type1', 'password45', 0), 
('User46', 'user46@example.com', 'type1', 'password46', 0), 
('User47', 'user47@example.com', 'type1', 'password47', 0), 
('User48', 'user48@example.com', 'type1', 'password48', 0),
('User49', 'user49@example.com', 'type1', 'password49', 0), 
('User50', 'user50@example.com', 'type1', 'password50', 0);

INSERT INTO Item (ItemBrand, ItemName, ItemPrice, ItemOwner) VALUES 
('Nike', 'Air Jordan 1 Retro High', 160.00, 1), 
('Nike', 'Air Jordan 3 Retro SE', 190.00, 2), 
('Adidas', 'Yeezy Boost 350 V2', 220.00, 3),
('Nike', 'Nike Dunk Low Retro', 110.00, 4), 
('New Balance', 'New Balance 992', 100.00, 5), 
('Adidas', 'Adidas Ultraboost 22', 180.00, 6),
('Nike', 'Air Jordan 12 Retro', 175.00, 7), 
('Adidas', 'Yeezy 450 Cloud White', 240.00, 8), 
('Nike', 'Nike Air Max 270', 160.00, 9),
('New Balance', 'New Balance 997H', 175.00, 10), 
('Adidas', 'Adidas Samba Classic', 80.00, 11), 
('Nike', 'Air Jordan 11 Retro Low', 220.00, 12),
('Adidas', 'Yeezy Quantum', 60.00, 13), 
('Nike', 'Nike SB Blazer', 100.00, 14), 
('New Balance', 'New Balance 1500', 80.00, 15),
('Adidas', 'Adidas Superstar', 130.00, 16), 
('Nike', 'Air Jordan 6 Retro', 190.00, 17), 
('Adidas', 'Yeezy Boost 700 MNVN', 230.00, 18),
('Nike', 'Nike Air Force 1 Low', 90.00, 19), 
('New Balance', 'New Balance 860v11', 110.00, 20), 
('Adidas', 'Adidas ZX Flux', 80.00, 21),
('Nike', 'Air Jordan 4 Retro', 200.00, 22), 
('Nike', 'Air Jordan 5 Retro Fire Red', 195.00, 23), 
('Adidas', 'Yeezy Powerphase', 120.00, 24),
('Nike', 'Nike Air Vapormax Plus', 190.00, 25), 
('New Balance', 'New Balance 1080v10', 150.00, 26), 
('Adidas', 'Adidas EQT Support ADV', 110.00, 27),
('Nike', 'Air Jordan 1 Mid SE', 130.00, 28), 
('Nike', 'Air Jordan 2 Retro', 160.00, 29), 
('Adidas', 'Yeezy Slide Core', 55.00, 30),
('Nike', 'Nike Air Zoom Pegasus 36', 120.00, 31), 
('New Balance', 'New Balance 1300', 180.00, 32), 
('Adidas', 'Adidas Harden Vol. 4', 140.00, 33),
('Nike', 'Air Jordan 9 Retro', 170.00, 34), 
('Nike', 'Air Jordan 8 Retro', 165.00, 35), 
('Adidas', 'Yeezy 500 High', 200.00, 36),
('Nike', 'Nike React Infinity Run', 160.00, 37), 
('New Balance', 'New Balance 577', 135.00, 38), 
('Adidas', 'Adidas Yung-1', 100.00, 39),
('Nike', 'Air Jordan 7 Retro', 190.00, 40), 
('Nike', 'Air Jordan 14 Retro', 200.00, 41), 
('Adidas', 'Yeezy Boost 380', 230.00, 42),
('Nike', 'Nike Joyride Run Flyknit', 180.00, 43), 
('New Balance', 'New Balance 990v4', 175.00, 44), 
('Adidas', 'Adidas Alphaedge 4D', 300.00, 45),
('Nike', 'Air Jordan 10 Retro', 190.00, 46), 
('Nike', 'Air Jordan 13 Retro', 200.00, 47), 
('Adidas', 'Yeezy 700 V3 Azael', 250.00, 48),
('Nike', 'Nike LeBron 18', 200.00, 49), 
('New Balance', 'New Balance 574 Classic', 80.00, 50);