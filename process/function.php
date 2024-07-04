<?php

extract($_POST);



// Function to get the client IP address

function get_client_ip() {

    $ipaddress = '';

    if (isset($_SERVER['HTTP_CLIENT_IP']))

        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];

    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))

        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];

    else if(isset($_SERVER['HTTP_X_FORWARDED']))

        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];

    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))

        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];

    else if(isset($_SERVER['HTTP_FORWARDED']))

        $ipaddress = $_SERVER['HTTP_FORWARDED'];

    else if(isset($_SERVER['REMOTE_ADDR']))

        $ipaddress = $_SERVER['REMOTE_ADDR'];

    else

        $ipaddress = 'UNKNOWN';

    return $ipaddress;

}



$ipAddress = get_client_ip();

if(isset($_POST['action'])) {
    $action =$_POST['action'];
} else {
    $action = '';
}

// die($action);

if($action == 'login'){

    // print("hello");die();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // print "SELECT * FROM voters_tbl WHERE email = '{$username}' AND password = '".md5($password)."'"; die();
    $sql = $mysqli->query("SELECT * FROM voters_tbl WHERE email = '{$username}' AND password = '".md5($password)."'");

    if($sql->num_rows > 0){

        $res = $sql->fetch_assoc();

        session_regenerate_id();

        

        $_SESSION['login'] = true;

        $_SESSION['userData'] = $res;

//        $_SESSION['voteCat'] = $vCatArr;

        header('Location: home.php');die();

    }else{

        $_SESSION['error'] = 'Invalid Username or Password.';

        header('Location: index.php');die();

    }

}

if($action == 'logout'){

    session_regenerate_id();

    unset($_SESSION);

    session_destroy();

    header('Location: index.php');die();

}

if($action == 'submitVote'){

    $cand = $votefor ? base64_decode($votefor) : '';

    $cat = $catId ? base64_decode($catId) : '';

    $voterId = $_SESSION['userData']['id'];

    

    if($cand == '' || $cat == ''){

        header('Location: home.php?error=100');die();

    }

    

    $canCheckSql = $mysqli->query("SELECT id FROM candidate_tbl WHERE id = '{$cand}'");

    $catCheckSql = $mysqli->query("SELECT id FROM nomination_category_tbl WHERE id = '{$cat}'");

    $checkVote = $mysqli->query("SELECT id FROM vote_tbl WHERE candidate_id = '{$cand}' AND voter_id = '{$voterId}'");

    

    

    if($canCheckSql->num_rows == 0){

        header('Location: home.php?error=101');die();

    }

    if($catCheckSql->num_rows == 0){

        header('Location: home.php?error=102');die();

    }

    if($checkVote->num_rows > 0){

        header('Location: home.php?error=500');die();

    }



    $voteSql = $mysqli->query("INSERT INTO vote_tbl SET candidate_id = '{$cand}', voter_id = '{$voterId}', category_id = '{$cat}', ip_address = '{$ipAddress}'");

    $lastId = $mysqli->insert_id;

    $encLastId = base64_encode($lastId);

    

    $existingCat = $mysqli->query("SELECT completed_category FROM voters_tbl WHERE id = '{$voterId}'");

    $selCategory = $existingCat->fetch_assoc();

    

    if($selCategory['completed_category'] == ''){

        $sqlUp = $mysqli->query("UPDATE voters_tbl SET completed_category = '{$cat}' WHERE id = '{$voterId}'");

    }else{

        $sqlUp = $mysqli->query("UPDATE voters_tbl SET completed_category = CONCAT(completed_category, ',','" . $cat . "') WHERE id = '{$voterId}'");

    }

    

    if($sqlUp){

        header("Location: vote.php");die();

    }

}

?>