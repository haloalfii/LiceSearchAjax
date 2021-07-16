<?php
$connect = mysqli_connect("localhost", "root", "", "code_customer");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM tbl_customer 
	WHERE Name LIKE '%".$search."%'
	OR Address LIKE '%".$search."%' 
	OR City LIKE '%".$search."%' 
	OR PostCode LIKE '%".$search."%' 
	OR Country LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM tbl_customer ORDER BY CustomerID";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Customer Name</th>
							<th>Address</th>
							<th>City</th>
							<th>Postal Code</th>
							<th>Country</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["Name"].'</td>
				<td>'.$row["Address"].'</td>
				<td>'.$row["City"].'</td>
				<td>'.$row["PostCode"].'</td>
				<td>'.$row["Country"].'</td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>