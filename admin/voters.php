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

        Voters List

      </h1>

      <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Voters</li>

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

              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>

            </div>



            <div class="box-body">

              <table id="example1" class="table table-bordered">

                <thead>

                  <th>Email</th>

                  <th>Organization</th>

                  <th>Zone</th>
                  <th>Membership</th>

                  <th>Name</th>

                  <th>Mobile</th>

                </thead>

                <tbody>

                  <?php

                    $sql = "SELECT * FROM voters_tbl";

                    $query = $conn->query($sql);

                    while($row = $query->fetch_assoc()){

                      $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/profile.jpg';

                      echo "

                        <tr>

                            <td>".(!empty($row['email']) ? $row['email'] : 'N/A')."</td>
                            <td>".(!empty($row['name_member_firm']) ? $row['name_member_firm'] : 'N/A')."</td>
                            <td>".(!empty($row['zone']) ? $row['zone'] : 'N/A')."</td>
                            <td>".(!empty($row['membership']) ? $row['membership'] : 'N/A')."</td>
                            <td>".(!empty($row['management_team']) ? $row['management_team'] : 'N/A')."</td>
                            <td>".(!empty($row['mobile']) ? $row['mobile'] : 'N/A')."</td>
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

  <?php include 'includes/voters_modal.php'; ?>

</div>

<?php include 'includes/scripts.php'; ?>

<script>

$(function(){

  $(document).on('click', '.edit', function(e){

    e.preventDefault();

    $('#edit').modal('show');

    var id = $(this).data('id');

    getRow(id);

  });



  $(document).on('click', '.delete', function(e){

    e.preventDefault();

    $('#delete').modal('show');

    var id = $(this).data('id');

    getRow(id);

  });



  $(document).on('click', '.photo', function(e){

    e.preventDefault();

    var id = $(this).data('id');

    getRow(id);

  });



});



function getRow(id){

  $.ajax({

    type: 'POST',

    url: 'voters_row.php',

    data: {id:id},

    dataType: 'json',

    success: function(response){

      $('.id').val(response.id);

      $('#edit_firstname').val(response.firstname);

      $('#edit_lastname').val(response.lastname);

      $('#edit_password').val(response.password);

      $('.fullname').html(response.firstname+' '+response.lastname);

    }

  });

}

</script>

</body>

</html>

