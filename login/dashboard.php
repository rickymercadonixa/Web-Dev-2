<?php
	require 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
<h1 class="display-4" style="text-align: center;">Dashboard</h1>

<!--
<div class="btn-group" role="group" aria-label="Basic outlined example">
  <button type="button" class="btn btn-outline-primary">Create</button>
  <button type="button" class="btn btn-outline-primary">Update</button>
  <button type="button" class="btn btn-outline-primary">Delete</button>
</div>
-->
<form method="GET" style="text-align: right;">
	<input type="text" name="search" placeholder="Search by name..." style="padding: 3px 2px 7px 3px;">
	<button type="submit" class="btn btn-info" >Search</button>
	<a href="dashboard.php" class="btn btn-success">RESET</a>
</form>

<br><br>

<table border="1" class="table table-dark">
	<b>
		<th>ID No.</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>email</th>
		<th>reg_date Number</th>
		<th>Action</th>


<?php
	if(isset($_GET['search'])){
		$search_query = $_GET['search'];
		$sql = "SELECT * FROM myguests WHERE firstname LIKE '%$search_query%' OR lastname LIKE '%$search_query%'";
		$result = $conn->query($sql);
	}else{
		$sql = "SELECT * FROM myguests";
		$result = $conn->query($sql);
	}
?>

<?php
	if($result->num_rows > 0){
		while($row = $result -> fetch_assoc()){
			echo "<tr>";
			echo "<td>".$row["id"]."</td>";
			echo "<td>".$row["firstname"]."</td>";
			echo "<td>".$row["lastname"]."</td>";
			echo "<td>".$row["email"]."</td>";
			echo "<td>".$row["reg_date"]."</td>";;
			echo "<td><a href='update.php?id=".$row["id"]."'  class='btn btn-info'>Edit</a> || <a href='delete.php?id=".$row["id"]."'  class='btn btn-danger'>Delete</a></td>";
			echo "</tr>";
		}
	} else{
		echo "<tr><td colspan = '7'> No records found</td></tr>";
	}
?>
	</b>
</table>
</body>
</html>
