<?php
require_once('portfolioLogic.php');
require_once('cmsController.php');
$abouts=FillAbout($db);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kyam Harris | Portfolio</title>
	<link rel="stylesheet" type="text/css" href="normalize.css">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,400,500,700" rel="stylesheet">
</head>
	
<body>
	<header>
		<nav class="container">
			<ul class="navLinks">
				<li><a href="#">Home</a></li>
				<li><a href="#about">About</a></li>
				<li><a href="#foot">Contact</a></li>
			</ul>
			<div class="title">
				<h1>Kyam Harris</h1>
				<h4><?php echo $abouts[0]['content']?></h4>
			</div>
			<section class="social">
				<a href="https://twitter.com/KyamLeigh" target="_blank" class="twitter"></a>
				<a href="https://github.com/marty-crane" target="_blank" class="github"></a>
				<a href="https://www.linkedin.com/in/kyam-harris-8715027a/" target="_blank" class="linkedIn"></a>
			</section>
			<div class="headImage">
				<div class="buttonHolder">
					<a href="#bigBox">
						<h2>View Portfolio</h2>
					</a>
				</div>
				<h4 id="about"><?php echo $abouts[2]['content']?>
				</h4>
				<p><?php echo $abouts[3]['content']?>
				</p>
				<div class="logoBox">
					<div class="logoForCSS"><img src="CSS3.png" alt="css logo"/></div>
					<div class="logoForHTML"><img src="html5.png" alt="html logo"/></div>
					<div class="logoForPHP"><img src="php.png" alt="php logo"/></div>
					<div class="logoForJS"><img src="JS.png" alt="Javascript logo"/></div>
					<div class="logoForCSM"><img src="csm.png" alt="CSM logo"/></div>
				</div>
			</div>
		</nav>
	</header>

	<main class="container clearfix" id="bigBox">
		<aside>
			<h3>Recent Articles</h3>
			<div class="blogs">
				<a href="https://dev.to/martycrane/the-first-two-weeks-at-mayden-academy--3i14">The first two week at Mayden Academy</a>
				<p>I have previously alluded to the fact
						that I caused myself a lot more grey hairs...</p>
			</div>
			<div class="blogs">
				<a href="https://dev.to/martycrane/the-start-of-a-new-journey--khl">A beginning..</a>
				<p>I had spent a large amount of the last 10 years regretting the fact
					that I had wasted my opportunity of...</p>
			</div>
		</aside>
		<div class="smPort" id="portfolio">
			<h1>Portfolio</h1>
			<?php echo createFirstPfItem($db);
			?>
            <?php echo createNonFirstPfItem($db);
            ?>

		</div>
	</main>
	<footer class="container" id="foot">
		<h4 class="email"><?php echo $abouts[1]['content']?></h4>
	</footer>
</body>
</html>