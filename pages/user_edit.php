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
    <title>Netfish - Edit User</title>
</head>
<body>
<?php
$sql = 'SELECT * FROM user WHERE ID= ?';
$stmt = $db->prepare($sql);
$stmt->execute([$_GET['id']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($users as $user) { ?>
<div class="container">
    <form class="form" action="index.php?page=user_update" method="post">
        <h1 class="page-title uppercase"><span class="text-red center">E</span>dit User</h1>
        <br>
        <input type="hidden" name="id" id="id" value="<?php echo $user[
            'id'
        ]; ?>" />
        <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $user[
                'name'
            ]; ?>"/>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username"  value="<?php echo $user[
                'username'
            ]; ?>" readonly/>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email"  value="<?php echo $user[
                'email'
            ]; ?>" readonly/>
        </div>
        <div class="mb-3">
            <label for="is_admin" class="form-label">Is admin:</label>
            <select class="form-control" id="is_admin" name="is_admin">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>

        </div>
        <br>
        <button type="submit" name="submit" class="btn btn-dark uppercase">EDIT USER</button>
        <span class="right"><a href="index.php?page=user_overview" class="text-red" style="text-decoration: none;">Back</a></span>
    </form>
</div>
<?php }

// Update movie
if (isset($_POST['submit'])) {
    $sql =
        'UPDATE user SET name = :name, username = :username, is_admin = :is_admin WHERE ID = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':name' => $_POST['name'],
        ':username' => $_POST['username'],
        ':is_admin' => $_POST['is_admin'],
        ':id' => $_POST['id'],
    ]);
    header('Location: index.php?page=user_overview');
}
?>
</body>
</html>
<?php
} ?>
