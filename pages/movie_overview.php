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
    <title>Netfish - Movie overview</title>
</head>
<body>
    <div class="container">
        <h1 class='page-title uppercase'><span class='text-red'>M</span>ovie <span class='text-red'>O</span>verview</h1>
        <br>
        <!-- The movie overview, you can edit and delete movies from this overview -->
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Year</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = 'SELECT * FROM movie';
            $stmt = $db->prepare($sql);
            $stmt->execute([]);
            $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($movies as $movie) {
                $id = $movie['id'];
                echo '<tr>';
                echo '<td>' . $movie['title'] . '</td>';
                echo '<td>' . $movie['year'] . '</td>';
                echo "<td><a style='text-decoration: none;' href='index.php?page=movies_edit&id=" .
                    $movie['id'] .
                    "'>&#9989;</a></td>";
                echo "<td><a onclick='javascript:confirmationDelete($(this));return false;' style='text-decoration: none;'  href='index.php?page=movies_delete&id=" .
                    $movie['id'] .
                    "'>&#10062;</a></td>";
            }
            ?>
            </tbody>
        </table>
</div>
<script>
    function confirmationDelete(anchor){
        var conf = confirm('Are you sure want to delete this movie?');
        if(conf)
            window.location=anchor.attr("href");
    }
</script>
</body>
</html>
<?php
} ?>
