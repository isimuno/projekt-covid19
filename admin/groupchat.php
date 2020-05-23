<?php 
	#Answer message
	if (isset($_GET['answer']) && $_GET['answer'] != '') {
		$query  = "SELECT * FROM groupchat";
		$query .= " WHERE id=".$_GET['answer'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		
		print '
		<div style = "margin-left:30%; margin-right:auto;">
		<h2>Sent</h2>
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<input type="hidden" id="answer" name="answer" value="' . $_GET['answer'] . '">
			
			<label for="groupName">GroupName: *</label>
            <input type="text" id="from" name="groupName" value="'.$row['group_name'].'" placeholder="Group name.." readonly>
					
			<label for="message">Message: *</label>
			<input type="text" id="message" name="message"  value="" placeholder="Your first message.." required>
					
			<hr>
			<input type="submit" value="Send"></form>
			<form>
			<input type="button" value="Back!" onclick="history.back()+history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
            </form>
		    </div>';
			
	if ($_POST['_action_'] == TRUE) {	
             $status = 'Not read';	
			 $_query  = "INSERT INTO groupchat (group_name, message, sender) VALUES('".$row['group_name']."', '".$_POST['message']."','".$_SESSION['user']['username']."')";
			 $_result = @mysqli_query($MySQL, $_query);
			 $_query .= "WHERE id=" . $_GET['answer'] . " LIMIT 1";
			 $_result = @mysqli_query($MySQL, $_query);
			 header("Location: index.php?menu=7&action=7");
	}
	}



	else if (isset($_GET['view']) && $_GET['view'] != '') {
		
			print'	
	<div style ="margin-right:auto; margin-left:5%;">
			<table style ="margin-right:auto; margin-left:auto;">
				<thead>
					<tr>
					<td></td>
						<th></th>
						<th></th>
						<th style="font-size:1.5vw; width:16%;">Sender</th>
						<th style="font-size:1.5vw; width:16%;">Recipient</th>
						<th style="font-size:1.5vw; width:56%;">Message</th>
					</tr>
				</thead>
				<tbody>';
				$sender = $_SESSION['user']['username'];
				$query  = "SELECT * FROM message";
		        $query .= " WHERE recipient = '".$sender."'";
				$query .= " OR sender = '".$sender."'";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr style ="margin-right:auto; margin-left:500px; text-align:center;">
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="img/send.png" alt="uredi" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;archive=' .$row['id']. '"><img src="img/archive.png" alt="user" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="obriši" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black; width:16%; font-size:1.2vw;">' . $row['sender'] . '</td>
					<td style =" border: 1px solid black; width:16%;font-size:1.2vw;">' . $row['recipient'] . '</td>
					<td style =" border: 1px solid black; width:20%;font-size:1.2vw;">' . $row['message'] . '</td>';
				}
			print '
				</tbody>
			</table></div></div>';
		
	}
	
	
	




	#Create grup chatroom
	else if (isset($_GET['add']) && $_GET['add'] != '') {
	if ($_POST['_action_'] == FALSE) {
		print '
		<div style="margin-left:30%; margin-right:auto;">
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<label for="groupName">GroupName: *</label>
            <input type="text" id="from" name="groupName" value="" placeholder="Group name.." required>
			
			
			<label for="message">Message: *</label>
			<input type="text" id="message" name="message"  value="" placeholder="Your first message.." required>
									
			<input type="submit" style = "width="300" value="Send" >
			
		</form>
		<form>
		<input type="button" value="Back" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
        </form>
		</div>';
	}
		else if ($_POST['_action_'] == TRUE) {	
	
			$query  = "INSERT INTO groupchat (group_name, message, sender)";
			$query .= " VALUES ('" . $_POST['groupName'] . "', '" . $_POST['message'] . "', '".$_SESSION['user']['username']."')";
			$result = @mysqli_query($MySQL, $query);
		}
	}
		
	
	
		# Delete message in  grupchat
	else if (isset($_GET['delete']) && $_GET['delete'] != '') {
	
		$query  = "DELETE FROM groupchat";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>You successfully deleted message!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=7");
	}
	

	


else {
	if ($_POST['_action_'] == FALSE) {
		print '
	    <a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink"> <img src="img/create.png" style="margin-left:46%;"></a><br>
		<div style="margin-left:30%; margin-right:auto;">
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<label for="groupName">Group name:</label>
			<select name="groupName" id="groupName">
				<option value="">please select</option>';
				$query  = "SELECT DISTINCT group_name FROM groupchat";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['group_name'] . '">' . $row['group_name'] . '</option>';
				}
			print '
			</select>				
			';
			
print'		<input type="submit" style = "width="300" value="Select" >
			
		</form>
		<form>
		<input type="button" value="Back" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
        </form>
		</div>';
	}
		else if ($_POST['_action_'] == TRUE) {	
	print'
	<div style ="margin-right:auto; margin-left:5%;">
			<table style ="margin-right:auto; margin-left:auto;">
				<thead>
					<tr>
					<td></td>
						<th></th>
						<th style="font-size:1.5vw; width:16%;">Group name</th>
						<th style="font-size:1.5vw; width:56%;">Message</th>
						<th style="font-size:1.5vw; width:16%;">Sender</th>
					</tr>
				</thead>
				<tbody>';
				$sender = $_SESSION['user']['username'];
				$query  = "SELECT * FROM groupchat WHERE group_name = '".$_POST['groupName']."'";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr style ="margin-right:auto; margin-left:500px; text-align:center;">
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;answer=' .$row['id']. '"><img src="img/send.png" alt="uredi" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="obriši" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black; width:16%; font-size:1.2vw;">' . $row['group_name'] . '</td>
				    <td style =" border: 1px solid black; width:16%;font-size:1.2vw;">' . $row['message'] . '</td>
					<td style =" border: 1px solid black; width:20%;font-size:1.2vw;">' . $row['sender'] . '</td>';
				}
			print '
				</tbody>
			</table></div>';
		}
	}
?>