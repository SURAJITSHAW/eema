<?php include_once('process/_constant.php'); ?>

<?php


if ($_SESSION['login'] != true) {

  header('Location: index.php');
  die();
}

// print_r($_SESSION['userData']);

$voterId = $_SESSION['userData']['id'];

$userZone = strtolower($_SESSION['userData']['zone']);

$sqlStatus = $mysqli->query("SELECT category_id FROM vote_tbl WHERE voter_id = '{$voterId}'");

$voteStatus = array();

while ($v = $sqlStatus->fetch_assoc()) {

  $voteStatus[] = $v['category_id'];
}

?>

<!doctype html>

<html lang="en">

<head>

  <?php include_once('inc/head.php'); ?>

  <link href="assets/css/sidebars.css" rel="stylesheet">

  <style>
    .bd-placeholder-img {

      font-size: 1.125rem;

      text-anchor: middle;

      -webkit-user-select: none;

      -moz-user-select: none;

      user-select: none;

    }



    @media (min-width: 768px) {

      .bd-placeholder-img-lg {

        font-size: 3.5rem;

      }

    }



    .b-example-divider {

      height: 3rem;

      background-color: rgba(0, 0, 0, .1);

      border: solid rgba(0, 0, 0, .15);

      border-width: 1px 0;

      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);

    }



    .b-example-vr {

      flex-shrink: 0;

      width: 1.5rem;

      height: 100vh;

    }



    .bi {

      vertical-align: -.125em;

      fill: currentColor;

    }



    .nav-scroller {

      position: relative;

      z-index: 2;

      height: 2.75rem;

      overflow-y: hidden;

    }



    .nav-scroller .nav {

      display: flex;

      flex-wrap: nowrap;

      padding-bottom: 1rem;

      margin-top: -1px;

      overflow-x: auto;

      text-align: center;

      white-space: nowrap;

      -webkit-overflow-scrolling: touch;

    }
  </style>

</head>

