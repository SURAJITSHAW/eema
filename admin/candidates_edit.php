<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['firstname'];
        $posArr = explode('-', $_POST['position']);
		$position = $posArr[0];
		$zone = $posArr[1];
		$about = str_replace("'",'"',$_POST['platform']);
		$desig = $_POST['desig'];
        
        $catSql = $conn->query("SELECT id FROM nomination_category_tbl WHERE position_type = '{$position}' AND zone = '{$zone}'");
        $catres = $catSql->fetch_assoc();
        $category = $catres['id'];
        
//        print_r($_POST);die();

		$sql = "UPDATE candidate_tbl SET name = '$name', position = '$desig', category_id = '$category', about = '$about' WHERE id = '$id'";//die();
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location: candidates.php');

?>