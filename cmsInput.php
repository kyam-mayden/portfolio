<?php
session_start();

require_once('cmsLogic.php');
//var_dump($_POST['artSelect']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kyam Harris | Edit page</title>
    <link rel="stylesheet" type="text/css" href="cmsStyles.css">
</head>
<body>
    <form method="POST" action="logout.php">
        <input type="submit" value="Log out">
    </form>

    <header>
        <h1>Portfolio edit & amend page</h1>
    </header>
    <nav>
        <h3>Portfolio</h3>
        <a href=#portfolioEdit>Edit</a>
        <a href=#portfolioAdd>Add</a>
        <a href=#portfolioDelete>Delete</a>
        <h3>Articles</h3>
        <a href=#articleEdit>Edit</a>
        <a href=#articleAdd>Add</a>
        <a href=#articleDelete>Delete</a>
    </nav>
    <main id="about">
        <h2>About me</h2>
        <form method="POST" action="cmsInput.php">
            <div>
                <label for="subtitle">Subtitle</label>
                <input type="text" name="subtitle" value="<?php echo $mainSub; ?> ">
            </div>
            <div>
                <label for="about1">About me 1</label>
                <textarea name="about1" type="text" cols="60" rows="6"> <?php echo $about1; ?></textarea>
            </div>
            <div>
                <label for="about2">aboutMe2</label>
                <textarea name="about2" type="text" cols="60" rows="6"> <?php echo $about2; ?></textarea>
            </div>
            <div>
                <label for="email">email</label>
                <input type="text" name="email" value="<?php echo $email; ?>">
            </div>
            <input type="submit" name="submitAbout" id="submitAbout">
        </form>
    </main>
    <main id="portfolio">
        <h2>Portfolio Items</h2>
        <div class="edit" id="portfolioEdit">
            <h3>Edit</h3>
            <form method="POST" action="cmsInput.php">
                <label for="itemSelect">Select item</label>
                <select name="itemSelect">
                    <?php echo makeDropDown($pfItems); ?>
                </select>
                <input type="submit" value="get">
            </form>
            <form method="POST" action="cmsInput.php">
                <div>
                    <label for="pfTitle">Portfolio Item title </label>
                    <input type="text" name="pfTitle" value="<?php echo $wantedPfItem[0]['name']; ?>">
                </div>
                <div>
                    <label for="pfDesc">Portfolio Item description </label>
                    <textarea name="pfDesc" type="text" cols="60" rows="8"><?php echo $wantedPfItem[0]['description']; ?></textarea>
                </div>
                <div>
                    <label for="pfURL">Item URL</label>
                    <input type="text" name="pfURL" value="<?php echo $wantedPfItem[0]['projURL']; ?>">
                </div>
                <div>
                    <label for="githubURL">github URL</label>
                    <input type="text" name="githubURL" value="<?php echo $wantedPfItem[0]['github']; ?>">
                </div>
                <div>
                    <label for="picSelect">Select picture</label>
                    <select name="picSelect">
                        <?php echo makeDropDown($imgArr) ?>
                    </select>
                </div>
                <input type="submit" name="submitPf" if="submitPf">
                </form>
            </div>
        <div class="add" id="portfolioAdd">
            <h3>Add</h3>
            <form method="POST" action="cmsInput.php">
                <div>
                    <label for="pfTitle">Portfolio Item title </label>
                    <input type="text" name="pfTitle" placeholder="Enter new item name here">
                </div>
                <div>
                    <label for="pfDesc">Portfolio Item description </label>
                    <textarea name="pfDesc" type="text" cols="60" rows="8" placeholder="Enter your description here"></textarea>
                </div>
                <div>
                    <label for="pfURL">Item URL</label>
                    <input type="text" name="pfURL" placeholder="Enter new item URL here">
                </div>
                <div>
                    <label for="githubURL">github URL</label>
                    <input type="text" name="githubURL" placeholder="Enter new item repo URL here">
                </div>
                <div>
                    <label for="picSelect">Select picture</label>
                    <select name="picSelect">
                        <?php echo makeDropDown($imgArr) ?>
                    </select>
                </div>
                <input type="submit" name="submitPf">
            </form>
        </div>
        <div class="delete" id="portfolioDelete">
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
        <div id="articleEdit">
            <h3>Edit</h3>
            <form method="POST" action="cmsInput.php">
                <label for="artSelect">Select item</label>
                <select name="artSelect">
                    <?php echo makeDropDown($artItems) ?>
                </select>
                <input type="submit" value="get">
            </form>
            <form method="POST" action="cmsInput.php">
                <div>
                    <label for="artTitle">Article title </label>
                    <input type="text" name="artTitle" value="<?php echo $wantedArt[0]['name']; ?>">
                </div>
                <div>
                    <label for="artDesc">Article description </label>
                    <textarea name="artDesc" type="text" cols="60" rows="8"><?php echo $wantedArt[0]['description']; ?></textarea>
                </div>
                <div>
                    <label for="artURL">Article URL</label>
                    <input type="text" name="artURL" value="<?php echo $wantedArt[0]['URL']; ?>">
                </div>
                <input type="submit">
            </form>
        </div>
        <div class="add" id="articleAdd">
            <h3>Add</h3>
            <form method="POST" action="cmsInput.php">
                <div>
                    <label for="artTitle">Portfolio Item title </label>
                    <input type="text" name="artTitle" placeholder="Enter new article title">
                </div>
                <div>
                    <label for="artDesc">Portfolio Item description </label>
                    <textarea name="artDesc" type="text" cols="60" rows="8" placeholder="Enter new article description"></textarea>
                </div>
                <div>
                    <label for="artURL">Item URL</label>
                    <input type="text" name="artURL" placeholder="Enter new article URL">
                </div>
                <input type="submit">
            </form>
        </div>
        <div class="delete" id="articleDelete">
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