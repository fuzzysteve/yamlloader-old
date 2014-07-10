<?php
/*


The table structure should be:

CREATE TABLE eveIcons (
  iconID int(11) NOT NULL,
  iconFile varchar(500) NOT NULL,
  description text,
  PRIMARY KEY (iconID)
);



*/


$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');

$database="sdebeta";

$typeids=yaml_parse_file("iconIDs.yaml");
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$iconsql="insert into $database.eveIcons (iconid,description,iconFile) values (:typeid,:description,:iconfile) on duplicate key update iconFile=:iconfile";
$iconnodescsql="insert into $database.eveIcons (iconid,iconFile) values (:typeid,:iconfile) on duplicate key update iconFile=:iconfile";

$iconstmt=$dbh->prepare($iconsql);
$iconnodescstmt=$dbh->prepare($iconnodescsql);





foreach ($typeids as $typeid => $details) {
    echo "$typeid\n";
    if (isset($details["description"])) {
        $iconstmt->execute(array(":typeid"=>$typeid,":description"=>$details["description"],":iconfile"=>$details["iconFile"]));
    } else {
        $iconnodescstmt->execute(array(":typeid"=>$typeid,":iconfile"=>$details["iconFile"]));
    }
   
}

