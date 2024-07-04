<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$posArr = explode('-', $_POST['position']);
		$position = $posArr[0];
		$zone = $posArr[1];
		$about = str_replace("'",'"',$_POST['platform']);
		$desig = $_POST['desig'];
        
		$extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
		$filename = time().'.'.$extension;
        
        $catSql = $conn->query("SELECT id FROM nomination_category_tbl WHERE position_type = '{$position}' AND zone = '{$zone}'");
        $catres = $catSql->fetch_assoc();
        $category = $catres['id'];
        
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../public/'.$filename);	
		}

		$sql = "INSERT INTO candidate_tbl (category_id, name, position, image, about) VALUES ('$category', '$firstname', '$desig', '$filename', '$about')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: candidates.php');
?>