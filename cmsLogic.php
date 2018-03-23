<?php
session_start();
require_once('cmsController.php');
$wantedArt = selectArticle($db,$_POST['artSelect']);
$artItems = articleList($db);
$wantedPfItem = portfolioFill($db,$_POST['itemSelect']);
$pfItems = portfolioList($db);
$aboutSection = fillAbout($db);
$mainSub = $aboutSection[0]['content'];
$about1 = $aboutSection[3]['content'];
$about2 = $aboutSection[2]['content'];
$email = $aboutSection[1]['content'];
$imgArr = getImgDropDown($db);

//if($_SESSION['loggedIn']===true) {
//echo "You are logged in";
//} elseif ($_SESSION['loggedIn']!==true) {
//header('Location: index.php');
//}

if(array_key_exists('submitAbout',$_POST)){
    updateAbout($_POST,$db);
};


if(array_key_exists('submitPf',$_POST)) {
    updatePortfolio($_POST,$db);
}

if(array_key_exists('pfDelete',$_POST)) {
    deletePortfolioItem($_POST,$db);
}

if(array_key_exists('artTitle',$_POST)) {
    updateArticle($_POST,$db);
}

if(array_key_exists('artDelete',$_POST)) {
    deleteArticle($_POST,$db);
}