<body>

  <div class="container-fluid p-0">

    <main class="d-flex flex-nowrap">

      <div class="d-flex flex-column flex-shrink-0 text-bg-dark col-md-3 vpos">

        <a href="/home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="width: 100%; background: #fff; padding: 15px 0; border-right: 2px solid RGBA(33,37,41,var(--bs-bg-opacity,1))!important">

          <span class="fs-4" style="display: inline-block; margin: auto;">

            <img src="assets/images/1589541348_YDHggT_EEMA_logo_Revised.jpg" class="img-fluid" alt="EEMA" style="max-width: 200px;">

          </span>

        </a>

        <!--            <hr>-->

        <ul class="nav nav-pills mb-auto p-3">

          <?php if ($_SESSION['userData']['membership'] === 'platinum') { ?>

            <h2 style="font-size: 14px; color: #000; font-weight: bold; text-transform: uppercase; margin-top: 2rem; padding: 10px; text-align: left;background: #fff;">
              <i class="fa-solid fa-circle-chevron-right" style="color: #ff6b02;"></i> National Executive Committee
            </h2>

            <?php



            $catSql = $mysqli->query("SELECT id,position_type FROM nomination_category_tbl WHERE status = '1' AND zone = 'all'");

            while ($catres = $catSql->fetch_assoc()) {



              $checkDDsql = $mysqli->query("SELECT id from candidate_tbl WHERE category_id = '{$catres['id']}'");

              if ($checkDDsql->num_rows < 1) {
                continue;
              }

            ?>

              <li>

                <a href="vote.php?uid=<?= base64_encode($catres['id']); ?>" class="nav-link text-white">
                  <span class="vstatus <?php if (in_array($catres['id'], $voteStatus)) {
                                          echo 'g';
                                        } else {
                                          echo 'r';
                                        } ?>">
                  </span>
                  <?= $catres['position_type']; ?>
                </a>

              </li>

          <?php }
          } ?>

          <?php

          if ($userZone) {

            echo '<h2 style="font-size: 14px; color: #000; font-weight: bold; text-transform: uppercase; margin-top: 2rem; padding: 10px; text-align: left;background: #fff;"><i class="fa-solid fa-circle-chevron-right" style="color: #ff6b02;"></i> Zonal Committees (' . $userZone . ')</h2>';



            $catSqlZ = $mysqli->query("SELECT id,position_type,zone FROM nomination_category_tbl WHERE status = '1' AND zone = '{$userZone}'");

            while ($catresZ = $catSqlZ->fetch_assoc()) {



              $checkDsql = $mysqli->query("SELECT id from candidate_tbl WHERE category_id = '{$catresZ['id']}'");

              if ($checkDsql->num_rows < 1) {
                continue;
              }

          ?>



              <li>

                <a href="vote.php?uid=<?= base64_encode($catresZ['id']); ?>" class="nav-link text-white"><span class="vstatus <?php if (in_array($catresZ['id'], $voteStatus)) {
                                                                                                                                echo 'g';
                                                                                                                              } else {
                                                                                                                                echo 'r';
                                                                                                                              } ?>">

                  </span> <?= $catresZ['position_type']; ?>
                  <?= ucfirst($catresZ['zone']); ?>

                </a>

              </li>

          <?php }
          } ?>

        </ul>

        <div class="dropdown p-3">

          <form action="" method="post" class="text-center">

            <i class="fa-solid fa-right-from-bracket"></i> <button type="submit" class="text-white" style="background: none; outline: none; border: none; display: inline-block;">Sign out</button>

            <input type="hidden" name="action" value="logout">

          </form>

        </div>

      </div>

      <div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-white col-md-9"> <a href="/" class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">

          <svg class="bi pe-none me-2" width="30" height="24">

            <use xlink:href="#bootstrap" />

          </svg>

          <span class="fs-5 fw-semibold" style="text-transform: uppercase;"><i class="fa-solid fa-archway"></i>
            Guidelines to Vote</span> </a>

        <div class="list-group list-group-flush border-bottom scrollarea guideline">

          <ol>

            <li>You will be responsible for electing the National Executive Committee and only your respective Zonal
              Committee</li>

            <li>Click on ‘Start Voting’ to commence the voting process</li>

            <li>Ensure to click on the ‘Vote’ button below the candidate of your choice</li>

            <li>In case you want to read the bio and manifesto of the candidate, then click on ‘Click to view details of
              the candidate’. A pop up will appear with the details of the candidate</li>

            <li>Kindly click on ‘Submit’ to cast your vote</li>

            <li>Request you to complete the voting process for all the given categories</li>

            <li>You cannot modify the vote / re-vote once submitted</li>

            <li>Voting portal will be open between 10 AM (IST) to 8 PM (IST) on August 02, 2024 (Friday).</li>

            <li>Click on ‘View Details’ on this page to see the following lists:

              <ul>

                <li>Positions for which only 1 nomination has been received</li>

                <li>Positions for which no nominations have been received</li>

              </ul>

            </li>

            <li>You will receive a ‘Thank you for voting’ message on your screen once the voting has been completed for
              all categories</li>

          </ol>

        </div>

        <div class="start-btn text-center">

          <button id="viewDetails" data-bs-toggle="modal" data-bs-target="#viewDetailsM">View Details</button><button id="startVote">Start Voting</button>

        </div>

      </div>

    </main>



  </div>



  <div class="modal fade" id="viewDetailsM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

      <div class="modal-content">

        <div class="modal-header">

          <h5 class="modal-title" id="staticBackdropLabel">Note</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <div class="modal-body">

          <ol>

            <li>For the below categories, we have received only 1 nomination and hence the candidate has been elected
              unopposed:

              <ul>

                <li>President</li>

                <li>Zonal Vice President – North</li>

                <li>Zonal Vice President – West</li>

                <li>Zonal Vice President – East</li>

                <li>Zonal Joint Secretary – North</li>

                <li>Zonal Joint Secretary – South</li>

                <li>Zonal Joint Secretary – West</li>

                <li>Zonal Joint Secretary – East</li>

                <li>Committee Member I – South</li>

                <li>Committee Member II – South</li>

                <li>Committee Member I – North</li>

                <li>Committee Member I – West</li>

                <li>Committee Member II – West</li>

              </ul>

            </li>

            <li>For the below categories, we have not received any nominations.

              <ul>

                <li>Committee Member II – North</li>

                <li>Committee Member I – East</li>

                <li>Committee Member II – East</li>

              </ul>

            </li>

          </ol>

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        </div>

      </div>

    </div>

  </div>



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css" integrity="sha512-fxF1t7b0mpb/ytjBeSu/OpgXxCVcX5/O8AJGYvHaWmNfi/lYLtttitFK17K4iKBva4iU9dcZ+BIV7dyD/nDdSw==" crossorigin="anonymous" referrerpolicy="no-referrer" />



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  <script src="assets/js/sidebars.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js" integrity="sha512-Yk47FuYNtuINE1w+t/KT4BQ7JaycTCcrvlSvdK/jry6Kcxqg5vN7/svVWCxZykVzzJHaxXk5T9jnFemZHSYgnw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    $(document).ready(function() {

      var h = window.innerHeight;

      var l = $('.vpos > a').outerHeight();

      var d = $('.vpos .dropdown').outerHeight();

      $('.vpos ul').css('height', h - l - d);

    });



    $(window).resize(function() {

      var h = window.innerHeight;

      var l = $('.vpos > a').outerHeight();

      var d = $('.vpos .dropdown').outerHeight();

      $('.vpos ul').css('height', h - l - d);

    });



    $(".vpos ul").mCustomScrollbar({

      theme: "rounded-light"

    });



    $('#startVote').on('click', function() {

      window.location.href = "vote.php";

    })
  </script>

</body>

</html>