DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS OrderItem;
DROP TABLE IF EXISTS Shipment;

PRAGMA foreign_keys = ON;

CREATE TABLE User (
    UserId INTEGER PRIMARY KEY AUTOINCREMENT,
    UserName NVARCHAR(120) UNIQUE NOT NULL,
    Email NVARCHAR(120) NOT NULL,
    UserType NVARCHAR(5) NOT NULL, /* buyer buyer/seller admin */
    UserPassword NVARCHAR(255) NOT NULL,
    ItemsListed INTEGER DEFAULT 0,
    ItemsSold INTEGER DEFAULT 0,
    PaymentMethod NVARCHAR(50) ,
    PaymentInfo NVARCHAR(255)
);

CREATE TABLE Item (
    ItemId INTEGER PRIMARY KEY AUTOINCREMENT,
    ItemBrand NVARCHAR(120) NOT NULL,
    ItemName NVARCHAR(120) NOT NULL,
    ItemPrice DECIMAL(10,2) NOT NULL,
    ItemOwner NVARCHAR(120) NOT NULL,
    ItemImage NVARCHAR(255), 
    ItemDescription NVARCHAR(255),
    ItemCategory NVARCHAR(50) NOT NULL,
    ItemCondition NVARCHAR(20) NOT NULL, 
    ItemSize NVARCHAR(20) NOT NULL,  
    FOREIGN KEY(ItemOwner) REFERENCES User(UserId) 
);

CREATE TABLE Orders (
    OrdersId INTEGER PRIMARY KEY AUTOINCREMENT,
    UserId INTEGER NOT NULL,
    OrderDate DATE NOT NULL,
    Total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (UserId) REFERENCES User(UserId)
);

CREATE TABLE OrderItem (
    OrderItemId INTEGER PRIMARY KEY AUTOINCREMENT,
    OrdersId INTEGER NOT NULL,
    ItemId INTEGER NOT NULL,
    Quantity INTEGER NOT NULL,
    FOREIGN KEY (OrdersId) REFERENCES Orders(OrdersId),
    FOREIGN KEY (ItemId) REFERENCES Item(ItemId)
);

CREATE TABLE ShipmentUserInfo (
    ShipmentUserInfoId INTEGER PRIMARY KEY AUTOINCREMENT,
    UserId INTEGER NOT NULL,
    ShippingAddress NVARCHAR(200) NOT NULL,
    ShippingCity NVARCHAR(50) NOT NULL,
    ShippingZipCode NVARCHAR(10) NOT NULL,
    ShippingCountry NVARCHAR(50) NOT NULL,
    FOREIGN KEY (UserId) REFERENCES User(UserId)
);

CREATE TABLE Shipment (
    ShipmentId INTEGER PRIMARY KEY AUTOINCREMENT,
    OrdersId INTEGER NOT NULL,
    ShipmentDate DATE NOT NULL,
    ShipmentStatus NVARCHAR(50) NOT NULL,
    FOREIGN KEY (OrdersId) REFERENCES Orders(OrdersId)
);

CREATE TABLE Chat (
    ChatId INTEGER PRIMARY KEY AUTOINCREMENT,
    ItemId INTEGER NOT NULL,
    SenderId INTEGER NOT NULL,
    ReceiverId INTEGER NOT NULL,
    LastSuggestedPrice DECIMAL(10, 2),
    FOREIGN KEY (SenderId) REFERENCES User(UserId),
    FOREIGN KEY (ReceiverId) REFERENCES User(UserId)
);

CREATE TABLE Message (
    MessageId INTEGER PRIMARY KEY AUTOINCREMENT,
    ChatId INTEGER NOT NULL,
    SenderId INTEGER NOT NULL,
    ReceiverId INTEGER NOT NULL,
    Content TEXT NOT NULL,
    Timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ChatId) REFERENCES Chat(ChatId),
    FOREIGN KEY (SenderId) REFERENCES User(UserId),
    FOREIGN KEY (ReceiverId) REFERENCES User(UserId)
);

INSERT INTO User (UserName, Email, UserType, UserPassword, PaymentMethod, PaymentInfo)
VALUES
('JohnDoe', 'johndoe@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 'Credit Card', '4111111111111111'),
('JaneSmith', 'janesmith@example.com', 'seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 'PayPal', 'janesmith@paypal.com'),
('MikeJohnson', 'mikejohnson@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 'Credit Card', '4222222222222222'),
('EmilyDavis', 'emilydavis@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', NULL, NULL),
('ChrisBrown', 'chrisbrown@example.com', 'buyer', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 'Debit Card', '4333333333333333'),
('AmandaWilson', 'amandawilson@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 'PayPal', 'amandawilson@paypal.com'),
('DavidMartinez', 'davidmartinez@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 'Credit Card', '4444444444444444'),
('SarahLee', 'sarahlee@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 'Credit Card', '4555555555555555'),
('PaulWalker', 'paulwalker@example.com', 'buyer', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', NULL, NULL),
('LauraMoore', 'lauramoore@example.com', 'buyer', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 'Debit Card', '4666666666666666'),
('Rebelo', 'rebelo@example.com', 'admin', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', NULL, NULL),
('Carlos', 'carlos@example.com', 'admin', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', NULL, NULL),
('Tiago' , 'tiago@example.com', 'admin', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', NULL, NULL);


INSERT INTO Item (ItemBrand, ItemName, ItemPrice, ItemOwner, ItemImage, ItemDescription, ItemCategory, ItemCondition, ItemSize)
VALUES
('Wilson', 'Wilson Pro Staff Court tennis shoes White', 70, 2, '../uploads/sneakersWilson.png', 'Sapatilhas usadas para ténis', 'Male', 'Good', '42'),
('Sanjo', 'Sapatilhas em Couro', 55, 6, '../uploads/sneakersLeather.jpeg', 'Sapatilhas em Couro bastante confortáveis', 'Male', 'Very Good', '44'),
('Nike', 'Dunk Low', 100, 7, '../uploads/sneakersDunkLow.jpg', 'Sapatilhas confortáveis', 'Male', 'Very Good', '41'),
('Adidas', 'Adidas Azuis', 25, 6, '../uploads/sneakersBlueAdidas.jpg', 'Muito uso', 'Kids', 'Bad', '36'),
('Nike', 'Nike Dunk', 80, 7, '../uploads/sneakersNikeDunk.png', 'Casuais', 'Male', 'Good', '45'),
('Sanjo', 'Sanjo Amarelas', 62, 4, '../uploads/sneakersYellowSanjo.jpg', 'Nunca usadas', 'Women', 'Very Good', '40'),
('Sanjo', 'Navy Sanjo', 45, 3, '../uploads/sneakersNavySanjo.jpg', 'Nunca usadas', 'Kids', 'New without tags', '36'),
('Adidas', 'Adidas Samba', 62, 8, '../uploads/sneakersSamba.png', 'Nunca usadas', 'Kids', 'New without tags', '36');
