<?php die(); include_once('process/_constant.php'); ?>
<?php
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@$%&';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$sqlG = $mysqli->query("SELECT id FROM voters_tbl ORDER BY id ASC");

while($resG = $sqlG->fetch_assoc()){
    $uid = $resG['id'];
    $pass = generateRandomString();
    $passMD = md5($pass);
    
    $up = $mysqli->query("UPDATE voters_tbl SET password_raw = '{$pass}', password = '{$passMD}' WHERE id = '{$uid}'");
}
?>