<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __ROOT__ . '/DBconfig.php';

$loginst = 0;
if ($_SESSION['USER_ID']) {
    $user_check = $_SESSION['USER_ID'];

    $select_stat = $db->prepare(
        "SELECT * FROM user WHERE username = $user_check"
    );
    $select_stat->execute();
    $row = $select_stat->fetch(PDO::FETCH_ASSOC);

    $login_user = $row['username'];

    if (!empty($login_user)) {
        $loginst = 1;
    }
}

?>
