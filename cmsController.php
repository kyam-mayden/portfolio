<?php
$db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/**
 * Gets about sections name, content from Db and turns into an array
 *
 * @param $db PDO to select from
 * @return assoc array of about sections and content
 */
function FillAbout (PDO $db):array {
    $query=$db->prepare("SELECT `name`,`content` FROM `staticContent` WHERE `name` != 'submitAbout' ORDER BY `name` DESC;");
    $query->execute();
    return $query->fetchAll();
}

/**
 * Gets portfolio items names from DB and turns into an array
 *
 * @param $db PDO to select from
 * @return assoc array of pf item names
 */
function portfolioList (PDO $db):array {
    $query=$db->prepare("SELECT `title` FROM `portfolioItems` WHERE `deleted`!=1;");
    $query->execute();
    return $query->fetchall();
}

/**
 * Takes an array of $items and turns into a string to make a drop-down list
 *
 * @param $items array of items (options) to be made into a drop-down
 * @return string of options
 */
function makeDropDown (array $items): string {
    $dropDownString = "";
    foreach ($items as $item) {
        $dropDownString .= '<option value="' . $item['title'] . '">' . $item['title'] . '</option>';
    }
    return $dropDownString;
}

/**
 * Takes selected item POSTdata and selects values from DB based on POST value
 *
 * @param $db PDO to select from
 * @param $postData assoc array  user response for item to select
 * @return array of item values
 */
function portFolioFill (PDO $db, array $postData):array {
    $selectedItem=$postData['itemSelect'];
    $query=$db->prepare("SELECT `title`,`description`,`imgRef`,`projURL`,`github`,`images`.`URL`
                               FROM `portfolioItems`
                               LEFT JOIN `images`
                               ON `portfolioItems`.`imgRef`
                               =`images`.`id`
                               WHERE `title`='$selectedItem' && `title` != 'submitPF';");
    $query->execute();
    return $query->fetchall();
}

/**
 * Gets list of articles from DB
 *
 * @param $db PDO to select from
 * @return array of articles
 */
function ArticleList (PDO $db):array {
    $query=$db->prepare("SELECT `title` FROM `articles` WHERE `deleted`!=1 ");
    $query->execute();
    return $query->fetchall();
}

/**
 * Takes selected article POSTdata and selects values from DB based on POST value
 *
 * @param $db PDO to select from
 * @param $postData assoc array userresponse for article to select
 * @return array
 */
function SelectArt (PDO $db, array $postData):array {
    $artSelect = $postData['artSelect'];
    $query = $db->prepare("SELECT `id`,`title`,`description`, `URL`
                               FROM `articles`
                               WHERE `title`='$artSelect';");
    $query->execute();
    return $query->fetchall();
}

/**
 * Updates About sections on DB
 *
 * @param $postData Array used to test if function should run and informs what content should be added to DB
 * @param $db to add to
 */
function updateAbout (array $postData,PDO $db) {
    if(array_key_exists('submitAbout',$postData)) {
        foreach($postData as $keys=>$values) {
            $query = $db->prepare("REPLACE INTO `staticContent`(`name`,`content`) VALUES (?,?)");
            $query->execute([$keys, $values]);
        }
    }
}

/**
 * Updates/adds Portfolio item based on Name
 *
 * @param $postData array used to test if function should run and informs what content should be added to DB
 * @param $db to add to
 */
function updatePortfolio (array $postData,PDO $db) {
    if(array_key_exists('submitPf',$postData)) {
        $query = $db->prepare("REPLACE INTO `portfolioItems`(`title`,`description`,`imgRef`,`projURL`,`github`)
                                     VALUES (:title, :descr, :picRef, :url, :github);");
        $query->bindValue(':title', $postData['pfTitle']);
        $query->bindValue(':descr', $postData['pfDesc']);
        $query->bindValue(':url', $postData['pfURL']);
        $query->bindValue(':github', $postData['githubURL']);
        $query->bindValue(':picRef', $postData['picSelect']);
        $query->execute();
    }
}

/**
 * Takes list of Image names from DB and returns an array
 *
 * @param $db PDO to select from
 * @return array of images, values
 */
function getImgDropDown (PDO $db):array {
    $query=$db->prepare("SELECT `id`,`name` FROM `images` WHERE `deleted` !=1;");
    $query->execute();
    $items=$query->fetchall();
    return $items;
}

/**
 * Takes array of images and creates a string of HTML options for each image
 *
 * @param $arr Array of images, values
 *
 * @return string of HTML options for images
 */
function makeImgDropDown (array $arr):string {
    $resultString = "";
    foreach ($arr as $item) {
        $resultString .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
    return $resultString;
}

/**
 * Updates the DB with deleted flag for selected portfolio item
 *
 * @param $postData Array used to test if function should run and informs what content should be added to DB
 * @param $db to amend
 */
function deletePfItem (array $postData,PDO $db) {
    if(array_key_exists('pfDelete',$postData)) {
        $item = $postData['pfDelete'];
        $query = $db->prepare("UPDATE `portfolioItems` SET `deleted`=1 WHERE `title`=:item;");
        $query->bindParam(':item',$item);
        $query->execute();
    }
}

/** Updates/adds Article based on name
 *
 * @param $postData Array used to test if function should run and informs what content should be added to DB
 * @param $db to add to
 */
function UpdateArticle (array $postData,PDO $db) {
    if(array_key_exists('artTitle',$postData)) {
        $query = $db->prepare("REPLACE INTO `articles`(`title`,`description`,`url`)
                              VALUES(:title, :descr, :url)");
        $query->bindParam(':title', $postData['artTitle']);
        $query->bindParam(':descr', $postData['artDesc']);
        $query->bindParam(':url', $postData['artURL']);
        $query->execute();
    }
}

/**
 * Updates the DB with a deleted flag for selected Article item
 *
 * @param $postData Array used to test if function should run and informs what content should be added to DB
 * @param $db to amend
 */
function DeleteArticle (array $postData,PDO $db) {
    if(array_key_exists('artDelete',$postData)) {
        $query = $db->prepare("UPDATE `articles` SET `deleted`=1 WHERE `title`=:item;");
        $query->bindParam(':item', $postData['artDelete']);
        $query->execute();
    }
}