<?php
/*
The table structure is:

create table skinLicense (licenseTypeID int primary key,duration int ,skinID int);
create table skinMaterials(skinMaterialID int primary key,material varchar(40),
displayNameID int,colorWindow varchar(6),colorPrimary varchar(6),colorSecondary varchar(6),colorHull varchar (6));
create table skins (skinID int primary key,internalName varchar(70),skinMaterialID int);
create table skinShip (skinID int,typeID int,index (typeID),index(skinID));


*/

require_once("../config.php");
$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->beginTransaction();

$skins=yaml_parse_file("../skins.yaml");
$skinmaterials=yaml_parse_file("../skinMaterials.yaml");
$skinLicenses=yaml_parse_file("../skinLicenses.yaml");

$skinsql="insert into  $database.skins (skinID,internalName,skinMaterialID)
values (:skinid,:internalname,:skinmaterialid)";
$skinshipsql="insert into $database.skinShip (skinid,typeid) values (:skinid,:typeid)";

$materialsql=<<<EOS
insert into  $database.skinMaterials 
(skinMaterialID,material,displayNameID,colorWindow,colorPrimary,colorSecondary,colorHull) 
values 
(:skinmaterialid,:material,:displaynameid,:colorwindow,:colorprimary,:colorsecondary,:colorhull) 
EOS;
$licensesql="insert into  $database.skinLicense (licenseTypeID,duration,skinID) 
values (:licensetypeid,:duration,:skinid)";



$skinstmt=$dbh->prepare($skinsql);
$skinshipstmt=$dbh->prepare($skinshipsql);
$materialstmt=$dbh->prepare($materialsql);
$licensestmt=$dbh->prepare($licensesql);

foreach ($skins as $skinid => $skin) {
    $skinstmt->execute(array(
        ":skinid" => $skinid,
        ":internalname" => $skin["internalName"],
        ":skinmaterialid" => $skin["skinMaterialID"]
        ));
    foreach ($skin["types"] as $typeid) {
        $skinshipstmt->execute(array(
            ":skinid" => $skinid,
            ":typeid" => $typeid
        ));
    }
}

foreach ($skinmaterials as $skinmaterialid => $material) {
    $materialstmt->execute(array(
        ":skinmaterialid" => $skinmaterialid,
        ":material" => $material["material"],
        ":displaynameid" => $material["displayNameID"],
        ":colorwindow" => $material["colorWindow"],
        ":colorprimary" => $material["colorPrimary"],
        ":colorsecondary" => $material["colorSecondary"],
        ":colorhull" => $material["colorHull"]
        ));
}

foreach ($skinLicenses as $licenseid => $license) {
    $licensestmt->execute(array(
        ":licensetypeid" => $licenseid,
        ":duration" => $license["duration"],
        ":skinid" => $license["skinID"]
        ));
}

$dbh->commit();
