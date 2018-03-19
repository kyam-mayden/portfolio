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
            <input type="text" name="subtitle" value="placeholder">
            <input type="submit">
        </form>
        <form method="POST" action="cmsInput.php">
            <label for="aboutMe1">About me 1</label>
            <textarea name="aboutme1" type="text" cols="60" rows="8">placeholder</textarea>
            <input type="submit">
        </form>
        <form method="POST" action="cmsInput.php">
            <label for="aboutMe2">aboutMe2</label>
            <textarea name="aboutMe2" type="text" cols="60" rows="8">placeholder</textarea>
            <input type="submit">
        </form>
        <form method="POST" action="cmsInput.php">
            <label for="email">email</label>
            <input type="text" name="aboutMe2" value="email">
            <input type="submit">
        </form>
    </main>
    <main id="portfolio">
        <h2>Portfolio Items</h2>
        <div class="edit">
            <h3>Edit</h3>
            <form method="POST" action="cmsInput.php">
                <label for="itemSelect">Select item</label>
                <select name="itemSelect">
                    <?php echo 'Dropdown List' ?>
                </select>
                <input type="submit" value="get">
            </form>
            <form method="POST" action="cmsInput.php">
                <label for="pfTitle">Portfolio Item title </label>
                <input type="text" name="pfTitle" value="placeholder">
                <br>
                <label for="pfDesc">Portfolio Item description </label>
                <textarea name="pfDesc" type="text" cols="60" rows="8">placeholder</textarea>
                <br>
                <label for="pfURL">Item URL</label>
                <input type="text" name="pfURL" value="placeholder">
                <br>
                <label for="githubURL">github URL</label>
                <input type="text" name="githubURL" value="placeholder">
                <br>
                <label for="picSelect">Select picture</label>
                <select name="picSelect">
                    <?php echo 'Dropdown List' ?>
                </select>
                <input type="submit">
                </form>
            </div>
        <div class="add">
            <h3>Add</h3>
            <form method="POST" action="cmsInput.php">
                <label for="pfTitle">Portfolio Item title </label>
                <input type="text" name="pfTitle" value="placeholder">
                <br>
                <label for="pfDesc">Portfolio Item description </label>
                <textarea name="pfDesc" type="text" cols="60" rows="8">placeholder</textarea>
                <br>
                <label for="pfURL">Item URL</label>
                <input type="text" name="pfURL" value="placeholder">
                <br>
                <label for="githubURL">github URL</label>
                <input type="text" name="githubURL" value="placeholder">
                <br>
                <label for="picSelect">Add picture</label>
                <input type="submit">
            </form>
        </div>
        <div class="delete">
            <h3>Delete</h3>
            <select name="itemDelete">
                <?php echo 'Dropdown List' ?>
            </select>
            <input type="submit" value="Delete">
        </div>
    </main>
    <main id="articles">
        <h2>Articles</h2>
        <div>
            <h3>Edit</h3>
            <form method="POST" action="cmsInput.php">
                <label for="itemSelect">Select item</label>
                <select name="itemSelect">
                    <?php echo 'Dropdown List' ?>
                </select>
                <input type="submit" value="get">
            </form>
            <form method="POST" action="cmsInput.php">
                <label for="artTitle">Article title </label>
                <input type="text" name="artTitle" value="placeholder">
                <br>
                <label for="artDesc">Article description </label>
                <textarea name="artDesc" type="text" cols="60" rows="8">placeholder</textarea>
                <br>
                <label for="artURL">Article URL</label>
                <input type="text" name="artURL" value="placeholder">
                <br>
                <input type="submit">
            </form>
        </div>
        <div class="add">
            <h3>Add</h3>
            <form method="POST" action="cmsInput.php">
                <label for="artTitle">Portfolio Item title </label>
                <input type="text" name="artTitle" value="placeholder">
                <br>
                <label for="artDesc">Portfolio Item description </label>
                <textarea name="artDesc" type="text" cols="60" rows="8">placeholder</textarea>
                <br>
                <label for="pfURL">Item URL</label>
                <input type="text" name="pfURL" value="placeholder">
                <br>
                <input type="submit">
            </form>
        </div>
        <div class="delete">
            <h3>Delete</h3>
            <select name="artdelete">
                <?php echo 'Dropdown List' ?>
            </select>
            <input type="submit" value="Delete">
        </div>
    </main>
</body>
</html>
<?php
