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
    echo "db updated";
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
    $query->bindValue(':picRef',$postData['picRef']);
    $query->execute();
}

if(array_key_exists('submitPf',$_POST)) {
    updatePortfolio($_POST);
    echo "db updated PF";
} else { echo "db not update PF";}

