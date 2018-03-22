<?php

require_once('cmsController.php');
DeleteArticle($_POST,$db);
UpdateArticle($_POST,$db);
deletePfItem($_POST,$db);
updatePortfolio($_POST,$db);
updateAbout($_POST,$db);
$wantedArt= SelectArt($db,$_POST);
$artItems=ArticleList($db);
$wantedPfItem = portfolioFill($db,$_POST);
$pfItems=portfolioList($db);
$aboutSection=FillAbout($db);
$mainSub=$aboutSection[0]['content'];
$about1=$aboutSection[3]['content'];
$about2=$aboutSection[2]['content'];
$email=$aboutSection[1]['content'];
$imgArr=getImgDropDown($db);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kyam Harris | Edit page</title>
</head>
<body>
    <header>
        <h1>Portfolio edit & amend page</h1>
    </header>
    <main id="about">
        <h2>About me</h2>
        <form method="POST" action="cmsInput.php">
            <label for="subtitle">Subtitle</label>
            <input type="text" name="subtitle" value="<?php echo "$mainSub"; ?> ">
            <br>
            <label for="about1">About me 1</label>
            <textarea name="about1" type="text" cols="60" rows="6"> <?php echo"$about1"; ?></textarea>
            <br>
            <label for="about2">aboutMe2</label>
            <textarea name="about2" type="text" cols="60" rows="6"> <?php echo"$about2"; ?></textarea>
            <br>
            <label for="email">email</label>
            <input type="text" name="email" value="<?php echo "$email"; ?>">
            <br>
            <input type="submit" name="submitAbout" id="submitAbout">
        </form>
    </main>
    <main id="portfolio">
        <h2>Portfolio Items</h2>
        <div class="edit">
            <h3>Edit</h3>
            <form method="POST" action="cmsInput.php">
                <label for="itemSelect">Select item</label>
                <select name="itemSelect">
                    <?php echo makeDropDown($pfItems) ?>
                </select>
                <input type="submit" value="get">
            </form>
            <form method="POST" action="cmsInput.php">
                <label for="pfTitle">Portfolio Item title </label>
                <input type="text" name="pfTitle" value="<?php echo$wantedPfItem[0]['title']; ?>">
                <br>
                <label for="pfDesc">Portfolio Item description </label>
                <textarea name="pfDesc" type="text" cols="60" rows="8"><?php echo$wantedPfItem[0]['description']; ?></textarea>
                <br>
                <label for="pfURL">Item URL</label>
                <input type="text" name="pfURL" value="<?php echo$wantedPfItem[0]['projURL']; ?>">
                <br>
                <label for="githubURL">github URL</label>
                <input type="text" name="githubURL" value="<?php echo$wantedPfItem[0]['github']; ?>">
                <br>
                <label for="picSelect">Select picture</label>
                <select name="picSelect">
                    <?php echo makeImgDropDown($imgArr) ?>
                </select>
                <input type="submit" name="submitPf" if="submitPf">
                </form>
            </div>
        <div class="add">
            <h3>Add</h3>
            <form method="POST" action="cmsInput.php">
                <label for="pfTitle">Portfolio Item title </label>
                <input type="text" name="pfTitle" placeholder="Enter new item name here">
                <br>
                <label for="pfDesc">Portfolio Item description </label>
                <textarea name="pfDesc" type="text" cols="60" rows="8" placeholder="Enter your description here"></textarea>
                <br>
                <label for="pfURL">Item URL</label>
                <input type="text" name="pfURL" placeholder="Enter new item URL here">
                <br>
                <label for="githubURL">github URL</label>
                <input type="text" name="githubURL" placeholder="Enter new item repo URL here">
                <br>
                <label for="picSelect">Select picture</label>
                <select name="picSelect">
                    <?php echo makeImgDropDown($imgArr) ?>
                </select>
                <input type="submit" name="submitPf" if="submitPf">
            </form>
        </div>
        <div class="delete">
            <h3>Delete</h3>
            <form method="POST" action="cmsInput.php">
                <select name="pfDelete">
                    <?php echo makeDropDown($pfItems) ?>
                </select>
                <input type="submit" value="pfDelete">
            </form>
        </div>
    </main>
    <main id="articles">
        <h2>Articles</h2>
        <div>
            <h3>Edit</h3>
            <form method="POST" action="cmsInput.php">
                <label for="artSelect">Select item</label>
                <select name="artSelect">
                    <?php echo makeDropDown($artItems) ?>
                </select>
                <input type="submit" value="get">
            </form>
            <form method="POST" action="cmsInput.php">
                <label for="artTitle">Article title </label>
                <input type="text" name="artTitle" value="<?php echo $wantedArt[0]['title']; ?>">
                <br>
                <label for="artDesc">Article description </label>
                <textarea name="artDesc" type="text" cols="60" rows="8"><?php echo $wantedArt[0]['description']; ?></textarea>
                <br>
                <label for="artURL">Article URL</label>
                <input type="text" name="artURL" value="<?php echo $wantedArt[0]['URL']; ?>">
                <br>
                <input type="submit">
            </form>
        </div>
        <div class="add">
            <h3>Add</h3>
            <form method="POST" action="cmsInput.php">
                <label for="artTitle">Portfolio Item title </label>
                <input type="text" name="artTitle" placeholder="Enter new article title">
                <br>
                <label for="artDesc">Portfolio Item description </label>
                <textarea name="artDesc" type="text" cols="60" rows="8" placeholder="Enter new article description"></textarea>
                <br>
                <label for="artURL">Item URL</label>
                <input type="text" name="artURL" placeholder="Enter new article URL">
                <br>
                <input type="submit">
            </form>
        </div>
        <div class="delete">
            <h3>Delete</h3>
            <form method="POST" action="cmsInput.php">
                <select name="artDelete">
                    <?php echo makeDropDown($artItems) ?>
                </select>
            <input type="submit" value="Delete">
        </div>
    </main>
</body>
</html>