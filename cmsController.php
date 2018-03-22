<?php
$db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/**
 * Gets about sections name, content from Db and turns into an array
 *
 * @param $db to select from
 * @return assoc array of about sections and content
 */
function FillAbout ($db) {
    $query=$db->prepare("SELECT `name`,`content` FROM `staticContent` WHERE `name` != 'submitAbout' ORDER BY `name` DESC;");
    $query->execute();
    return $query->fetchall();
}

/**
 * Gets portfolio items names from DB and turns into an array
 *
 * @param $db to select from
 * @return assoc array of pf item names
 */
function portfolioList ($db) {
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
function makeDropDown ($items) {
    $resultString = "";
    foreach ($items as $item) {
        $resultString .= '<option value="' . $item['title'] . '">' . $item['title'] . '</option>';
    }
    echo $resultString;
}

/**
 * Takes selected item POSTdata and selects values from DB based on POST value
 *
 * @param $db to select from
 * @param $postData user response for item to select
 * @return array of item values
 */
function portFolioFill ($db, $postData) {
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
 * @param $db to select from
 * @return array of articles
 */
function ArticleList ($db) {
    $query=$db->prepare("SELECT `title` FROM `articles` WHERE `deleted`!=1 ");
    $query->execute();
    return $query->fetchall();
}

/**
 * Takes selected article POSTdata and selects values from DB based on POST value
 *
 * @param $db to select from
 * @param $postData user response for article to select
 * @return array
 */
function SelectArt ($db, $postData) {
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
 * @param $postData used to test if function should run and informs what content should be added to DB
 * @param $db to add to
 */
function updateAbout ($postData, $db) {
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
 * @param $postData used to test if function should run and informs what content should be added to DB
 * @param $db to add to
 */
function updatePortfolio ($postData, $db) {
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
 * Takes list of Image names from DB and returns as a string
 *
 * @param $db to select from
 * @return string of options w/ values
 */
function makeImgDropDown ($db) {
    $query=$db->prepare("SELECT `id`,`name` FROM `images` WHERE `deleted` !=1;");
    $query->execute();
    $items=$query->fetchall();
    $resultString = "";
    foreach ($items as $item) {
        $resultString .= '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
    }
    echo $resultString;
}

/**
 * Updates the DB with deleted flag for selected portfolio item
 *
 * @param $postData used to test if function should run and informs what content should be added to DB
 * @param $db to amend
 */
function deletePfItem ($postData, $db) {
    if(array_key_exists('pfDelete',$postData)) {
        $item = $postData['pfDelete'];
        $query = $db->prepare("UPDATE `portfolioItems` SET `deleted`=1 WHERE `title`='$item';");
        $query->execute();
    }
}

/** Updates/adds Article based on name
 *
 * @param $postData used to test if function should run and informs what content should be added to DB
 * @param $db to add to
 */
function UpdateArticle ($postData, $db) {
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
 * @param $postData used to test if function should run and informs what content should be added to DB
 * @param $db to amend
 */
function DeleteArticle ($postData, $db) {
    if(array_key_exists('artDelete',$postData)) {
        $item = $postData['artDelete'];
        $query = $db->prepare("UPDATE `articles` SET `deleted`=1 WHERE `title`='$item';");
        $query->execute();
    }
}