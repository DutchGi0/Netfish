<?php
// if user isn't logged in and/or isn't admin redirect to login page
if (isset($_SESSION['ID'])) {
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
    <script src="js/password.js" defer></script>
    <script src="js/jquery-3.6.0.min.js" defer></script>
    <script src="bootstrap/js/bootstrap.min.js" defer></script>
    <title>Netfish - Login</title>
</head>
<body>
    <div class="container container--login">
        <h1 class='page-title uppercase'><span class='text-red'>L</span>ogin</h1>
        <br>
        <form method="POST">
            <div class="mb-3 text-white">
                <!-- login via email or username -->
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3 text-white">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                <input type="checkbox" onclick="showPassword()">Show Password
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button> 
            <span class="right">Forgot your password? <a style="text-decoration: none;" class="text-red" href="index.php?page=password_reset">Reset here</a></span>
            <br>
                <?php if (isset($_POST['submit'])) {
                    $error = '';
                    $username = htmlspecialchars($_POST['username']);
                    $password = htmlspecialchars($_POST['password']);
                    try {
                        $sql = 'SELECT * FROM user WHERE username = ?';
                        $stmt = $db->prepare($sql);
                        $stmt->execute([$username]);
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($result) {
                            $passwordInDB = $result['password'];
                            $rol = $result['is_admin'];
                            if (password_verify($password, $passwordInDB)) {
                                $_SESSION['ID'] = session_id();
                                $_SESSION['USER_ID'] = $result['username'];
                                $_SESSION['USER_NAME'] = $result['name'];
                                $_SESSION['E-MAIL'] = $result['email'];
                                $_SESSION['STATUS'] = 'ACTIEF';
                                $_SESSION['SUB'] = $result['subscription'];
                                $_SESSION['ROL'] = $rol;
                                if ($rol == 0) {
                                    echo "<script>location.href='index.php?page=movies'</script>";
                                } elseif ($rol == 1) {
                                    echo "<script>location.href='index.php?page=movie_overview'</script>";
                                } else {
                                    $error .= 'Access denied<br>';
                                }
                            } else {
                                $error .= 'Email or password is incorrect<br>';
                            }
                        } else {
                            $error .= 'Email or password is incorrect<br>';
                        }
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                    echo "<div class='alert alert-warning text-dark'>$error</div>";
                } ?>
            <br>
        </form>
    </div>
    <script>
        
    </script>
</body>
</html>
<?php
} ?>
