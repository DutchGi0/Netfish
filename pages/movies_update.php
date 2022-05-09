<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} elseif ($_SESSION['ROL'] == 0) {
    header('Location: index.php?page=movies');
} else {
     ?>
<?php if (isset($_POST['submit'])) {
    $id = htmlspecialchars($_POST['id']);
    $title = htmlspecialchars($_POST['title']);
    $url = htmlspecialchars($_POST['url']);
    $year = htmlspecialchars($_POST['year']);
    $description = htmlspecialchars($_POST['description']);
    $sql =
        'UPDATE movie SET `title` = ?, `url` = ?, `year` = ?, `description` = ? WHERE `ID` = ?';
    $stmt = $db->prepare($sql);
    try {
        $stmt = $stmt->execute([$title, $url, $year, $description, $id]);
        echo "<script>alert('Movie is updated');
            location.href='index.php?page=movie_overview';</script>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} ?>
<?php
} ?>
