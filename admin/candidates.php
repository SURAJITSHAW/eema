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
        Candidates List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Candidates</li>
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
                  <th class="hidden"></th>
                  <th>Category</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th>Designation</th>
                  <th>View More</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT C.*, P.position_type AS position_type, P.zone AS zone FROM candidate_tbl AS C LEFT JOIN nomination_category_tbl AS P ON P.id=C.category_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      $image = (!empty($row['image'])) ? '../public/'.$row['image'] : '../public/default.jpg';
                        if($row['zone'] == 'all'){
                            $pos = $row['position_type'];
                        }else{
                            $pos = $row['position_type'].' '.ucfirst($row['zone']);
                        }
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>".$pos."</td>
                          <td>
                            <img src='".$image."' width='30px' height='30px'>
                            <a href='#edit_photo' class='pull-right photo' data-id='".$row['id']."'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>".$row['name']."</td>
                          <td>".$row['position']."</td>
                          <td><a href='javascript:void(0)' class='btn btn-info btn-sm btn-flat platform' data-id='".$row['id']."'><i class='fa fa-search'></i> View</a></td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='".$row['id']."'><i class='fa fa-edit'></i> Edit</button>
                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='".$row['id']."'><i class='fa fa-trash'></i> Delete</button>
                          </td>
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
  <?php include 'includes/candidates_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
//    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id, 'edit');
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
//    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id, 'delete');
  });

  $(document).on('click', '.photo', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id, 'edit_photo');
  });

  $(document).on('click', '.platform', function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id, 'platform');
  });

});

function getRow(id, ids){
  $.ajax({
    type: 'POST',
    url: 'candidates_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
        console.log(response.position);
      $('.id').val(response.id);
      $('#edit_firstname').val(response.name);
      $('#posselect').val(response.pVal);      
      $('#edit_desig').val(response.position);      
      $('#edit_platform').val(response.about);
      $('.fullname').html(response.name);
      $('#desc').html(response.about);
    
    $('#'+ids).modal('show');
    }
  });
}
</script>
</body>
</html>
