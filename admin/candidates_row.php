<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT C.*, P.position_type AS position_type, P.id AS position_id, P.zone AS zone FROM candidate_tbl AS C LEFT JOIN nomination_category_tbl AS P ON P.id=C.category_id WHERE C.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();
        if($row['zone'] == 'all'){
            $row['pVal'] = $row['position_type'].'-'.$row['zone'];
            $row['pText'] = $row['position_type'];
        }else{
            $row['pVal'] = $row['position_type'].'-'.$row['zone'];
            $row['pText'] = $row['position_type'].' - '.strtoupper($row['zone']);
        }
		echo json_encode($row);
	}
?>