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
    $name = htmlspecialchars($_POST['name']);
    $username = htmlspecialchars($_POST['username']);
    $is_admin = htmlspecialchars($_POST['is_admin']);
    $sql =
        'UPDATE user SET `name` = ?, `username` = ?, `is_admin` = ? WHERE `ID` = ?';
    $stmt = $db->prepare($sql);
    try {
        $stmt = $stmt->execute([$name, $username, $is_admin, $id]);
        echo "<script>alert('User is updated');
            location.href='index.php?page=user_overview';</script>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} ?>
<?php
} ?>
