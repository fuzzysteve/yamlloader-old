<?php
/*
The table structure is:



CREATE TABLE invTraits (
  typeID int(11) DEFAULT NULL,
  skillID int(11) DEFAULT NULL,
  bonus int(11) DEFAULT NULL,
  bonusText text,
  unitID int(11) DEFAULT NULL
);

*/


$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');



$traitsql="insert into sderubicon11.invTraits
(typeID,skillID,bonus,bonusText,unitID)values (:typeid,:skillid,:bonus,:bonustext,:unitid)";

$traitstmt=$dbh->prepare($traitsql);


$typeids=yaml_parse_file("typeIDs.yaml");

foreach ($typeids as $typeid => $data) {
    if (isset($data["traits"])) {
        foreach ($data["traits"] as $trait => $details) {
            foreach ($details as $detail) {
                if (!isset($detail["bonus"])) {
                    $detail["bonus"]=null;
                }
                if (!isset($detail["unitID"])) {
                    $detail["unitID"]=null;
                }
                $traitstmt->execute(array(
                    ":typeid"=>$typeid,
                    ":skillid"=>$trait,
                    ":bonus"=>$detail["bonus"],
                    ":bonustext"=>$detail["bonusText"],
                    ":unitid"=>$detail["unitID"]));
            }
        }
    }
}
