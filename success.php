<?php include_once('process/_constant.php'); ?>

<?php


// if($_SESSION['login'] != true){

//     header('Location: index.php');die();

// }
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: index.php');
    die();
}

$voteId = isset($_GET['vote']) ? base64_decode($_GET['vote']) : '';

?>

<!doctype html>

<html lang="en">

    <head>

        <?php include_once('inc/head.php');?>

        <style>

            @import url('https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap');

/*

            html,body {

                font-family: 'Raleway', sans-serif;  

            }

*/

            .thankyou-page ._header {

                background: #ff6b02;

                padding: 100px 30px;

                text-align: center;

            }

            .thankyou-page ._header .logo {

                max-width: 200px;

                margin: 0 auto 50px;

            }

            .thankyou-page ._header .logo img {

                width: 100%;

            }

            .thankyou-page ._header h1 {

                font-size: 65px;

                font-weight: 800;

                color: white;

                margin: 0;

            }

            .thankyou-page ._body {

                margin: -70px 0 30px;

            }

            .thankyou-page ._body ._box {

                margin: auto;

                max-width: 80%;

                padding: 50px;

                background: white;

                border-radius: 3px;

                box-shadow: 0 0 35px rgba(10, 10, 10,0.12);

                -moz-box-shadow: 0 0 35px rgba(10, 10, 10,0.12);

                -webkit-box-shadow: 0 0 35px rgba(10, 10, 10,0.12);

            }

            .thankyou-page ._body ._box h2 {

                font-size: 32px;

                font-weight: 600;

                color: #4ab74a;

            }

            .thankyou-page ._footer {

                text-align: center;

                padding: 50px 30px;

            }



            .thankyou-page ._footer .btn {

                background: #4ab74a;

                color: white;

                border: 0;

                font-size: 14px;

                font-weight: 600;

                border-radius: 0;

                letter-spacing: 0.8px;

                padding: 20px 33px;

                text-transform: uppercase;

            }

        </style>

    </head>

    <body>

        <div class="thankyou-page">

            <div class="_header">

                <h1>Thank You!</h1>

            </div>

            <div class="container">

                <div class="_body">

                <div class="_box">

                    <p>

                        Thank you for your valuable time. <br><br>This to confirm that you’ve completed the voting process for EEMA elections 2022. The results will be announced shortly.

                        <br>

                        <br>

                        Regards,

                        <br>

                        <br>

                        Ernst and Young LLP (EY)<br>

                        Official Tabulators

                    </p>

                </div>

            </div>

            </div>

            

            <div class="_footer">

                <a class="btn" href="home.php">Back to homepage</a>

            </div>

        </div>

        <?php include_once('inc/footer.php');?>

    </body>

</html>