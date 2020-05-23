<?php
print'
<div style="margin-left:auto; margin-right: auto; float: left;">';
	if (isset($action) && $action != '') {
		$query  = "SELECT * FROM picture";
		$query .= " WHERE id=" . $_GET['action'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
			print '
				<img src="pictures/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '">
				<time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time>';
	}
	else {
		print '
		<div style="margin-left:1%; display: block; margin-right:auto; text-align:center;">
		<h1 style="text-align:center;">Gallery</h1>
		<div style=" margin-left:3%;margin-right: auto; float: left; text-align:center; margin-top:3%;">
			<table>
				<tbody>';
				$query  = "SELECT * FROM picture"; 
				$query .= " ORDER BY date DESC";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
			print '
			 <div style = "float:left; margin-left:7%;">
			    <img src="picture/' . $row['picture'] . '" style="width:18em;height:10.5em; float:left; border: 7px groove;  padding: 2px;"/>
			    <figcaption style="text-align:center;">' . $row['description'] . '</br></br>
			';
				print '				
			</div>
			</div>';}
			print '
				</tbody>
			</table>
		</div></div>';
	}
	print '</div>';
?>
