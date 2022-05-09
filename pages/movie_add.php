<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} elseif ($_SESSION['ROL'] == 0) {
    header('Location: index.php?page=movies');
} else {
     ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/jquery-3.6.0.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Netfish - Add Movie</title>
</head>
<body>
    <div class="container">
        <h1 class="page-title uppercase"><span class="text-red center">A</span>dd new movies</h1>   
        <br> 
        <form name="newmovie" class="form" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3 text-white">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="TitleHelp">
            </div>
            <div class="mb-3 text-white">
                <label for="url" class="form-label">Url:</label>
                <input type="text" class="form-control" name="url" id="url" aria-describedby="urlHelp">
                <small id="urlHelp" class="form-text text-muted">Fill in the video id example: watch?v=<span style="text-decoration: underline; font-weight: bold">pWC9aEBnP-o<span></small>
            </div>
            <div class="mb-2 text-white">
                <label for="year" class="form-label">Year:</label>
                <input type="text" class="form-control" name="year" id="year" aria-describedby="yearHelp">
            </div>
            <div class="mb-3 text-white">
                <label for="description" class="form-label">Description:</label>
                <input type="text" class="form-control" name="description" id="description" aria-describedby="DescriptionHelp">
            </div>
            <div class="mb-3 text-white">
                <label for="thumbnail" class="form-label">Upload thumbnail:</label>
                <input type="file" class="form-control" name="thumbnail" id="thumbnail">
            </div>
            <div class="mb-3 text-white">
                <label for="genre" class="form-label">Genre:</label>
                <input type="text" class="form-control" name="genre" id="genre" aria-describedby="GenreHelp">
            </div>
            <button class="btn btn-dark uppercase" name="submit" type="submit">Add new movie</button>
            <span class="right"><a class="text-red" style="text-decoration: none;" href="index.php?page=movie_overview">Back</a></span>

            <?php if (isset($_POST['submit'])) {
                // Uploads to server
                $target_dir = './img/movie_thumbnail/';
                $target_file =
                    $target_dir . basename($_FILES['thumbnail']['name']);
                $uploadOk = 1;
                $imageFileType = strtolower(
                    pathinfo($target_file, PATHINFO_EXTENSION)
                );

                // Check if image file is a actual image or fake image

                $check = getimagesize($_FILES['thumbnail']['tmp_name']);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo '<br>File is not an image.';
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo '<br>Sorry, file already exists.';
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES['thumbnail']['size'] > 500000) {
                    echo '<br>Sorry, your file is too large.';
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != 'jpg' &&
                    $imageFileType != 'png' &&
                    $imageFileType != 'jpeg' &&
                    $imageFileType != 'gif'
                ) {
                    echo '<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo '<br>Sorry, your file was not uploaded.';
                    // if everything is ok, try to upload file
                } else {
                    if (
                        move_uploaded_file(
                            $_FILES['thumbnail']['tmp_name'],
                            $target_file
                        )
                    ) {
                        echo '<br>The file ' .
                            htmlspecialchars(
                                basename($_FILES['thumbnail']['name'])
                            ) .
                            ' has been uploaded.';
                    } else {
                        echo '<br>Sorry, there was an error uploading your file.';
                    }
                }

                $error = '';
                $title = htmlspecialchars($_POST['title']);
                $url = htmlspecialchars($_POST['url']);
                $year = htmlspecialchars($_POST['year']);
                $genre = htmlspecialchars($_POST['genre']);
                $description = htmlspecialchars($_POST['description']);
                $target_file = htmlspecialchars($_FILES['thumbnail']['name']);

                $sql = "INSERT INTO movie (id, title, url, year, description, image, genre) 
                        VALUES (?,?,?,?,?,?,?)";
                $stmt = $db->prepare($sql);
                try {
                    $stmt->execute([
                        null,
                        $title,
                        $url,
                        $year,
                        $description,
                        $target_file,
                        $genre,
                    ]);
                    $error = '<br>New movie was successfully added';
                } catch (PDOException $e) {
                    $error = "Couldn't add movie." . $e->getMessage();
                }
                echo "<div id='error'>" . $error . '</div>';
            } ?>
    
        </form>
    </div>
</body>
</html>
<?php
} ?>
