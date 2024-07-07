<?php include_once('process/_constant.php'); ?>

<?php

// session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header('Location: index.php');
    die();
}

if (isset($_POST['action']) && $_POST['action'] == 'submitVote') {
    $voterId = $_SESSION['userData']['id'];
    $categoryId = base64_decode($_POST['catId']);
    $candidateId = base64_decode($_POST['votefor']);

     // Debug POST data
    echo "<pre>"; print_r($_POST); echo "</pre>";

    
    // Insert the vote
    $mysqli->query("INSERT INTO vote_tbl (candidate_id, voter_id, category_id, ip_address) VALUES ('{$candidateId}', '{$voterId}', '{$categoryId}', '{$_SERVER['REMOTE_ADDR']}')");
    
    // Update completed category list   
    $completed_category = $_SESSION['userData']['completed_category'];
    if ($completed_category) {
        $completed_category .= ",{$categoryId}";
    } else {
        $completed_category = $categoryId;
    }
    $mysqli->query("UPDATE voters_tbl SET completed_category = '{$completed_category}' WHERE id = '{$voterId}'");
    $_SESSION['userData']['completed_category'] = $completed_category;

    // Redirect to next category or success page
    header('Location: home.php');
    die();
}



// ! surajit shaw - added membership function
$membership = strtolower($_SESSION['userData']['membership']);



$voterId = $_SESSION['userData']['id'];

$zone = strtolower($_SESSION['userData']['zone']);

$catUid = isset($_GET['uid']) ? base64_decode($_GET['uid']) : '';



$sqlGet = $mysqli->query("SELECT completed_category FROM voters_tbl WHERE id = '{$voterId}'");

$resGet = $sqlGet->fetch_assoc();

$completed_category = $resGet['completed_category'];



if ($completed_category) {

    $que = 'AND N.id NOT IN(' . $completed_category . ')';

    $que1 = 'AND id NOT IN(' . $completed_category . ')';
} else {

    $que = '';

    $que1 = '';
}



if ($catUid != '') {
    $sqlV = $mysqli->query("SELECT id FROM vote_tbl WHERE voter_id = '{$voterId}' AND category_id = '{$catUid}'");
    if ($sqlV->num_rows > 0) {
        header('Location: home.php');
        die();
    } else {
        if ($membership === 'platinum') {
            $sqlCat = $mysqli->query("SELECT id FROM nomination_category_tbl WHERE id = '{$catUid}' AND (zone = 'all' OR zone = '{$zone}') AND status = '1' {$que1} ORDER BY id ASC LIMIT 0,1");
        } else {
            $sqlCat = $mysqli->query("SELECT id FROM nomination_category_tbl WHERE id = '{$catUid}' AND zone = '{$zone}' AND status = '1' {$que1} ORDER BY id ASC LIMIT 0,1");
        }
        $resCat = $sqlCat->fetch_assoc();
        $currentCat = $resCat['id'];
    }
} else {
    if ($membership === 'platinum') {
        $sqlCat = $mysqli->query("SELECT N.id FROM candidate_tbl AS C INNER JOIN nomination_category_tbl AS N ON(C.category_id = N.id) WHERE N.zone IN('all', '{$zone}') AND N.status = '1' {$que} GROUP BY C.category_id ORDER BY N.id ASC LIMIT 0,1");
    } else {
        $sqlCat = $mysqli->query("SELECT N.id FROM candidate_tbl AS C INNER JOIN nomination_category_tbl AS N ON(C.category_id = N.id) WHERE N.zone = '{$zone}' AND N.status = '1' {$que} GROUP BY C.category_id ORDER BY N.id ASC LIMIT 0,1");
    }
    $resCat = $sqlCat->fetch_assoc();
    $currentCat = $resCat['id'];
    $catUid = $currentCat;


    // ! testing
    // echo "<pre>";
    // print_r($currentCat);
    // die();
}



if ($currentCat == '') {

    header('Location: success.php');
    die();
}



$catSql = $mysqli->query("SELECT position_type, zone FROM nomination_category_tbl WHERE id = '{$currentCat}'");

$catRes = $catSql->fetch_assoc();

$catName = $catRes['position_type'];

$catZone = ucfirst($catRes['zone']);



if (strtolower($catZone) == 'all') {

    $dName = $catName;
} else {

    $dName = $catName . ' ' . $catZone;
}



$sqlVC = $mysqli->query("SELECT id FROM vote_tbl WHERE voter_id = '{$voterId}'");
$totalVoteCount = $sqlVC->num_rows;


$notaCheck = $mysqli->query("SELECT id FROM candidate_tbl WHERE category_id = '{$catUid}' AND name = 'None of the Above'");
if ($notaCheck->num_rows == 0) {
    $notaInsert = $mysqli->query("INSERT INTO candidate_tbl (category_id, name, position, image, about) VALUES ('{$catUid}', 'None of the Above', 'None', 'default.jpg', 'This option represents choosing none of the candidates.')");
}

