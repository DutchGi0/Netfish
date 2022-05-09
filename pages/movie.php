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
    <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.css"> -->
    <link rel="stylesheet" href="css/movies.css">
    <script src="js/jquery-3.6.0.min.js" defer></script>
    <script src="js/movies.js" defer></script>
    <!-- <script src="bootstrap/js/bootstrap.min.js" defer></script> -->
    <title>Netfish - Movies</title>
</head>
<body>
        <h1><span class="">M</span>ovies</h1>
        <br>
        <div class="media-scroller">
            <!-- Music -->
            <div class="media-group">
                <div class="media-element">
                    <?php
                    // get all movies from database
                    $stmt = $db->prepare(
                        'SELECT * FROM `movies` WHERE `genre` = "Music";'
                    );
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

                        echo '<img src="./img/movie_thumbnail/' .
                            $image .
                            '" alt="' .
                            $title .
                            '">';
                    }
                    ?>
                </div>
            </div>
            <!-- Science -->
            <div class="media-group">
                <div class="media-element">                
                    <?php
                    // get all movies from database
                    $stmt = $db->prepare(
                        'SELECT * FROM `movies` WHERE `genre` = "Science";'
                    );
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

                        echo '<img src="./img/movie_thumbnail/' .
                            $image .
                            '" alt="' .
                            $title .
                            '">';
                    }
                    ?>
                </div>
            </div>
            <!-- Music -->
            <div class="media-group">
                <div class="media-element">
                    <?php
                    // get all movies from database
                    $stmt = $db->prepare(
                        'SELECT * FROM `movies` WHERE `genre` = "Music";'
                    );
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

                        echo '<img src="./img/movie_thumbnail/' .
                            $image .
                            '" alt="' .
                            $title .
                            '">';
                    }
                    ?>
                </div>
            </div>
            <!-- Science -->
            <div class="media-group">
                <div class="media-element">                
                    <?php
                    // get all movies from database
                    $stmt = $db->prepare(
                        'SELECT * FROM `movies` WHERE `genre` = "Science";'
                    );
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

                        echo '<img src="./img/movie_thumbnail/' .
                            $image .
                            '" alt="' .
                            $title .
                            '">';
                    }
                    ?>
                </div>
            </div>
            <svg>
                <symbol id="next" viewBox="0 0 256 512">
                    <path fill="white"
                    d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z" />
                </symbol>

                <symbol id="previous" viewBox="0 0 256 512">
                    <path fill="white"
                    d="M31.7 239l136-136c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9L127.9 256l96.4 96.4c9.4 9.4 9.4 24.6 0 33.9L201.7 409c-9.4 9.4-24.6 9.4-33.9 0l-136-136c-9.5-9.4-9.5-24.6-.1-34z" />
                </symbol>
            </svg>
        </div>
</body>
</html>

<?php
} ?>
