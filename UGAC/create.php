 <?php
//creating connection
$id="";
$name ="";
$rollno="";
$department="";
$hostel="";
$errorMessage ="";
$successMessage ="";
            $servername ="localhost";
            $username = "root";
            $password ="";
            $database = "ugac_final.students";

$connection= new mysqli($servername, $username, $password, $database);


if($_SERVER['REQUEST_METHOD']=='POST'){
$name =$_POST['name'];
$rollno=$_POST['rollno'];
$department=$_POST['department'];
$hostel=$_POST['hostel'];

do{
	if(empty($name) || empty($rollno) || empty($department) || empty($hostel) ){
		$errorMessage = "All the fields are required";
		break;
	}
	//adding new client to the database
$sql = "INSERT INTO students (name, rollno, department, hostel)". "VALUES ('$name', '$rollno', '$department', '$hostel')";
$result= $connection -> query($sql);

if( !$result ){
	$errorMessage ='Invalid query:'.$connection->error;
	break;
}
	$name ="";
	$rollno="";
	$department="";
	$hostel="";

	$successMessage="Student added correctly";

	header("location: /learnings/UGAC/assignmentPart2.php");
	exit;

}
while(false);
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New student</title>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
		
</head>
<body>
	<div class="container my-5">
		<h2>Enter details:</h2>
		<br>

		<?php 
		if(!empty($errorMessage) ){
			echo"
			<div class='alert alert-warning alert-dismissible fade show' role='alert'>
			<strong>$errorMessage</strong>
			<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
			</button>
			</div>


			";
		}
		?>
		<form method="post">
		<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
			</div>
		</div>
		<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Roll Number</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="rollno" value="<?php echo $rollno; ?>">
			</div>
		</div>
			<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Department</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="department" value="<?php echo $department; ?>">
			</div> 
		</div>
			<div class="row mb-3">
			<label class="col-sm-3 col-form-label">Hostel</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="hostel" value="<?php echo $hostel; ?>">
			</div>
		</div>
		<?php 
		if ( !empty($successMessage) ){
			echo "
			<div class='row mb-3'>
		  <div class='offset-sm-3 col-sm-6'>
		  <div class='alert alert-success alert-dismissible fade show' role='alert'>
		  <strong>$successMessage</strong>
		  <button type ='button' class='btn-close' data-bs-dismiss='alert' aria-label ='Close'> Close </button>
		  </div>
		  </div>
		  </div>"	
		;}
		?>
		<div class="row  mb-3">
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