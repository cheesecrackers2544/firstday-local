-- Create 'Parent_Profiles' table
CREATE TABLE Parent_Profiles (
ParentID INT AUTO_INCREMENT PRIMARY KEY,
Name VARCHAR(255) NOT NULL,
Email VARCHAR(255) NOT NULL UNIQUE,
ContactNumber VARCHAR(20)
);
-- Create 'Owner_Profiles' table
CREATE TABLE Owner_Profiles (
    OwnerID INT AUTO_INCREMENT PRIMARY KEY,
    ManagementContactName VARCHAR(255) NOT NULL,
    ManagementContactPhone VARCHAR(20),
    OwnerEmail VARCHAR(255) UNIQUE,
    Password VARCHAR(255) NOT NULL,
    EmailVerified BOOLEAN NOT NULL DEFAULT FALSE,
    VerificationToken VARCHAR(255)
);

-- Create 'Listings' table
CREATE TABLE Listings (
    ListingID INT AUTO_INCREMENT PRIMARY KEY,
    OwnerID INT,
    Title VARCHAR(255),
    Description VARCHAR(255),
    Price INT,
    Telephone VARCHAR(20),
    Email VARCHAR(255),
    StreetAddress VARCHAR(255),
    Suburb VARCHAR(100),
    TownCity VARCHAR(100),
    ServiceType VARCHAR(100),
    HoursECE VARCHAR(3),
    AreaUnit VARCHAR(100),
    ManagementContactName VARCHAR(255) NOT NULL,
    ManagementContactPhone VARCHAR(20),
    Latitude DECIMAL(9,6),
    Longitude DECIMAL(9,6),
    MaxLicensedPositions INT,
    CapacityUnder2s INT,
    CapacityAge0 INT,
    CapacityAge1 INT,
    CapacityAge2 INT,
    CapacityAge3 INT,
    CapacityAge4 INT,
    CapacityAge5 INT,
    TotalCapacity INT,
    FOREIGN KEY (OwnerID) REFERENCES Owner_Profiles(OwnerID)
);

-- Create 'Reviews' table
CREATE TABLE Reviews (
ReviewID INT AUTO_INCREMENT PRIMARY KEY,
ParentID INT,
ListingID INT,
Content TEXT,
Rating INT,
FOREIGN KEY (ParentID) REFERENCES Parent_Profiles(ParentID),
FOREIGN KEY (ListingID) REFERENCES Listings(ListingID)
);
-- Create 'User_Interactions' table
CREATE TABLE User_Interactions (
InteractionID INT AUTO_INCREMENT PRIMARY KEY,
UserID INT,
ListingID INT,
MessageType VARCHAR(255),
MessageContent TEXT,
FOREIGN KEY (UserID) REFERENCES Parent_Profiles(ParentID),
FOREIGN KEY (ListingID) REFERENCES Listings(ListingID)
);