$sqlCand = $mysqli->query("SELECT * FROM candidate_tbl WHERE category_id = '{$catUid}' ORDER BY name ASC");
$getCandCount = $sqlCand->num_rows;

print_r($getCandCount);


?>

<!doctype html>

<html lang="en">

<head>

    <?php include_once('inc/head.php'); ?>

</head>

<body>

    <div class="voting-status text-center">

        <span class="first"><strong><?= $dName; ?></strong></span>

        <?php /*?><span class="last">Vote Completed - <strong><?=$totalVoteCount;?></strong></span><?php */ ?>

    </div>


    <div class="container-fluid">
        <div class="candidates mt-4 mb-4">
            <div class="row justify-content-center">
                <?php while ($res = $sqlCand->fetch_assoc()) { ?>
                    <div class="col-md-4 text-center card-wrap">
                        <div class="card">
                            <div class="imgC">
                                <i class="fa-solid fa-circle-check"></i>
                                <img class="" src="public/<?= $res['image']; ?>" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $res['name']; ?></h5>
                                <p class="card-text"><?= $res['position']; ?></p>
                                <?php if ($getCandCount == 1) { ?>
                                    <a href="javascript:void(0)" class="btn btn-primary go-vote">Elected Unopposed</a>
                                <?php } else { ?>
                                    <a href="javascript:void(0)" class="btn btn-primary go-vote" data-id="<?= $res['id']; ?>">Vote</a>
                                <?php } ?>
                                <input type="hidden" value="<?= base64_encode($res['id']); ?>" class="CandId">
                                <div class="d-none about"><?= $res['about']; ?></div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="btn know-more">Click to view details of the candidate</a>
                    </div>
                <?php } ?>


            </div>
            <hr>
            <form id="voterForm" action="" method="post" class="text-center mt-5 mb-5">
                <input type="hidden" name="votefor" value="">
                <input type="hidden" name="catId" value="<?= base64_encode($catUid); ?>">
                <input type="hidden" name="action" value="submitVote">
                <?php if ($getCandCount == 1) { ?>
                    <input type="button" value="Next" class="submt-btn" disabled>
                <?php } else { ?>
                    <input type="button" value="Submit Vote" class="submt-btn" disabled>
                <?php } ?>
            </form>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="staticBackdropLabel"></h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    ...

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

                    <!--                <button type="button" class="btn btn-primary">Understood</button>-->

                </div>

            </div>

        </div>

    </div>

    <?php include_once('inc/footer.php'); ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        <?php if ($getCandCount == 1) { ?>
            $(document).ready(function() {
                var CandId = $('.card').find('.CandId').val();
                $('.card').addClass('selected');
                $('input[name="votefor"]').val(CandId);
                $('.submt-btn').prop('disabled', false);
            });
        <?php } ?>

        $('.go-vote').on('click', function() {
            $('.card').removeClass('selected');
            $('input[name="votefor"]').val('');
            var CandId = $(this).parents('.card').find('.CandId').val();
            $(this).parents('.card').addClass('selected');
            $('input[name="votefor"]').val(CandId);
            $('.submt-btn').prop('disabled', false);
        });

        

        $('.know-more').on('click', function() {
            $('#staticBackdrop .modal-body').html('');
            var content = $(this).parents('.card-wrap').find('.about').html();
            var title = $(this).parents('.card-wrap').find('.card-title').html();
            $('#staticBackdrop .modal-title').html(title);
            $('#staticBackdrop .modal-body').html(content);
            $('#staticBackdrop').modal('show');
        });

    
    </script>

    <script>
    $(document).ready(function() {
        var getCandCount = <?php echo $getCandCount; ?>;

        $('.nota-vote').on('click', function() {
            var CandId = $(this).attr('data-id');
            $('input[name="votefor"]').val(CandId);
            $('.submt-btn').prop('disabled', false);
        });

        $('.submt-btn').on('click', function(e) {
            e.preventDefault();
            var voteFor = $('input[name="votefor"]').val();
            var voteCat = $('input[name="catId"]').val();
            if (voteFor == '' || voteCat == '') {
                swal("Error!", "Please select a candidate to vote!", "error");
                return false;
            }
            if (getCandCount > 1) {
                swal({
                    title: "Please confirm your vote",
                    text: "You cannot modify your vote after submitting it",
                    icon: "warning",
                    dangerMode: true,
                    buttons: ["No", "Yes"]
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#voterForm').submit();
                    } else {
                        swal("Your vote is not submitted");
                    }
                });
            } else {
                $('#voterForm').submit();
            }
        });
    });
</script>


</body>

</html>