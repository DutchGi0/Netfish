<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (!isset($_SESSION['ID'])) {
    header('Location: index.php?page=login');
} else {
     ?>
<?php
$sql = 'SELECT * FROM user WHERE username = :username';
$stmt = $db->prepare($sql);
$stmt->execute([':username' => $_SESSION['USER_ID']]);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Netfish - Profile</title>
</head>
<?php foreach ($users as $user) {
    $id = $user['id']; ?>
<body>
    <div class="container">
        <h1 class='page-title uppercase'><span class='text-red'>A</span>ccount</h1>
        <br>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Account information</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo 'Name: ' . $user['name']; ?></td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo 'Email address: ' .
                            $_SESSION['E-MAIL']; ?></td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>Password: ********</td>
                        <?php echo "<td><span class='right uppercase'> <a class='btn btn-primary' href='index.php?page=profile_password_edit&id=" .
                            $user['id'] .
                            "'>Edit password</a></span></td>"; ?>
                    </tr>
                </tbody>
            </table>
            <?php
} ?>
    </div>
</body>
</html>

<?php
} ?>
