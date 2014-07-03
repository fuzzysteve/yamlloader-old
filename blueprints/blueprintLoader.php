<?php
/*
The table structure is:

create table industryBlueprints(typeID int primary key,maxProductionLimit int);
create table industryActivity(typeID int,time int,activityTypeID int,
primary key(typeID,activityTypeID),index (activityTypeID));
create table industryActivityMaterials(typeID int,activityTypeID int,materialTypeID int,
quantity int,consume tinyint,index(typeID),index(typeID,activityTypeID));
create table industryActivityProducts(typeID int,activityTypeID int,productTypeID int,
quantity int,index(typeID),index(typeID,activityTypeID));
create table industryActivitySkills(typeid int,activityTypeID int,skillID int,level int,
index(typeID),index(typeID,activityTypeID));
create table industryActivityProbabilities(typeID int,activityTypeID int,productTypeID int,
probability float,index(typeID),index(typeID,activityTypeID),index(productTypeID));
create table industryActivityType(ActivityTypeID int primary key,description text);

TODO: Add extra the industryActivityType static here.

*/


$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$database="industry";

$blueprintsql="insert into $database.industryBlueprints(typeID,maxProductionLimit)
    values (:typeID,:maxProductionLimit)";
$blueprintstmt=$dbh->prepare($blueprintsql);
$activitysql="insert into $database.industryActivity(typeID,time,activityTypeID)
    values (:typeID,:time,:activityTypeID)";
$activitystmt=$dbh->prepare($activitysql);
$activitymaterialsql="insert into $database.industryActivityMaterials
    (typeID,activityTypeID,materialTypeID,quantity,consume)
    values (:typeID,:activityTypeID,:materialTypeID,:quantity,:consume)";
$activitymaterialstmt=$dbh->prepare($activitymaterialsql);
$activityproductssql="insert into $database.industryActivityProducts
    (typeID,activityTypeID,productTypeID,quantity)
    values (:typeID,:activityTypeID,:productTypeID,:quantity)";
$activityproductsstmt=$dbh->prepare($activityproductssql);
$activityskillssql="insert into $database.industryActivitySkills(typeID,activityTypeID,skillID,level)
    values (:typeID,:activityTypeID,:skillID,:level)";
$activityskillsstmt=$dbh->prepare($activityskillssql);
$activityprobabilitiessql="insert into $database.industryActivityProbabilities
    (typeID,activityTypeID,productTypeID,probability)
    values (:typeID,:activityTypeID,:productTypeID,:probability)";
$activityprobabilitiesstmt=$dbh->prepare($activityprobabilitiessql);





$blueprints=yaml_parse_file("blueprints.yaml");

foreach ($blueprints as $typeid => $data) {
    $blueprintstmt->execute(array(":typeID"=>$typeid,":maxProductionLimit"=>$data["maxProductionLimit"]));


    if (isset($data["activities"])) {
        foreach ($data["activities"] as $activityid => $activitydetails) {
            $activitystmt->execute(array(
                ":typeID"=>$typeid,
                ":activityTypeID"=>$activityid,
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
                        ":activityTypeID"=>$activityid,
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
                        ":activityTypeID"=>$activityid,
                        ":productTypeID"=>$productTypeid,
                        ":quantity"=>$product['quantity']
                    ));
                    if (isset($product['probability'])) {
                        $activityprobabilitiesstmt->execute(array(
                              ":typeID"=>$typeid,
                              ":activityTypeID"=>$activityid,
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
                        ":activityTypeID"=>$activityid,
                        ":skillID"=>$skillid,
                        ":level"=>$skill['level'],
                    ));
                }
            }
        }
    }
}
