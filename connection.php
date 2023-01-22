<?php

try{
// $db = new PDO('mysql:host=sql204.epizy.com:3306;dbname=epiz_33168478_Itcs330project;charset=utf8','epiz_33168478','GwTsTB4HqLHbD');
// $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 $db = new PDO("mysql:host=localhost;dbname=project;charset=utf8",'root',);
 $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $err){
    // echo $err;
}


?>
