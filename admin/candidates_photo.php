<?php
	include 'includes/session.php';
	if(isset($_POST['upload'])){
		$id = $_POST['id'];
        $extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
		$filename = time().'.'.$extension;
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../public/'.$filename);	
		}
		
		$sql = "UPDATE candidate_tbl SET image = '$filename' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Photo updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select candidate to update photo first';
	}

	header('location: candidates.php');
?>