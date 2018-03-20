<?php

$db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//populate form from DB for about

$query=$db->prepare("SELECT `name` FROM `staticContent`;");
$query->execute();
$aboutItems=$query->fetchall();


$query=$db->prepare("SELECT `name`,`content` FROM `staticContent`;");
$query->execute();
$aboutSection=$query->fetchall();
$mainSub=$aboutSection[2]['content'];
$about1=$aboutSection[0]['content'];
$about2=$aboutSection[1]['content'];
$email=$aboutSection[3]['content'];


//populate form from DB for
$query=$db->prepare("SELECT `title` FROM `portfolioItems`;");
$query->execute();
$pfItems=$query->fetchall();

$query=$db->prepare("SELECT `title` FROM `articles`");
$query->execute();
$artItems=$query->fetchall();


function makeDropDown($items){
    $resultString = "";
    foreach ($items as $item) {
        $resultString .= '<option value="' . $item['title'] . '">' . $item['title'] . '</option>';
    }
    echo $resultString;
}



$selectedItem=$_POST['itemSelect'];


$query=$db->prepare("SELECT `title`,`description`,`imgRef`,`projURL`,`github`,`images`.`URL`
                               FROM `portfolioItems`
                               LEFT JOIN `images`
                               ON `portfolioItems`.`imgRef`
                               =`images`.`id`
                               WHERE `title`='$selectedItem';");
$query->execute();
$wantedPfItem=$query->fetchall();


//select article
$artSelect=$_POST['artSelect'];
$query=$db->prepare("SELECT `id`,`title`,`description`, `URL`
                               FROM `articles`
                               WHERE `title`='$artSelect';");
$query->execute();
$wantedArt=$query->fetchall();

var_dump($_POST['subtitle']);



$query=$db->prepare("REPLACE INTO `staticContent`(`name`,`content`) VALUES();");

