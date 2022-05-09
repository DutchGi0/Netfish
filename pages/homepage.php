<?php
//get the url of the movie from the database with pdo
$sql = 'SELECT * FROM movie WHERE id = 7';
$stmt = $db->prepare($sql);
$stmt->execute([]);
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($movies as $movie) {
    $url = $movie['url'];
}
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
    <title>Netfish - Home</title>
</head>
<body>
    <div class="grid-container container-fluid container--home">
        <div class="intro" id='intro'>
            <h1 class='page-title'><span class='text-red'>W</span>elcome to <span class='text-red'>N</span>etfish</h1>
            <br>
            <p>
                This is a website for watching movies and TV shows.
            </p>

        </div>
        <div class="video" id='video'>
            <?php echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' .
                $url .
                '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'; ?>
        </div>
    </div>
</body>
</html>