<?php
/*
The table structure is:


*/

$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
require_once("../config.php");
$dbh->beginTransaction();
$typesql="insert into $database.invTypes
(typeID,groupID,typeName,description,mass,volume,capacity,portionSize,raceID,basePrice,published,marketGroupID,graphicID,iconID,radius,soundID)
values 
(:typeID,:groupID,:typeName,:description,:mass,:volume,
:capacity,:portionSize,:raceID,:basePrice,:published,:marketGroupID,:graphicID,:iconID,:radius,:soundID)
";


$trnsql="insert into $database.trnTranslations
(tcID,keyID,languageID,text) 
values 
(:tcID,:keyID,:languageID,:text) 
";



$typestmt=$dbh->prepare($typesql);
$trnstmt=$dbh->prepare($trnsql);


$typeids=yaml_parse_file("../typeIDs.yaml");

foreach ($typeids as $typeid => $data) {
    $typestmt->execute(array(
            ":typeID"=>$typeid,
            ":groupID"=>isset($data["groupID"])?$data["groupID"]:null,
            ":typeName"=>isset($data["name"]['en'])?$data["name"]['en']:'',
            ":description"=>isset($data['description']['en'])?$data["description"]['en']:'',
            ":mass"=>isset($data["mass"])?$data["mass"]:null,
            ":volume"=>isset($data["volume"])?$data["volume"]:null,
            ":capacity"=>isset($data["capacity"])?$data["capacity"]:null,
            ":portionSize"=>isset($data["portionSize"])?$data["portionSize"]:null,
            ":raceID"=>isset($data["raceID"])?$data["raceID"]:null,
            ":basePrice"=>isset($data["basePrice"])?$data["basePrice"]:null,
            ":published"=>isset($data["published"])?$data["published"]==0?0:1:0,
            ":marketGroupID"=>isset($data["marketGroupID"])?$data["marketGroupID"]:null,
            ":graphicID"=>isset($data["graphicID"])?$data["graphicID"]:null,
            ":iconID"=>isset($data["iconID"])?$data["iconID"]:null,
            ":radius"=>isset($data["radius"])?$data["radius"]:null,
            ":soundID"=>isset($data["soundID"])?$data["soundID"]:null
            ));
    foreach ($data["name"] as $languageid => $name) {
        $trnstmt->execute(array(
            ":tcID"=>8,
            ":keyID"=>$typeid,
            ":languageID"=>$languageid,
            ":text"=>$name
        ));
    }

    if (isset($data["description"])) {
        foreach ($data["description"] as $languageid => $description) {
            $trnstmt->execute(array(
                ":tcID"=>33,
                ":keyID"=>$typeid,
                ":languageID"=>$languageid,
                ":text"=>$description
            ));
        }
    }
}
$dbh->commit();

exit;
