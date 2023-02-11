<?php 
    include 'db_connect.php';
	if (isset($_POST['stu_id'])) {
		$stu_id = $_POST['stu_id'];
		$error = '';
			// Check student name is used in book_issue
		$check_sql = "SELECT * from `book_issue` where `issue_name` ='{$stu_id}' AND `issue_status`= 'N' ";
		$result = mysqli_query($con,$check_sql);
		if (mysqli_num_rows($result) > 0) {
			echo "<div class='alert alert-danger alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Cant't delete this student. Book issued to this student.</div>";
		}else{
			// Delete query
			$sql = "DELETE from `student` where `student_id` ='{$stu_id}' ";
			if (mysqli_query($con,$sql)) {
				echo "<div class='alert alert-success alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Student deleted successfully.</div>";
			}else{
				echo "<div class='alert alert-danger alert' style='font-size: 18px; font-style:italic;'><button type='button' class='close' data-dismiss='alert'>&times;</button>Something went wrong! please try after sometime.</div>";
			}
		}
	}
?>