<?php 
	#Answer message
	if (isset($_GET['edit']) && $_GET['edit'] != '') {
		$query  = "SELECT * FROM message";
		$query .= " WHERE id=".$_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_admin_role = false;
		$recipient=null;
		$sender=null;
		if($_SESSION['user']['id'] == $row['recipient'])
		{
			$sender = $row['sender'];
			$recipient =  $row['recipient'];
		}
		else{
			$sender = $row['recipient'];
			$recipient = $row['sender'];
		}
		$query2  = "SELECT * FROM users WHERE id = '".$row['sender']."' ";
		$result2 = @mysqli_query($MySQL, $query2);
		$row2 = @mysqli_fetch_array($result2);
		$query3  = "SELECT * FROM users WHERE id = '".$row['recipient']."' ";
		$result3 = @mysqli_query($MySQL, $query3);
		$row3 = @mysqli_fetch_array($result3);
		print '
		<div style = "margin-left:30%; margin-right:auto;">
		<h2>Sent</h2>
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<input type="hidden" id="edit" name="edit" value="' . $_GET['edit'] . '">
		
			<label for="from">From: *</label>
            <input type="text" id="from" name="from" value="'.$row3['username'].'" readonly>
			
			<label for="sendTo"To: *</label>
			<input type="text" id="sendTo" name="sendTo" value="' .$row2['username']. '"" readonly>
				
			<label for="message">Message: *</label>
			<textarea id="message" rows="10" cols="100" name="message" placeholder="Your message.." required  style="width:85%;"></textarea>
				0
			<input type="submit" value="Send"></form>
			<form>
			<input type="button" value="Back!" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
            </form>
		    </div>';
			
	if ($_POST['_action_'] == TRUE) {	
		     $password="password";
			 $encrypted_string=openssl_encrypt($_POST['message'],"AES-128-ECB",$password);
             $status = 'Not read';	
			 $_query  = "INSERT INTO message (sender, recipient, message, status) VALUES('".$recipient."', '".$sender."','".$encrypted_string."','unread')";
			 $_result = @mysqli_query($MySQL, $_query);
			 $_query = "UPDATE message SET status = 'read' ";
			 $_query .= "WHERE id=" . $_GET['edit'] . " LIMIT 1";
			 $_result = @mysqli_query($MySQL, $_query);
			 header("Location: index.php?menu=8&action=6");
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
				$sender = $_SESSION['user']['id'];
				$query  = "SELECT * FROM message";
		        $query .= " WHERE recipient = '".$sender."'";
				$query .= " OR sender = '".$sender."'";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					$password="password";
		            $decrypted_string=openssl_decrypt($row['message'],"AES-128-ECB",$password);
					$query2  = "SELECT * FROM users WHERE id = '".$row['sender']."' ";
					$result2 = @mysqli_query($MySQL, $query2);
					$row2 = @mysqli_fetch_array($result2);
					$query3  = "SELECT * FROM users WHERE id = '".$row['recipient']."' ";
					$result3 = @mysqli_query($MySQL, $query3);
					$row3 = @mysqli_fetch_array($result3);
					print '
					<tr style ="margin-right:auto; margin-left:500px; text-align:center;">
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="img/send.png" alt="uredi" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;archive=' .$row['id']. '"><img src="img/archive.png" alt="user" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="obriši" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black; width:16%; font-size:1.2vw;">' . $row2['username'] . '</td>
					<td style =" border: 1px solid black; width:16%;font-size:1.2vw;">' . $row3['username'] . '</td>
					<td style =" border: 1px solid black; width:20%;font-size:1.2vw;">' . $decrypted_string . '</td>';
				}
			print '
				</tbody>
			</table></div></div>';
		
	}
	
		#Archive message
	else if (isset($_GET['archive']) && $_GET['archive'] != '') {
		$query  = "SELECT * FROM message";
		$query .= " WHERE id=".$_GET['archive'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		if ($_POST['_action_'] == FALSE) {
		$password="password";
		$decrypted_string=openssl_decrypt($row['message'],"AES-128-ECB",$password);
		print '
		<div style = "margin-left:30%; margin-right:auto;">
		<h2>Sent</h2>
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<input type="hidden" id="edit" name="edit" value="' . $_GET['archive'] . '">
			
			<label for="from">From: *</label>
            <input type="text" id="from" name="from" value="'. $row['sender'].'" readonly>
			
			<label for="sendTo"To: *</label>
			<input type="text" id="sendTo" name="sendTo" value="' . $row['recipient'] . '"" readonly>
				
			<label for="message">Message: *</label>
			<input type="text" id="message" name="message"  value="'.$decrypted_string.'" placeholder="Your message.." readonly>
				
			<hr>
			<input type="submit" value="Archive"></form>
			<form>
			<input type="button" value="Back!" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
            </form>
		    </div>';
	}
	
	else if ($_POST['_action_'] == TRUE) {
			 $_query  = "UPDATE message  SET status='read'";
			 $_query .= "WHERE id=" . $_GET['archive'] . " LIMIT 1";
			 $_result = @mysqli_query($MySQL, $_query);
			 header("Location: index.php?menu=7&action=6");
			 echo "Successful archive message!";
	}
	}
	
		# Delete user profile
	else if (isset($_GET['delete']) && $_GET['delete'] != '') {
	
		$query  = "DELETE FROM message";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>You successfully deleted message!</p>';
		
		# Redirect
		header("Location: index.php?menu=8&action=6");
	}
	    #Send message
	else if (isset($_GET['send_mess']) && $_GET['send_mess'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['send_mess'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		
		if ($_POST['_action_'] == FALSE) {
		print '
		<div style="margin-left:30%; margin-right:auto;">
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<label for="from">From: *</label>
            <input type="text" id="from" name="from" value="'.$_SESSION['user']['username'].'" readonly>
			
			<label for="sendTo"To: *</label>
			<input type="text" id="sendTo" name="sendTo" value="' . $row['username'] . '"" readonly>
				
			<label for="message">Message: *</label>
			<textarea id="message" rows="10" cols="100" name="message" placeholder="Your message.." required  style="width:85%;"></textarea>
									
			<input type="submit" style = "width="300" value="Send" >
			
		</form>
		<form>
		<input type="button" value="Back" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
        </form>
		</div>';
	}
	
	else if ($_POST['_action_'] == TRUE) {	 
	         $password="password";
		     $encrypted_string=openssl_encrypt($_POST['message'],"AES-128-ECB",$password);
	       	 $_query  = "INSERT INTO message (sender, recipient, message) VALUES('".$_SESSION['user']['id']."', '" . $row['id'] ."','".$encrypted_string."')";
			 $_result = @mysqli_query($MySQL, $_query);
			 echo '<p> Successful send message to user: '.$row['username'].'!</p>';
	}}
	
    else if (isset($_GET['send-message']) && $_GET['send-message'] != '') {
		
			print'	
	<div style ="margin-right:auto; margin-left:5%;">
			<table style ="margin-right:10%; margin-left:10%;">
				<thead>
					<tr>
						<th></th>
						<th style="font-size:1.5vw; width:16%; margin-left:5%;">First name</th>
						<th style="font-size:1.5vw; width:16%;">Last name</th>
						<th style="font-size:1.5vw; width:16%;">E mail</th>
						<th style="font-size:1.5vw; width:16%;">Tip korisnika</th>
						<th width="16"></th>
					</tr>
				</thead>
				<tbody>';
				$query  = "SELECT * FROM users";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr style ="margin-right:auto; margin-left:500px; text-align:center;">
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;send_mess=' .$row['id']. '"><img src="img/send.png" alt="uredi" style ="width=80%; height:3.2vw;"></a></td>
					 <td style =" border: 1px solid black; width:16%; font-size:1.2vw;">' . $row['firstname'] . '</td>
						<td style =" border: 1px solid black; width:16%;font-size:1.2vw;">' . $row['lastname'] . '</td>
						<td style =" border: 1px solid black; width:20%;font-size:1.2vw;">' . $row['email'] . '</td>';
						if($row['admin_role'] == 'N'){
							print '<td style =" border: 1px solid black; width:15%;font-size:1.2vw;">Editor</td>';
						}
						else{
							print '<td style =" border: 1px solid black; width:120px;font-size:1.2vw;">Admin</td>';}'
							       </tr>';
		
				}
			print '
				</tbody>
			</table></div></div>';
		
	}
	
	else if (isset($_GET['check-all']) && $_GET['check-all'] != '') {
		  $_query  = "UPDATE message  SET status='read'";
		  $_result = @mysqli_query($MySQL, $_query);
		  header("Location: index.php?menu=8&action=6");
	}
	

else{
print '
	<h2 style ="text-align:center;">Message</h2>
	<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;send-message=true" class="AddLink"> <img src="img/send-message.png" style="margin-left:41%;"></a>
	<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;view=true" class="AddLink"> <img src="img/view.png" style="margin-left:4%;"></a>';
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
						<th style="font-size:1.5vw; width:16%;">Status</th>
					</tr>
				</thead>
				<tbody>';
				$sender = $_SESSION['user']['id'];
				$query  = "SELECT * FROM message";
		        $query .= " WHERE recipient = '".$sender."'";
				$query .= " AND status = 'unread'";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					$query2  = "SELECT * FROM users WHERE id = '".$row['sender']."' ";
		            $result2 = @mysqli_query($MySQL, $query2);
		            $row2 = @mysqli_fetch_array($result2);
		            $query3  = "SELECT * FROM users WHERE id = '".$_SESSION['user']['id']."' ";
		            $result3 = @mysqli_query($MySQL, $query3);
		            $row3 = @mysqli_fetch_array($result3);
					$password="password";
					$decrypted_string=openssl_decrypt($row['message'],"AES-128-ECB",$password);
					print '
					<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;check-all=true" class="AddLink"> <img src="img/check-all.png" style="margin-left:91%;"></a>
					<tr style ="margin-right:auto; margin-left:500px; text-align:center;">
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="img/send.png" alt="uredi" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;archive=' .$row['id']. '"><img src="img/archive.png" alt="user" style ="width=80%; height:3.2vw;"></a></td>
						<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="obriši" style ="width=80%; height:3.2vw;"></a></td>
					    <td style =" border: 1px solid black; width:16%; font-size:1.2vw;">' . $row2['username'] . '</td>
						<td style =" border: 1px solid black; width:16%;font-size:1.2vw;">' . $row3['username'] . '</td>
						<td style =" border: 1px solid black; width:20%;font-size:1.2vw;">' .$decrypted_string. '</td>
						<td style =" border: 1px solid black; width:20%;font-size:1.2vw;">' . $row['status'] . '</td>';
				}
			print '
				</tbody>
			</table></div></div>';
}
?>