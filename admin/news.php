<?php 
	
	#Add news
	if (isset($_POST['_action_']) && $_POST['_action_'] == 'add_news') {
		$_SESSION['message'] = '';
		# htmlspecialchars — Convert special characters to HTML entities
		# http://php.net/manual/en/function.htmlspecialchars.php
		$query  = "INSERT INTO news (title, description, archive)";
		$query .= " VALUES ('" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', '" . htmlspecialchars($_POST['description']."\n"."\n"."Tekst objavio: ". $_SESSION['user']['firstname']." ".$_SESSION['user']['lastname'] , ENT_QUOTES) . "', '" . $_POST['archive'] . "')";
		$result = @mysqli_query($MySQL, $query);
		
		$ID = mysqli_insert_id($MySQL);
		
		# picture
        if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
                
			# strtolower - Returns string with all alphabetic characters converted to lowercase. 
			# strrchr - Find the last occurrence of a character in a string
			$ext = strtolower(strrchr($_FILES['picture']['name'], "."));
			
            $_picture = $ID . '-' . rand(1,100) . $ext;
			copy($_FILES['picture']['tmp_name'], "news/".$_picture);
			
			if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif'  || $ext == '.webp') { # test if format is picture
				$_query  = "UPDATE news SET picture='" . $_picture . "'";
				$_query .= " WHERE id=" . $ID . " LIMIT 1";
				$_result = @mysqli_query($MySQL, $_query);
				$_SESSION['message'] .= '<p>You successfully added picture.</p>';
			}
        }
		
		
		$_SESSION['message'] .= '<p>You successfully added news!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=2");
	}
	
	# Update news
	if (isset($_POST['_action_']) && $_POST['_action_'] == 'edit_news') {
		$query  = "UPDATE news SET title='" . htmlspecialchars($_POST['title'], ENT_QUOTES) . "', description='" . htmlspecialchars($_POST['description']."\n"."Tekst uredio: ". $_SESSION['user']['firstname']." ". $_SESSION['user']['lastname'] , ENT_QUOTES) . "', archive='" . $_POST['archive'] . "'";
        $query .= " WHERE id=" . (int)$_POST['edit'];
        $query .= " LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
		
		# picture
        if($_FILES['picture']['error'] == UPLOAD_ERR_OK && $_FILES['picture']['name'] != "") {
                
			# strtolower - Returns string with all alphabetic characters converted to lowercase. 
			# strrchr - Find the last occurrence of a character in a string
			$ext = strtolower(strrchr($_FILES['picture']['name'], "."));
            
			$_picture = (int)$_POST['edit'] . '-' . rand(1,100) . $ext;
			copy($_FILES['picture']['tmp_name'], "news/".$_picture);
			
			
			if ($ext == '.jpg' || $ext == '.png' || $ext == '.gif'  || $ext == '.webp') { # test if format is picture
				$_query  = "UPDATE news SET picture='" . $_picture . "'";
				$_query .= " WHERE id=" . (int)$_POST['edit'] . " LIMIT 1";
				$_result = @mysqli_query($MySQL, $_query);
				$_SESSION['message'] .= '<p>You successfully added picture.</p>';
			}
        }
		
		$_SESSION['message'] = '<p>You successfully changed news!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=2");
	}
	# End update news
	
	# Delete news
	if (isset($_GET['delete']) && $_GET['delete'] != '') {
		
		# Delete picture
        $query  = "SELECT picture FROM news";
        $query .= " WHERE id=".(int)$_GET['delete']." LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
        $row = @mysqli_fetch_array($result);
        @unlink("news/".$row['picture']); 
		
		# Delete news
		$query  = "DELETE FROM news";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>You successfully deleted news!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=2");
	}
	# End delete news
	
	
	#Show news info
	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query  = "SELECT * FROM news";
		$query .= " WHERE id=".$_GET['id'];
		$query .= " ORDER BY date DESC";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		print '
		<img src="news/' . $row['picture'] . '" alt="' . $row['title'] . '" title="' . $row['title'] . '" style="width: 30%;float: left; padding-left: 12%; margin-right:2%; margin-top:1%; padding-bottom:1%;">
		<div style = "margin-left:5%; margin-top:5%; margin-right:10%; margin-top:5%">
			<h2 style="margin-left:8%;">' . $row['title'] . '</h2>
			<p>'  .nl2br($row['description']). '</p>
			<p><time datetime="' . $row['date'] . '">' . pickerDateToMysql($row['date']) . '</time></p>

			<hr>
	</div>
		<a href="index.php?menu='.$menu.'&amp;action='.$action.'">
		<button style ="margin-left:18%; color:white; padding: 12px 55px; background-color: #45a049;  border: none; font-size: 16px; border-radius: 4px;">Back</button></a>';
	}
	
	#Add news 
	else if (isset($_GET['add']) && $_GET['add'] != '') {
		
		print '
		<h2 style ="text-align:center;">Add news</h2>
		<div style="margin-left:14%; margin-right:auto;">
		<form action="" id="news_form" name="news_form" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="add_news">
			
			<label for="title">Title *</label>
			<input type="text" id="title" name="title" placeholder="News title.." required  style="width:85%;">

			<label for="description">Description *</label>
			<textarea id="description" rows="10" cols="100" name="description" placeholder="News description.." required  style="width:85%;"></textarea>
				
			<label for="picture">Picture</label>
			<input type="file" id="picture" name="picture"  style="width:85%;">
						
			<label for="archive">Hidden:</label><br />
            <input type="radio" name="archive" value="Y"> YES &nbsp;&nbsp;
			<input type="radio" name="archive" value="N" checked> NO
			
			<hr>
			
			<input type="submit" value="Save">
		</form>
		<form>
		<input type="button" value="Back" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
        </form></div>';
	}
	#Edit news
	else if (isset($_GET['edit']) && $_GET['edit'] != '') {
		$query  = "SELECT * FROM news";
		$query .= " WHERE id=".$_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_archive = false;

		print '
		<h2 style ="text-align:center;">Edit news</h2>
		<div style = "margin-left:30%; margin-right:auto;">
		<form action="" id="news_form_edit" name="news_form_edit" method="POST" enctype="multipart/form-data">
			<input type="hidden" id="_action_" name="_action_" value="edit_news">
			<input type="hidden" id="edit" name="edit" value="' . $row['id'] . '">
			
			<label for="title">Title *</label>
			<input type="text" id="title" name="title" value="' . $row['title'] . '" placeholder="News title.." required   style="width:85%;">

			<label for="description">Description *</label>
			<textarea id="description" rows="10" cols="100" name="description" placeholder="News description.." required  style="width:85%; height:250px;">' . $row['description'] . '</textarea>
				
			<label for="picture">Picture</label>
			<input type="file" id="picture" name="picture" style="width:85%; height:50px;">
						
			<label for="archive" style ="font-size:1.3vw;">Hidden:</label>
            <input type="radio" name="archive" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo '/> YES &nbsp;&nbsp;
			<input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NO
			
			<input type="submit" value="Save" style="margin-top:2%;">
		</form>
		<form>
		<input type="button" value="Back" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
        </form></div>';
	}
	else {
		print '
		<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink"> <img src="img/news.png" style="margin-left:25px;"></a>
        <hr>
        <b><i style ="font-size: 25px;">Edit News</i></b>		
		<div style ="margin-right:5%%; margin-left:auto">
			<table style ="margin-right:auto; margin-left:auto;">		
				<thead>
					<tr>
					    <td></td>
						<th></th>
						<th></th>
						<th style="font-size:1.5vw; width:35%; margin-left:5%;">Title</th>
						<th style="font-size:1.5vw; width:50%;">Description</th>
						<th style="font-size:1.5vw; width:10%;">Date</th>
						<th style="font-size:1.5vw; width:16%;">Status</th>
						<th width="16"></th>
					</tr>
				</thead>
				<tbody>';
				$query  = "SELECT * FROM news";
				$query .= " ORDER BY date DESC";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr style ="margin-right:auto; margin-left:500px; text-align:center;">
				     	<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;id=' .$row['id']. '"><img src="img/preview.png" alt="user" style ="width=80%; height:3.2vw;"></a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="img/edit.png" alt="uredi" style ="width=80%; height:3.2vw;"></a></td>
					    <td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="obriši" style ="width=80%; height:3.2vw;"></a></td>
						<td  style ="width:16%; font-size:1.2vw;">' . $row['title'] . '</td>
						<td  style ="width:16%; font-size:1.2vw;">';
						if(strlen($row['description']) > 160) {
                            echo substr(strip_tags($row['description']), 0, 160).'...';
                        } else {
                            echo strip_tags($row['description']);
                        }
						print '
						</td>
						<td  style ="width:16%; font-size:1.2vw;">' . pickerDateToMysql($row['date']) . '</td>
						<td>';
							if ($row['archive'] == 'Y') { print '<img src="img/unpublished.png" alt="" title=""  style ="width:100%; font-size:1.2vw;"/>'; }
                            else if ($row['archive'] == 'N') { print '<img src="img/published.png" alt="" title=""  style ="width:100%; font-size:1.2vw;" />'; }
						print '
						</td>
					</tr>';
				}
			print '
				</tbody>
			</table>
		</div>';
	}
	
	# Close MySQL connection
	@mysqli_close($MySQL);
?>