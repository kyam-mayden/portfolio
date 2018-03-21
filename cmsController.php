<?php

$db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//populate form from DB for about

$query=$db->prepare("SELECT `name` FROM `staticContent`;");
$query->execute();
$aboutItems=$query->fetchall();


$query=$db->prepare("SELECT `name`,`content` FROM `staticContent` WHERE `name` != 'submitAbout' ORDER BY `name` DESC;");
$query->execute();
$aboutSection=$query->fetchall();

$mainSub=$aboutSection[0]['content'];
$about1=$aboutSection[3]['content'];
$about2=$aboutSection[2]['content'];
$email=$aboutSection[1]['content'];

//populate form from DB for Portfolio
$query=$db->prepare("SELECT `title` FROM `portfolioItems` WHERE `deleted`!=1;");
$query->execute();
$pfItems=$query->fetchall();


$query=$db->prepare("SELECT `title` FROM `articles` WHERE `deleted`!=1 ");
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
                               WHERE `title`='$selectedItem' && `title` != 'submitPF';");
$query->execute();
$wantedPfItem=$query->fetchall();


//select article
$artSelect=$_POST['artSelect'];
$query=$db->prepare("SELECT `id`,`title`,`description`, `URL`
                               FROM `articles`
                               WHERE `title`='$artSelect';");
$query->execute();
$wantedArt=$query->fetchall();



function updateAbout($postData) {
    $db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    foreach($postData as $keys=>$values) {
        $query = $db->prepare("REPLACE INTO `staticContent`(`name`,`content`) VALUES (?,?)");
        $query->execute([$keys, $values]);
    }
}

if(array_key_exists('submitAbout',$_POST)) {
    updateAbout($_POST);
} else {}

//var_dump($_POST);

function updatePortfolio($postData) {
    $db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $query = $db->prepare("REPLACE INTO `portfolioItems`(`title`,`description`,`imgRef`,`projURL`,`github`)
                                     VALUES (:title, :descr, :picRef, :url, :github);");
    $query->bindValue(':title',$postData['pfTitle']);
    $query->bindValue(':descr',$postData['pfDesc']);
    $query->bindValue(':url',$postData['pfURL']);
    $query->bindValue(':github',$postData['githubURL']);
    $query->bindValue(':picRef',$postData['picSelect']);
    $query->execute();
}

if(array_key_exists('submitPf',$_POST)) {
    updatePortfolio($_POST);

} else {}



//pictures

function makeImgDropDown(){
    $db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
    $query=$db->prepare("SELECT `id`,`name` FROM `images` WHERE `deleted` !=1;");
    $query->execute();
    $items=$query->fetchall();
    $resultString = "";
    foreach ($items as $item) {
        $resultString .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
    echo $resultString;
}

//delete an item

var_dump($_POST['pfDelete']);

function deletePfItem($postData,$db) {
    $item=$postData['pfDelete'];
    $query=$db->prepare("UPDATE `portfolioItems` SET `deleted`=1 WHERE `name`=$item;");
    $query->execute();
}

if(array_key_exists('pfDelete',$_POST)) {
    deletePfItem($_POST,$db);
}