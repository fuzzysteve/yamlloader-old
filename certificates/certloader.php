<?
/*
The table structure is:



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





The 'recommeded' data is being ignored, as it's a replica of the masteries data, excluding the level information. 


*/


$dbh = new PDO('mysql:host=localhost;dbname=eve', 'eve', 'eve');


$certificates=yaml_parse_file("certificates.yaml");

$certsql="insert into evesupport.certCerts (certID,description,groupid,name) values (:certid,:description,:groupid,:name)";
$recosql="insert into evesupport.certRecommendations (certID,recommendedFor) values (:certid,:recommendedfor)";
$skillsql="insert into evesupport.certSkills (certID,skillID,certLevelInt,certLevelText,skillLevel) values (:certid,:skillid,:certint,:certtext,:skillint)";

$certstmt=$dbh->prepare($certsql);
$recostmt=$dbh->prepare($recosql);
$skillstmt=$dbh->prepare($skillsql);

$skillmap=array("basic"=>0,"standard"=>1,"improved"=>2,"advanced"=>3,"elite"=>4);




foreach ($certificates as $certid => $certificate)
{

    $certstmt->execute(array(":certid"=>$certid,":description"=>$certificate["description"],":groupid"=>$certificate["groupID"],":name"=>$certificate["name"]));


    foreach ($certificate["skillTypes"] as $skillid => $levels)
    {
        foreach ($levels as $certlevel => $skilllevel)
        {
        $skillstmt->execute(array(":certid"=>$certid,":skillid"=>$skillid,":certint"=>$skillmap[$certlevel],":certtext"=>$certlevel,":skillint"=>$skilllevel));
        }

    }
}


$typeids=yaml_parse_file("typeIDs.yaml");

$masterysql="insert into evesupport.certMasteries(typeid,masterylevel,certid) values (:typeid,:level,:certid)";
$masterystmt=$dbh->prepare($masterysql);


#Only care about masteries, atm.

foreach ($typeids as $typeid=>$data)
{
    if (isset($data["masteries"]))
    {
        foreach ($data["masteries"] as $level => $certs)
        {
            foreach ($certs as $certid)
            {
                $masterystmt->execute(array(":typeid"=>$typeid,":level"=>$level,":certid"=>$certid));
            }
        }
    }




}





?>
