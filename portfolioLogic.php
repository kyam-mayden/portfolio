<?php
require_once('cmsController.php');
$db = connectDatabase();

/**
 * Gets selected fields from database of first portfolio item
 *
 * @param $db PDO to select from
 * @return array of fields for item
 */
function getFirstPortfolioItem(PDO $db) {
    $query=$db->prepare("SELECT `portfolioItems`.`name`,`description`,`imgRef`,`github`,`projURL`,`images`.`url`,`images`.`altText` 
                         FROM `portfolioItems` 
                         LEFT JOIN `images`
                         ON `portfolioItems`.`imgRef`
                         =`images`.`id`
                         WHERE `portfolioItems`.`deleted` =0 LIMIT 1;");
    $query->execute();
    $result= $query->fetch();
    return $result;
}

/**
 * Takes first portofolio item fields and creates an html section
 *
 * @param $result Array of getFirstPfItem function
 *
 * @return string to build portfolio Item in HTML
 */
function createFirstPortfolioItem(array $result):string {
    return "<article class='primaryPfItem'>
				<section class='itemPic'>
					<img src=" . $result['url'] . " alt=" . $result['altText'] . "/>
				</section>
				<section class='itemText'>
					<h3>
						<a href='" . $result['projURL'] . "'>" . $result['name'] . "</a>
					</h3>
					<p>" . $result['description'] . "
					</p>
				</section>
			</article>";
}

/**
 * Gets selected fields from database of non-first portfolio items
 *
 * @param $db PDO to select from
 * @return array of fields for items
 */
function getNonFirstPortfolioItem(PDO $db) {
    $query=$db->prepare("SELECT `portfolioItems`.`name`,`description`,`imgRef`,`github`,`projURL`,`images`.`url`,`images`.`altText`
                         FROM `portfolioItems`
                         LEFT JOIN `images`
                         ON `portfolioItems`.`imgRef`
                         =`images`.`id`
                         WHERE `portfolioItems`.`deleted` =0  LIMIT 100 offset 1;"); //limit set as needed offset
    $query->execute();
    $result= $query->fetchAll();
    return $result;
}

/**
 * Takes non-first portofolio items fields and creates an html section
 *
 * @param $result Array result of getNonFirstPfItem function
 *
 * @return string to build portfolio Items in HTML
 */
function createNonFirstPortfolioItem(array $arr):string {
    $string="";
    foreach($arr as $result) {
        $string.="<article class='secondaryPfItem'>
				    <section class='itemPic'>
					    <img src=" . $result['url'] . " alt=" . $result['altText'] . "/>
				    </section>
				    <section class='itemText'>
					    <h3>
						    <a href='" . $result['projURL'] . "'>" . $result['name'] . "</a>
					    </h3>
					    <p>" . $result['description'] . "
					    </p>
				    </section>
			    </article>";
    }
    return $string;
}

/**
 * Gets all articles selected fields from DB
 *
 * @param $db PDO to select from
 *
 * @return array of articles, fields
 */
function getArticles(PDO $db) {
    $query=$db->prepare("SELECT `name`,`description`,`url` FROM `articles`
                                   WHERE `deleted`=0;");
    $query->execute();
    $result=$query->fetchAll();
    return $result;
}

/**
 * Creates HTML sections for articles with fields
 *
 * @param $articles Array result of getArticles function
 *
 * @return string of HTML to build section
 */
function createArticles(array $articles):string {
    $string="";
    foreach($articles as $article){
        $string.= "<div class='blogs'>
				<a href='" . $article['url'] . "'>" . $article['name'] . "</a>
				<p>" . $article['description'] . "</p>
			</div>";
    }
    return $string;
}