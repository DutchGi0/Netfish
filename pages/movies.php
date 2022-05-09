<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
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
    <script src="js/movies.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Netfish - Movies</title>
</head>
<body>
    <div class="container grid-container container--movie">
        <h1 class="page-title uppercase fs-900"><span class="text-red center">M</span>ovies</h1>

        <div class="row movies">
            <?php
            // get all movies from database
            $stmt = $db->prepare('SELECT * FROM movie');
            $stmt->execute();
            $movies = $stmt->fetchAll();

            // loop through all movies
            foreach ($movies as $movie) {
                $id = $movie['id'];
                $title = $movie['title'];
                $image = $movie['image'];
                $description = $movie['description'];
                $year = $movie['year'];
                $url = $movie['url'];

                $url =
                    '<iframe width="360" height="315" src="https://www.youtube.com/embed/' .
                    $url .
                    '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="margin:0; padding:0;"></iframe>';

                // Makes a card for all the movies

                echo '<div class="col-md-4"><br>';
                echo '<div class="card" data-id=' . $id . '>';
                echo '<img class="card-img-top" src="./img/movie_thumbnail/' .
                    $image .
                    '" alt="' .
                    $title .
                    '">';
                echo '<div class="card-body text-dark hidden " >';
                echo '<h5 class="card-title bold uppercase" >' .
                    $title .
                    '</h5>';
                echo '<p class="card-text" >' . $description . '</p>';
                echo '<p class="card-text" >' .
                    $year .
                    '</p> <button class="btn btn-primary movie" id="movie">Watch now</button>';

                echo '<div class="video hidden" id="movie"> ';
                echo '<br>';
                echo $url;
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <script>
        
    </script>
</body>
</html>

<?php
} ?>
