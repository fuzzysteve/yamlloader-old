
CREATE TABLE certCerts (
  certID int(11) NOT NULL,
  description text,
  groupid int(11) DEFAULT NULL,
  name varchar(255) DEFAULT NULL,
  PRIMARY KEY (certID)
);


CREATE TABLE certSkills (
  certID int(11) DEFAULT NULL,
  skillID int(11) DEFAULT NULL,
  certLevelInt int(11) DEFAULT NULL,
  skillLevel int(11) DEFAULT NULL,
  certLevelText varchar(8) DEFAULT NULL
);

CREATE TABLE certMasteries (
  typeID int(11) DEFAULT NULL,
  masteryLevel int(11) DEFAULT NULL,
  certID int(11) DEFAULT NULL
);

create table industryBlueprints(typeID int primary key,maxProductionLimit int);
create table industryActivity(typeID int,time int,activityID int,
primary key(typeID,activityID),index (activityID));
create table industryActivityMaterials(typeID int,activityID int,materialTypeID int,
quantity int,consume tinyint default 1,index(typeID),index(typeID,activityID));
create table industryActivityProducts(typeID int,activityID int,productTypeID int,
quantity int,index(typeID),index(typeID,activityID),index(productTypeID));
create table industryActivitySkills(typeID int,activityID int,skillID int,level int,
index(typeID),index(typeID,activityID));
create table industryActivityProbabilities(typeID int,activityID int,productTypeID int,
probability decimal(3,2),index(typeID),index(typeID,activityID),index(productTypeID));

CREATE TABLE eveIcons (
  iconID int(11) NOT NULL,
  iconFile varchar(500) NOT NULL,
  description text,
  PRIMARY KEY (iconID)
);

CREATE TABLE invTraits (
  typeID int(11) DEFAULT NULL,
  skillID int(11) DEFAULT NULL,
  bonus DOUBLE DEFAULT NULL,
  bonusText text,
  unitID int(11) DEFAULT NULL
);


create table skinLicense (licenseTypeID int primary key,duration int ,skinID int);
create table skinMaterials(skinMaterialID int primary key,material varchar(40),displayNameID int,colorWindow varchar(6),colorPrimary varchar(6),colorSecondary varchar(6),colorHull varchar (6));
create table skins (skinID int primary key,internalName varchar(70),skinMaterialID int);
create table skinShip (skinID int,typeID int,index (typeID),index(skinID));

CREATE TABLE invGroups (groupID int(11) NOT NULL,  categoryID int(11) DEFAULT NULL,  groupName varchar(100) DEFAULT NULL,  iconID int(11) DEFAULT NULL,  useBasePrice tinyint(1) DEFAULT NULL,  anchored tinyint(1) DEFAULT NULL,  anchorable tinyint(1) DEFAULT NULL,  fittableNonSingleton tinyint(1) DEFAULT NULL,  published tinyint(1) DEFAULT NULL,  PRIMARY KEY (groupID),  KEY invGroups_IX_category (categoryID));
CREATE TABLE invCategories (categoryID int(11) NOT NULL,categoryName varchar(100) DEFAULT NULL,iconID int(11) DEFAULT NULL,  published tinyint(1) DEFAULT NULL,  PRIMARY KEY (categoryID));
CREATE TABLE invTypes (typeID int(11) NOT NULL,groupID int(11) DEFAULT NULL,typeName varchar(100) DEFAULT NULL,description varchar(3000) DEFAULT NULL,mass double DEFAULT NULL,volume double DEFAULT NULL,capacity double DEFAULT NULL,portionSize int(11) DEFAULT NULL,raceID tinyint(3) unsigned DEFAULT NULL,basePrice decimal(19,4) DEFAULT NULL,published tinyint(1) DEFAULT NULL,marketGroupID int(11) DEFAULT NULL,graphicID int(11) DEFAULT NULL,iconID int(11) DEFAULT NULL,radius decimal(19,4) DEFAULT NULL,soundID int(11) DEFAULT NULL,PRIMARY KEY (typeID),KEY invTypes_IX_Group (groupID));

