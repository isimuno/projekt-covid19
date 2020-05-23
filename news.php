<?php
	if (isset($action) && $action != '') {
		$query  = "SELECT * FROM news";
		$query .= " WHERE id=" . $_GET['action'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
			print '
			<div class="news" style = "margin-left:auto; margin-top:3%; margin-right: 12%;">
				<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '" style="width: 30;">
				<h2 style="text-align: justify; margin-left: 12%;">' . $row['title'] . '</h2>
				<p  style="margin-left: 12%;">'  .nl2br($row['description']). '</p>
				<p style = "margin-left:12%;">'.'Datum i vrijeme zadnje promjene:  '. pickerDateToMysql($row['date']).'</p>
				<hr></div>';
	}
	else {
		print '<h1 style= "text-align: center">NEWS</h1>';
		$query  = "SELECT * FROM news";
		$query .= " WHERE archive='N'";
		$query .= " ORDER BY date DESC";
		$result = @mysqli_query($MySQL, $query);
		while($row = @mysqli_fetch_array($result)) {
			print '
			<div class="card" style ="margin:5%; border-style: double; ">
			<div>
			<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '" class="fakeimg" style= "width:30%; float:left; margin-right:2%;">
			</div>
			<h2 style="float:top; margin-botton:10%;">' . $row['title'] . '</h2>';
			if(strlen($row['description']) > 300) {
            print'<div style="margin-top:4%; font-size:120%;">';
					echo substr(strip_tags($row['description']), 0, 150).'... <a href="index.php?menu=' . $menu . '&amp;action=' . $row['id'] . '">More</a></div>';
					print'<br>';

				}
			    else {
					echo nl2br($row['description']);				
				}
			print'</div>';
			
		}
	}
?>