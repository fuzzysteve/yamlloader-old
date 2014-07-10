<?php
/*
The table structure is:

create table industryBlueprints(typeID int primary key,maxProductionLimit int);
create table industryActivity(typeID int,time int,activityID int,
primary key(typeID,activityID),index (activityID));
create table industryActivityMaterials(typeID int,activityID int,materialTypeID int,
quantity int,consume tinyint,index(typeID),index(typeID,activityID));
create table industryActivityProducts(typeID int,activityID int,productTypeID int,
quantity int,index(typeID),index(typeID,activityID));
create table industryActivitySkills(typeID int,activityID int,skillID int,level int,
index(typeID),index(typeID,activityID));
create table industryActivityProbabilities(typeID int,activityID int,productTypeID int,
probability decimal(3,2),index(typeID),index(typeID,activityID),index(productTypeID));

*/


$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$database="sdebeta";
$dbh->beginTransaction();

$blueprintsql="insert into $database.industryBlueprints(typeID,maxProductionLimit)
    values (:typeID,:maxProductionLimit)";
$blueprintstmt=$dbh->prepare($blueprintsql);
$activitysql="insert into $database.industryActivity(typeID,time,activityID)
    values (:typeID,:time,:activityID)";
$activitystmt=$dbh->prepare($activitysql);
$activitymaterialsql="insert into $database.industryActivityMaterials
    (typeID,activityID,materialTypeID,quantity,consume)
    values (:typeID,:activityID,:materialTypeID,:quantity,:consume)";
$activitymaterialstmt=$dbh->prepare($activitymaterialsql);
$activityproductssql="insert into $database.industryActivityProducts
    (typeID,activityID,productTypeID,quantity)
    values (:typeID,:activityID,:productTypeID,:quantity)";
$activityproductsstmt=$dbh->prepare($activityproductssql);
$activityskillssql="insert into $database.industryActivitySkills(typeID,activityID,skillID,level)
    values (:typeID,:activityID,:skillID,:level)";
$activityskillsstmt=$dbh->prepare($activityskillssql);
$activityprobabilitiessql="insert into $database.industryActivityProbabilities
    (typeID,activityID,productTypeID,probability)
    values (:typeID,:activityID,:productTypeID,:probability)";
$activityprobabilitiesstmt=$dbh->prepare($activityprobabilitiessql);





$blueprints=yaml_parse_file("blueprints.yaml");

foreach ($blueprints as $typeid => $data) {
    $blueprintstmt->execute(array(":typeID"=>$typeid,":maxProductionLimit"=>$data["maxProductionLimit"]));


    if (isset($data["activities"])) {
        foreach ($data["activities"] as $activityid => $activitydetails) {
            $activitystmt->execute(array(
                ":typeID"=>$typeid,
                ":activityID"=>$activityid,
                ":time"=>$activitydetails['time']
            ));
            if (isset($activitydetails['materials'])) {
                foreach ($activitydetails['materials'] as $materialTypeid => $material) {
                    $consume=1;
                    if (isset($material['consume']) and !$material['consume']) {
                        $consume=0;
                    }
                    $activitymaterialstmt->execute(array(
                        ":typeID"=>$typeid,
                        ":activityID"=>$activityid,
                        ":materialTypeID"=>$materialTypeid,
                        ":quantity"=>$material['quantity'],
                        ":consume"=>$consume
                    ));
                }
            }
            if (isset($activitydetails['products'])) {
                foreach ($activitydetails['products'] as $productTypeid => $product) {
                    $activityproductsstmt->execute(array(
                        ":typeID"=>$typeid,
                        ":activityID"=>$activityid,
                        ":productTypeID"=>$productTypeid,
                        ":quantity"=>$product['quantity']
                    ));
                    if (isset($product['probability'])) {
                        $activityprobabilitiesstmt->execute(array(
                              ":typeID"=>$typeid,
                              ":activityID"=>$activityid,
                              ":productTypeID"=>$productTypeid,
                              ":probability"=>$product['probability']
                        ));
                    }
                }
            }
            if (isset($activitydetails['skills'])) {
                foreach ($activitydetails['skills'] as $skillid => $skill) {
                    $activityskillsstmt->execute(array(
                        ":typeID"=>$typeid,
                        ":activityID"=>$activityid,
                        ":skillID"=>$skillid,
                        ":level"=>$skill['level'],
                    ));
                }
            }
        }
    }
}

$dbh->commit();
