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
    <script src="js/movies.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Netfish - Edit movie</title>
</head>
<body>
<?php
$sql = 'SELECT * FROM movie WHERE ID= ?';
$stmt = $db->prepare($sql);
$stmt->execute([$_GET['id']]);
$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($movies as $movie) { ?>
<div class="container">
    <form class="form" action="index.php?page=movies_update" method="post">
        <h1 class="page-title uppercase"><span class="text-red center">E</span>dit movies</h1>
        <br>
        <input type="hidden" name="id" id="id" value="<?php echo $movie[
            'id'
        ]; ?>" />
        <div class="mb-3">
        <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $movie[
                'title'
            ]; ?>" />
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">URL:</label>
            <input type="text" class="form-control" id="url" name="url"  value="<?php echo $movie[
                'url'
            ]; ?>" />
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Year:</label>
            <input type="text" class="form-control" id="year" name="year"  value="<?php echo $movie[
                'year'
            ]; ?>" />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <input type="text" class="form-control" id="description" name="description"  value="<?php echo $movie[
                'description'
            ]; ?>" />
        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-dark">EDIT MOVIE</button>
        <span class="right"><a href="index.php?page=movie_overview" class="text-red" style="text-decoration: none;">Terug</a></span>
    </form>
</div>
<?php }

// Update movie
if (isset($_POST['submit'])) {
    $sql = 'UPDATE movie SET title=?, url=?, year=?, description=? WHERE ID=?';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $_POST['title'],
        $_POST['url'],
        $_POST['year'],
        $_POST['description'],
        $_POST['id'],
    ]);
    header('Location: index.php?page=movie_overview');
}
?>
</body>
</html>
<?php
} ?>
