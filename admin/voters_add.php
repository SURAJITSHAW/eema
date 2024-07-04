<?php

include 'includes/session.php';



// if(isset($_POST['add'])){

// 	$firstname = $_POST['firstname'];

// 	$lastname = $_POST['lastname'];

// 	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// 	$filename = $_FILES['photo']['name'];

// 	if(!empty($filename)){

// 		move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	

// 	}

// 	//generate voters id

// 	$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

// 	$voter = substr(str_shuffle($set), 0, 15);



// 	$sql = "INSERT INTO voters_tbl (voters_id, password, firstname, lastname, photo) VALUES ('$voter', '$password', '$firstname', '$lastname', '$filename')";

// 	if($conn->query($sql)){

// 		$_SESSION['success'] = 'Voter added successfully';

// 	}

// 	else{

// 		$_SESSION['error'] = $conn->error;

// 	}



// }

// else{

// 	$_SESSION['error'] = 'Fill up add form first';

// }



// header('location: voters.php');


// Function to generate hashed password
function generateHash($password)
{
	return password_hash($password, PASSWORD_DEFAULT);
}

// Handle form submission
if (isset($_POST['add'])) {
	
	// $firstname = $_POST['firstname'];

	// $lastname = $_POST['lastname'];

	$email = $_POST['email'];
	$password_raw = $_POST['password']; // Raw password
	$password = generateHash($password_raw); // Hashed password


	// $name_member_firm = $_POST['name_member_firm'];
	// $management_team = $_POST['management_team'];

	$zone = $_POST['zone'];

	$membership = $_POST['membership'];



	// Insert query with placeholders
	$sql = "INSERT INTO voters_tbl ( email, password_raw, password, zone, membership) 
            VALUES ( '$email', '$password_raw', '$password', '$zone', '$membership')";
	// $sql = "INSERT INTO voters_tbl (firstname, lastname, password_raw, password, name_member_firm, zone, membership, management_team) 
    //         VALUES ('$firstname', '$lastname', '$password_raw', '$password', '$name_member_firm', '$zone', '$membership', '$management_team')";

	if ($conn->query($sql)) {
		$_SESSION['success'] = 'Voter added successfully';
	} else {
		$_SESSION['error'] = $conn->error;
	}

}

else{

	$_SESSION['error'] = 'Fill up add form first';

}


header('location: voters.php');


?>