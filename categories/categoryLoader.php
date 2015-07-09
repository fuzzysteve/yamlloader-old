<?php
/*
The table structure is:


*/
ini_set('memory_limit', '256M');

$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');
require_once("../config.php");
$dbh->beginTransaction();
$typesql="insert into $database.invCategories
(categoryID,categoryName,iconID,published)
values 
(:categoryID,:categoryName,:iconID,:published)
";


$trnsql="insert into $database.trnTranslations
(tcID,keyID,languageID,text) 
values 
(:tcID,:keyID,:languageID,:text) 
";



$typestmt=$dbh->prepare($typesql);
$trnstmt=$dbh->prepare($trnsql);


$categories=yaml_parse_file("../categoryIDs.yaml");

foreach ($categories as $category => $data) {
    $typestmt->execute(array(
            ":categoryID"=>$category,
            ":categoryName"=>isset($data["name"]['en'])?$data["name"]['en']:'',
            ":iconID"=>isset($data["iconID"])?$data["iconID"]:null,
            ":published"=>isset($data["published"])?$data["published"]:null
            ));
    foreach ($data["name"] as $languageid => $name) {
        $trnstmt->execute(array(
            ":tcID"=>5,
            ":keyID"=>$category,
            ":languageID"=>$languageid,
            ":text"=>$name
        ));
    }
}
$dbh->commit();

exit;
