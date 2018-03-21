<?php
$db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

function createFirstPfItem($db) {
    $query=$db->prepare("SELECT `title`,`description`,`imgRef`,`github`,`projURL`,`images`.`url`,`images`.`altText` 
                         FROM `portfolioItems` 
                         LEFT JOIN `images`
                         ON `portfolioItems`.`imgRef`
                         =`images`.`id`
                         WHERE `portfolioItems`.`deleted` !=1 LIMIT 1;");
    $query->execute();
    $result= $query->fetchAll();
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

$query=$db->prepare("SELECT `title`,`description`,`imgRef`,`github`,`images`.`url`,`images`.`altText` 
                         FROM `portfolioItems` 
                         LEFT JOIN `images`
                         ON `portfolioItems`.`imgRef`
                         =`images`.`id`
                         WHERE `portfolioItems`.`deleted` !=1 LIMIT 1;");

$query->execute();
$result= $query->fetchAll();
