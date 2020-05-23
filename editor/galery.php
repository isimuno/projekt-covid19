<?php 
	
	#Add picture
	if (isset($_POST['_action_']) && $_POST['_action_'] == 'add_picture') {
		$_SESSION['message'] = '';
		# htmlspecialchars — Convert special characters to HTML entities
		# http://php.net/manual/en/function.htmlspecialchars.php
		$query  = "INSERT INTO picture (picture, description)";
		$query .= " VALUES ('" . htmlspecialchars($_POST['title'],ENT_QUOTES)."','".htmlspecialchars($_POST['description'],ENT_QUOTES)."')";
		$result = @mysqli_query($MySQL, $query);
		$ID = mysqli_insert_id($MySQL);
		
		# picture
        if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
                
			# strtolower - Returns string with all alphabetic characters converted to lowercase. 
			# strrchr - Find the last occurrence of a character in a string
			$ext = strtolower(strrchr($_FILES['picture']['name'], "."));
			
            $_picture = $ID . '-' . rand(1,100) . $ext;
			copy($_FILES['picture']['tmp_name'], "picture/".$_picture);
			
			if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif'  || $ext == '.webp') { # test if format is picture
				$_query  = "UPDATE picture SET picture='" . $_picture . "'";
				$_query .= " WHERE id=" . $ID . " LIMIT 1";
				$_result = @mysqli_query($MySQL, $_query);
				$_SESSION['message'] .= '<p>You successfully added picture.</p>';
			}
        }
		
		
		$_SESSION['message'] .= '<p>You successfully added picture!</p>';
		
		# Redirect
		header("Location: index.php?menu=8&action=2");
	}
	
	
	# Delete picture
	if (isset($_GET['delete']) && $_GET['delete'] != '') {
		
		# Delete picture
        $query  = "SELECT picture FROM picture";
        $query .= " WHERE id=".(int)$_GET['delete']." LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
        $row = @mysqli_fetch_array($result);
        @unlink("picture/".$row['picture']); 
		
		# Delete picture
		$query  = "DELETE FROM picture";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>You successfully deleted picture!</p>';
		
		# Redirect
		header("Location: index.php?menu=8&action=2");
	}
	# End delete picture
	
	
	#Add picture 
	else if (isset($_GET['add']) && $_GET['add'] != '') {
		print '
		<div style="display: block; margin-left:5%; margin-right:auto; margin-top:50px; text-align:center;">
		<h2 style ="text-align:center;">Add picture</h2>
		<form action="" id="news_form" name="news_form" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="add_picture">
			
			
				
			<label for="picture">Picture</label>
			<input type="file" id="picture" name="picture">
			
			<label for="description">Description *</label>
			<input type="text" id="description" rows="10" cols="100" name="description" placeholder="News description.." required  style="width:60%;">
						

			<input type="submit" value="Submit" style ="margin-left:36%;">
		</form>
		</div>
		<form>
		<input type="button" value="Back" onclick="history.back()" style ="margin-left:39.2%; color:white; width:23.8%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
        </form>
		';
	}
	
	else {
		print '
		<div style="margin-left:6%; display: block; margin-right: 6%;  text-align:center;">
		<h2><a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink"; style="text-align:center;">Add picture</a></h2>
		<div style=" margin-left:auto;margin-right: auto; float: left; text-align:center; margin-top:3%;">
			<table>
				<tbody>';
				$query  = "SELECT * FROM picture"; 
				$query .= " ORDER BY date DESC";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
			print '
			 <div class="imgContainer" style = "float:left; margin-left:2vw;">
			    <img src="picture/' . $row['picture'] . '" class="galerija"  style="width:325px;height:185px; float:left; margin-left:5%;"/>
			    <figcaption style="text-align:center;">' . $row['description'] . '</br>
				<a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="obriši"></a></figcaption>
			';
				print '				
			</div>
			</div>';}
			print '
				</tbody>
			</table>
		</div></div>';
	}
	# Close MySQL connection
	@mysqli_close($MySQL);
?>