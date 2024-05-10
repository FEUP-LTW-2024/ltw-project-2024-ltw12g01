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
    ItemCondition NVARCHAR(20) NOT NULL,  -- added column for condition
    ItemSize NVARCHAR(20) NOT NULL,  -- added column for size
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
    ShippingState NVARCHAR(50) NOT NULL,
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