<?php 
$id="";
$name="";
$rollno="";
$department="";
$hostel="";

$errorMessage="";
$successMessage="";

//creating connection
$servername="localhost";
$username="root";
$password="";
$database="ugac_final.students";
$connection= new mysqli($servername, $username, $password, $database);


if($_SERVER['REQUEST_METHOD']=='GET'){
	//GET method: Show the data of the student
	if(!isset($_GET['id'])){
		header('location: /learnings/UGAC/assignmentPart2.php');
		exit;
	}
	$id = $_GET["id"];

	//read the row of the selected student from database table

	$sql ="SELECT * FROM students WHERE id=$id";
	$result = $connection->query($sql);
	$row = $result->fetch_assoc();
	if(!$row){
		header("location: /learnings/UGAC/assignmentPart2.php");
		exit;
	}

	$name= $row["name"];
	$rollno=$row["rollno"];
	$department=$row["department"];
	$hostel=$row["hostel"];
}
else{
	//Post method: Update the data of student
	$id =$_POST["id"];
	$name= $_POST["name"];
	$rollno= $_POST["rollno"];
	$department=$_POST["department"];
	$hostel=$_POST["hostel"];

do{
	if(empty($name) || empty($rollno) || empty($department) || empty($hostel) ){
		$errorMessage = "All the fields are required";
		break;
	}

	$sql = "UPDATE students ". "SET name = '$name', rollno='$rollno', department = '$department', hostel = '$hostel' " . "WHERE id = $id"; 

$result = $connection->query($sql);

if( !$result ){
	$errorMessage ='Invalid query:'.$connection->error;
	break;
}

$successMessage = "Student updated!";

header("location: /learnings/UGAC/assignmentPart2.php");
exit;

	while(true);
}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update details</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
		<script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<div class="container my-5">
		<h2>Update Details</h2>
		<?php  
		if(!empty($errorMessage) ){
			echo"
			<div class='alert alert-warning alert-dismissible fade show' role='alert'>
			<strong>$errorMessage</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
			</div>


			";}?>
		<form method="post">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
			</div>
		</div>
		<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Roll Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="Roll-Number" value="<?php echo $rollno; ?>">
			</div>
		</div>
			<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Department</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="Department" value="<?php echo $department; ?>">
			</div>
		</div>
			<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Hostel</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="Hostel" value="<?php echo $hostel; ?>">
			</div>
		</div>
		<?php 
		if (!empty($successMessage)){
			echo "
		  <div class='row mb-3'>
		  <div class='offset-sm-3 col-sm-6'>
		  <div class='alert alert-success alert-dismissible fade show' role='alert'>
		  <strong>$successMessage</strong>
		  <button type ='button' class='btn-close' data-bs-dismiss='alert' aria label='Close'>
		  </div>
		  </div>
		  </div>

			";
		}
		?>
		<div class="row mb-3">
			<div class="offset-sm-3 col-sm-3 d-grid">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		<div class="col-sm-3 d-grid">
			<a class ="btn btn-outline-primary" href="/learnings/UGAC/assignmentPart2.php" role="button">Cancel</a>
		</div>
	</div>
</form>
</div>
</body>
</html>