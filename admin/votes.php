<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Overall Count
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Votes</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
<!--              <a href="#reset" data-toggle="modal" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</a>-->
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Name of candidate</th>
                  <th>Candidate's Organization</th>
                  <th>Category</th>
                  <th>No. of votes received</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT C.name, C.position, N.position_type, N.zone, COUNT(V.id) AS votes FROM vote_tbl AS V INNER JOIN candidate_tbl AS C ON V.candidate_id = C.id LEFT JOIN nomination_category_tbl AS N ON C.category_id = N.id GROUP BY V.candidate_id ORDER BY C.name ASC";//die();
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                        if($row['zone'] == 'all'){
                            $pos = $row['position_type'];
                        }else{
                            $pos = $row['position_type'].' '.ucfirst($row['zone']);
                        }
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$row['name']."</td>
                          <td>".$row['position']."</td>
                          <td>".$pos."</td>
                          <td>".$row['votes']."</td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/votes_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
