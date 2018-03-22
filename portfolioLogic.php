<?php
$db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

/**
 * Gets selected fields from database of first portfolio item
 *
 * @param $db to select from
 * @return array of fields for item
 */
function getFirstPfItem($db) {
    $query=$db->prepare("SELECT `title`,`description`,`imgRef`,`github`,`projURL`,`images`.`url`,`images`.`altText` 
                         FROM `portfolioItems` 
                         LEFT JOIN `images`
                         ON `portfolioItems`.`imgRef`
                         =`images`.`id`
                         WHERE `portfolioItems`.`deleted` !=1 LIMIT 1;");
    $query->execute();
    $result= $query->fetchAll();
    return $result;
}

/**
 * Takes first portofolio item fields and creates an html section
 *
 * @param $result of getFirstPfItem function
 *
 * @return string of hmtl including item fields
 */
function createFirstPfItem($result){
    return "<article class='primaryPfItem'>
				<section class='itemPic'>
					<img src=" . $result[0]['url'] . " alt=" . $result[0]['altText'] . "/>
				</section>
				<section class='itemText'>
					<h3>
						<a href='" . $result[0]['projURL'] . "'>" . $result[0]['title'] . "</a>
					</h3>
					<p>" . $result[0]['description'] . "
					</p>
				</section>
			</article>";
}

/**
 * Gets selected fields from database of non-first portfolio items
 *
 * @param $db to select from
 * @return array of fields for items
 */
function getNonFirstPfItem($db) {
    $query=$db->prepare("SELECT `title`,`description`,`imgRef`,`github`,`projURL`,`images`.`url`,`images`.`altText`
                         FROM `portfolioItems`
                         LEFT JOIN `images`
                         ON `portfolioItems`.`imgRef`
                         =`images`.`id`
                         WHERE `portfolioItems`.`deleted` !=1  LIMIT 100 offset 1;"); //limit set as needed offset
    $query->execute();
    $result= $query->fetchAll();
    return $result;
}

/**
 * Takes non-first portofolio items fields and creates an html section
 *
 * @param $result result of getNonFirstPfItem function
 *
 * @return string of hmtl including items fields
 */
function createNonFirstPfItem($arr){
    $string="";
    foreach($arr as $result) {
        $string.="<article class='secondaryPfItem'>
				    <section class='itemPic'>
					    <img src=" . $result['url'] . " alt=" . $result['altText'] . "/>
				    </section>
				    <section class='itemText'>
					    <h3>
						    <a href='" . $result['projURL'] . "'>" . $result['title'] . "</a>
					    </h3>
					    <p>" . $result['description'] . "
				    </section>
			    </article>";
    }
    return $string;
}


/**
 * Gets all articles selected fields from DB
 *
 * @param $db to select from
 *
 * @return array of articles, fields
 */
function getArticles($db) {
    $query=$db->prepare("SELECT `title`,`description`,`url` FROM `articles`;");
    $query->execute();
    $result=$query->fetchAll();
    return $result;
}

/**
 * Creates HTML sections for articles with fields
 *
 * @param $arr result of getArticles function
 *
 * @return string of HTML to build section
 */
function createArticles($arr){
    $string="";
    foreach($arr as $result){
        $string.= "<div class='blogs'>
				<a href='" . $result['url'] . "'>" . $result['title'] . "</a>
				<p>" . $result['description'] . "</p>
			</div>";
    }
    return $string;
}