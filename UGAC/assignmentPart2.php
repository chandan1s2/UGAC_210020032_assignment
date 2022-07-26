<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    
</head>
<body>
	<div class="container my-5"> 
		<h2>List of Students</h2>
		<a class="btn btn-primary" href="/learnings/UGAC/create.php" role="button">New Student</a>
	<br>
	<table class="table">
		<thead>
			<tr>
				<th>S. No.</th>
				<th>Name</th>
				<th>Roll Number</th>
				<th>Department</th>
				<th>Hostel</th>
			</tr>
		</thead>
		<tbody>
            <?php 
            $servername ="localhost";
            $username = "root";
            $password ="";
            $database = "ugac_final.students";
            //Create connection
            $connection = new mysqli($servername, $username, $password, $database);

            // checking
            if($connection -> connect_error){
                die("Connection failed:". $connection -> connect_error);
            }	
            //reading all row from databasse table
            $sql="SELECT * FROM students";
            $result = $connection->query($sql);

            if(!$result){ 
                    die("Invalid query: " . $connection -> error);
            }

            //read data from each row
            while ($row = $result -> fetch_assoc()) {
                $id = $row["id"];
                $name= $row["name"];
                $rollno=$row["rollno"];
                $department=$row["department"];
             $hostel=$row["hostel"];
                echo "
            <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[rollno]</td>
                <td>$row[department]</td>
                <td>$row[hostel]</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='/learnings/UGAC/edit.php?id=$row[id]'>Update</a>
                    <a class='btn btn-danger btn-sm' href='/learnings/UGAC/delete.php?id=$row[id]'>Remove</a>
                </td>
            </tr>"
            ;
            }
            ?>
            </tbody>
        </table>
        </div>
    </body>
    </html>