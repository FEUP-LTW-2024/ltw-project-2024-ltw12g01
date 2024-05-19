DROP TABLE IF EXISTS Item;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS OrderItem;
DROP TABLE IF EXISTS Shipment;
DROP TABLE IF EXISTS ShipmentUserInfo;
DROP TABLE IF EXISTS Chat;
DROP TABLE IF EXISTS Message;

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

INSERT INTO User (UserName, Email, UserType, UserPassword, ItemsListed, PaymentMethod, PaymentInfo)
VALUES
('JohnDoe', 'johndoe@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 1, 'Credit Card', '4111111111111111'),
('JaneSmith', 'janesmith@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 3,'PayPal', 'janesmith@paypal.com'),
('MikeJohnson', 'mikejohnson@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 2,'Credit Card', '4222222222222222'),
('EmilyDavis', 'emilydavis@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 1,NULL, NULL),
('ChrisBrown', 'chrisbrown@example.com', 'buyer', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 0,'Debit Card', '4333333333333333'),
('AmandaWilson', 'amandawilson@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 3,'PayPal', 'amandawilson@paypal.com'),
('DavidMartinez', 'davidmartinez@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 2,'Credit Card', '4444444444444444'),
('SarahLee', 'sarahlee@example.com', 'buyer/seller', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 1,'Credit Card', '4555555555555555'),
('PaulWalker', 'paulwalker@example.com', 'buyer', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 0,NULL, NULL),
('LauraMoore', 'lauramoore@example.com', 'buyer', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 0,'Debit Card', '4666666666666666'),
('Rebelo', 'rebelo@example.com', 'admin', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 0,NULL, NULL),
('Carlos', 'carlos@example.com', 'admin', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 0,NULL, NULL),
('Tiago' , 'tiago@example.com', 'admin', '$2y$08$srXBNaOn/wVHuPPgSUM3U.I2e8b8DNIpltA8jUzAbKCbLVHk1DO2e', 0,NULL, NULL);


INSERT INTO Item (ItemBrand, ItemName, ItemPrice, ItemOwner, ItemImage, ItemDescription, ItemCategory, ItemCondition, ItemSize)
VALUES
('Wilson', 'Wilson Pro Staff Court tennis shoes White', 70, 2, '../uploads/sneakersWilson.png', 'Sapatilhas usadas para ténis', 'Male', 'Good', '42'),
('Sanjo', 'Sapatilhas em Couro', 55, 6, '../uploads/sneakersLeather.jpeg', 'Sapatilhas em Couro bastante confortáveis', 'Male', 'Very good', '44'),
('Nike', 'Dunk Low', 100, 7, '../uploads/sneakersDunkLow.jpg', 'Sapatilhas confortáveis', 'Male', 'Very good', '41'),
('Adidas', 'Adidas Azuis', 25, 6, '../uploads/sneakersBlueAdidas.jpg', 'Muito uso', 'Kids', 'Bad', '36'),
('Nike', 'Nike Dunk', 80, 7, '../uploads/sneakersNikeDunk.png', 'Casuais', 'Male', 'Good', '45'),
('Sanjo', 'Sanjo Amarelas', 62, 4, '../uploads/sneakersYellowSanjo.jpg', 'Nunca usadas', 'Female', 'Very good', '40'),
('Sanjo', 'Navy Sanjo', 45, 3, '../uploads/sneakersNavySanjo.jpg', 'Nunca usadas', 'Kids', 'New without tags', '36'),
('Adidas', 'Adidas Samba', 62, 8, '../uploads/sneakersSamba.png', 'Nunca usadas', 'Female', 'New without tags', '36'),
('Ralph Lauren', 'Sapatilha Ralph Lauren', 120, 3, '../uploads/sneakersRalphLauren.jpg', 'Novas com Etiqueta.', 'Male', 'New with tags', '45'),
('Asics', 'Asics Japan', 80, 6, '../uploads/sneakersAsics.jpg', 'Novas, com caixa.', 'Female', 'New with tags', '37'),
('Adidas', 'Adidas Gazelle Pink', 50, 2, '../uploads/sneakersGazelle.jpg', 'Usadas, mas em bom estado.', 'Female', 'Good', '36'),
('Adidas', 'Adidas Gazelle Black', 80, 2, '../uploads/sneakersGazelle2.jpg', 'Novas, bastante confortáveis', 'Female', 'New without tags', '36'),
('Christian Louboutin', 'Louboutin Seavast 2', 850, 1, '../uploads/sneakersLouboutin.jpg', 'Authentic.', 'Male', 'New without tags', '42'),
('Puma', 'Puma Classic Sneakers Red', 90, 2, '../uploads/puma1.jpg', 'Classic red Puma sneakers.', 'Male', 'New with tags', '43'),
('Puma', 'Puma Suede Sneakers Black', 85, 3, '../uploads/puma2.jpg', 'Stylish black Puma suede sneakers.', 'Female', 'Satisfactory', '39'),
('Puma', 'Puma Running Shoes Blue', 100, 4, '../uploads/puma3.jpg', 'Comfortable blue Puma running shoes.', 'Male', 'Good', '44'),
('Puma', 'Puma Lifestyle Sneakers Gray', 80, 7, '../uploads/puma4.jpg', 'Casual gray Puma lifestyle sneakers.', 'Female', 'Bad', '38'),
('Hermes', 'Hermes High-Top Sneakers White', 950, 8, '../uploads/hermes1.jpg', 'Luxurious white Hermes high-top sneakers.', 'Male', 'New with tags', '42'),
('Hermes', 'Hermes Low-Top Sneakers Black', 900, 9, '../uploads/hermes2.jpg', 'Elegant black Hermes low-top sneakers.', 'Female', 'Very good', '37'),
('Quechua', 'Quechua Waterproof Hiking Boots', 120, 10, '../uploads/quechua1.jpg', 'Durable waterproof hiking boots from Quechua.', 'Male', 'Bad', '41'),
('Quechua', 'Quechua Outdoor Sandals', 45, 11, '../uploads/quechua2.jpg', 'Comfortable outdoor sandals for adventures.', 'Female', 'Satisfactory', '40'),
('Quechua', 'Quechua Backpack', 30, 12, '../uploads/quechua3.jpg', 'Spacious backpack for hiking and travel.', 'Male', 'Very good', '42'),
('Merrell', 'Merrell Trail Running Shoes', 110, 1, '../uploads/merrel2.jpg', 'Sturdy and supportive trail running shoes from Merrell.', 'Kids', 'Good', '45'),
('Merrell', 'Merrell Hiking Boots', 140, 5, '../uploads/merrel1.jpg', 'Reliable and comfortable hiking boots from Merrell.', 'Male', 'New with tags', '44');


INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (1, 1, 2, 65.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (1, 1, 2, 'Hi Jane, I''m interested in your items.'),
    (1, 2, 1, 'Hello John, sure, what items are you interested in?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (2, 2, 3, 50.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (2, 2, 3, 'Hi Mike, I saw your items and I''m interested.'),
    (2, 3, 2, 'Hi Jane, thanks for your interest. Which items caught your eye?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (3, 3, 6, 60.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (3, 3, 6, 'Hi Amanda, I''m interested in your items.'),
    (3, 6, 3, 'Hello Mike, sure, which items are you interested in?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (4, 4, 8, 115.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (4, 4, 8, 'Hi Sarah, I''m interested in your items.'),
    (4, 8, 4, 'Hello Emily, sure, which items are you interested in?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (5, 5, 7, 75.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (5, 5, 7, 'Hi David, I''m interested in your items.'),
    (5, 7, 5, 'Hello Chris, which items caught your interest?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (6, 10, 11, 0.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (6, 10, 11, 'Hi Rebelo, I''m interested in your items.'),
    (6, 11, 10, 'Hello Laura, sure, which items are you interested in?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (7, 10, 1, 60.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (7, 10, 1, 'Hi John, I''m interested in your items.'),
    (7, 1, 10, 'Hello Laura, sure, what items are you interested in?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (8, 6, 9, 70.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (8, 6, 9, 'Hi Paul, I''m interested in your items.'),
    (8, 9, 6, 'Hello Amanda, which items caught your interest?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES (9, 12, 13, 0.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (9, 12, 13, 'Hi Tiago, I''m interested in your items.'),
    (9, 13, 12, 'Hello Carlos, sure, what items are you interested in?');

INSERT INTO Chat (ItemId, SenderId, ReceiverId, LastSuggestedPrice)
VALUES 
    (10, 8, 5, 130.00), 
    (11, 7, 2, 95.00),  
    (12, 3, 9, 850.00), 
    (13, 6, 12, 35.00), 
    (14, 10, 3, 105.00); 

INSERT INTO Message (ChatId, SenderId, ReceiverId, Content)
VALUES
    (10, 8, 5, 'Hi Paul, I noticed you have Merrell Trail Running Shoes listed. I''m interested.'),
    (10, 5, 8, 'Hello David, yes, I have them available. Would you like more information?'),
    (11, 7, 2, 'Hi Sarah, I''m eyeing your Puma Classic Sneakers Red. Are they still available?'),
    (11, 2, 7, 'Hello Mike, yes, they are still available. Would you like to discuss the price?'),
    (12, 3, 9, 'Hi Amanda, I''m interested in your Hermes Low-Top Sneakers Black.'),
    (12, 9, 3, 'Hello Emily, sure, let''s discuss the details.'),
    (13, 6, 12, 'Hi Amanda, I''m considering purchasing your Quechua Backpack.'),
    (13, 12, 6, 'Hello Laura, great! It''s a durable backpack perfect for hiking. Would you like more photos?'),
    (14, 10, 3, 'Hi Amanda, your Puma Running Shoes Blue caught my eye. Are they still available?'),
    (14, 3, 10, 'Hello Mike, yes, they''re still available. I can offer you a discount if you''re interested.');
