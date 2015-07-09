<?php
/*
The table structure is:


*/
ini_set('memory_limit', '256M');

$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');
require_once("../config.php");
$dbh->beginTransaction();
$typesql="insert into $database.invGroups
(groupID,categoryID,groupName,iconID,useBasePrice,anchored,anchorable,fittableNonSingleton,published)
values 
(:groupID,:categoryID,:groupName,:iconID,:useBasePrice,:anchored,:anchorable,:fittableNonSingleton,:published)
";


$trnsql="insert into $database.trnTranslations
(tcID,keyID,languageID,text) 
values 
(:tcID,:keyID,:languageID,:text) 
";



$typestmt=$dbh->prepare($typesql);
$trnstmt=$dbh->prepare($trnsql);


$groupids=yaml_parse_file("../groupIDs.yaml");

foreach ($groupids as $groupid => $data) {
    $typestmt->execute(array(
            ":groupID"=>$groupid,
            ":categoryID"=>isset($data["categoryID"])?$data["categoryID"]:null,
            ":groupName"=>isset($data["name"]["en"])?$data["name"]["en"]:'',
            ":iconID"=>isset($data["iconID"])?$data["iconID"]:null,
            ":useBasePrice"=>isset($data["useBasePrice"])?$data["useBasePrice"]=='false'?0:1:null,
            ":anchored"=>isset($data["anchored"])?$data["anchored"]=='false'?0:1:null,
            ":anchorable"=>isset($data["anchorable"])?$data["anchorable"]=='false'?0:1:null,
            ":fittableNonSingleton"=>isset($data["fittableNonSingleton"])?$data["fittableNonSingleton"]=='false'?0:1:null,
            ":published"=>isset($data["published"])?$data["published"]=='false'?0:1:null,
            ));
    foreach ($data["name"] as $languageid => $name) {
        $trnstmt->execute(array(
            ":tcID"=>7,
            ":keyID"=>$groupid,
            ":languageID"=>$languageid,
            ":text"=>$name
        ));
    }
}
$dbh->commit();

exit;
