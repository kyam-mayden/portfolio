<?php
$db = new PDO('mysql:host=127.0.0.1; dbname=portfolioKyam', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

function createFirstPfItem($db) {
    $query=$db->prepare("SELECT `title`,`description`,`imgRef`,`projURL`,`github` FROM `portfolioItems` WHERE `deleted` !=1 LIMIT 1");
    $query->execute();
    $query->fetchall();

    return "<article class='primaryPfItem''>
				<section class='itemPic'>
					<img src='assets/pilot.png' alt='image of pilot website'/>
				</section>
				<section class='itemText'>
					<h3>
						<a href='#'>Pilot store</a>
					</h3>
					<p>Our first responsive web-page build has us mimicking the PilotShop website.
    The challenges of this were not only mimicking the site from its initial appearance,
						figuring our where the break-points needed to be and copying it's responses
						proved to be challenging.
					</p>
				</section>
			</article>";
}



$query=$db->prepare("SELECT `title`,`description`,`imgRef`,`projURL`,`github` FROM `portfolioItems` WHERE `deleted` !=1 && `title` ='Pilot Store' LIMIT 1");
$query->execute();
$results=$query->fetchall();

var_dump($results);