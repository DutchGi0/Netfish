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
    <title>Netfish - User overview</title>
</head>
<body>
    <div class="container">
        <h1 class='page-title uppercase'><span class='text-red'>U</span>ser <span class='text-red'>O</span>verview</h1>
        <br>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Admin</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = 'SELECT * FROM user';
            $stmt = $db->prepare($sql);
            $stmt->execute([]);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $user) {
                $id = $user['id'];
                if ($user['is_admin'] == 0) {
                    $admin = '<span class="text-red">&#10060;</span>';
                } else {
                    $admin = '<span class="text-green">&#10004;</span>';
                }
                echo '<tr>';
                echo '<td>' . $user['name'] . '</td>';
                echo '<td>' . $user['username'] . '</td>';
                echo '<td>' . $admin . '</td>';
                echo "<td><a style='text-decoration: none;' href='index.php?page=user_edit&id=" .
                    $user['id'] .
                    "'>&#9989;</a></td>";
                echo "<td><a onclick='javascript:confirmationDelete($(this));return false;' style='text-decoration: none;'  href='index.php?page=user_delete&id=" .
                    $user['id'] .
                    "'>&#10062;</a></td>";
            }
            ?>
            </tbody>
        </table>
</div>
<script>
    function confirmationDelete(anchor){
        var conf = confirm('Are you sure want to delete this user?');
        if(conf)
            window.location=anchor.attr("href");
    }
</script>
</body>
</html>
<?php
} ?>
