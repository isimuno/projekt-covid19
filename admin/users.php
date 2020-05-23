<?php 
	
	# Update user profile
	if (isset($_POST['edit']) && $_POST['_action_'] == 'TRUE') {
		$query  = "UPDATE users SET firstname='" . $_POST['firstname'] . "', lastname='" . $_POST['lastname'] . "', email='" . $_POST['email'] . "', username='" . $_POST['username'] . "', country='" . $_POST['country'] . "', admin_role='" . $_POST['admin_role'] . "', status ='".$_POST['status']."'";
        $query .= " WHERE id=" . (int)$_POST['edit'];
        $query .= " LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
		# Close MySQL connection
		@mysqli_close($MySQL);
		
		$_SESSION['message'] = '<p>You successfully changed user profile!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=1");
	}
	# End update user profile
	
	# Delete user profile
	if (isset($_GET['delete']) && $_GET['delete'] != '') {
	
		$query  = "DELETE FROM users";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>You successfully deleted user profile!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=1");
	}
	# End delete user profile
	
		#Show user info
	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['id'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		print '
		<h2 style="text-align:center;">User profile</h2>
		<div style = "margin-left:36%; margin-top:20px; margin-right: 0px; margin-top:2%;text-align:center; ">
		<p><b>First name:</b> ' . $row['firstname'] . '</p>
		<p><b>Last name:</b> ' . $row['lastname'] . '</p>
		<p><b>Username:</b> ' . $row['username'] . '</p>';
		$_query  = "SELECT * FROM countries";
		$_query .= " WHERE country_code='" . $row['country'] . "'";
		$_result = @mysqli_query($MySQL, $_query);
		$_row = @mysqli_fetch_array($_result);
		print '
		<p><b>Date:</b> ' . pickerDateToMysql($row['date']) . '</p></div>
		<a href="index.php?menu='.$menu.'&amp;action='.$action.'">
		<button style ="margin-left:41.5%; color:white; padding: 12px 55px; background-color: #45a049;  border: none; font-size: 16px; border-radius: 4px;">Back</button></a>';
	}
	
	#Edit user profile
	else if (isset($_GET['edit']) && $_GET['edit'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_admin_role = false;
		$checked_user_status = false;
		
		print '
		<div style = "margin-left:30%; margin-right:20%;">
		<h2>Edit user profile</h2>
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<input type="hidden" id="edit" name="edit" value="' . $_GET['edit'] . '">
			
			<label for="fname">First Name *</label>
			<input type="text" id="fname" name="firstname" value="' . $row['firstname'] . '" placeholder="Your name.." required>

			<label for="lname">Last Name *</label>
			<input type="text" id="lname" name="lastname" value="' . $row['lastname'] . '" placeholder="Your last natme.." required>
				
			<label for="email">Your E-mail *</label>
			<input type="email" id="email" name="email"  value="' . $row['email'] . '" placeholder="Your e-mail.." required>
			
			<label for="username">Username *<small>(Username must have min 5 and max 10 char)</small></label>
			<input type="text" id="username" name="username" value="' . $row['username'] . '" pattern=".{5,10}" placeholder="Username.." required><br>
			
			
			<label for="admin_role" style="font-size:20px;">Account type:</label>
            <input type="radio" name="admin_role" value="Y"'; if($row['admin_role'] == 'Y') { echo ' checked="checked"'; $checked_admin_role = true; } echo ' /> Administrator &nbsp;&nbsp;
			<input type="radio" name="admin_role" value="N"'; if($checked_admin_role == false) { echo ' checked="checked"'; } echo ' /> Editor
            <br/><br/>
			
			<label for="status" style="font-size:20px;">Account status:</label>
            <input type="radio" name="status" value="locked"'; if($row['status'] == 'locked') { echo ' checked="checked"'; $checked_user_status = true; } echo ' /> Locked profile &nbsp;&nbsp;
			<input type="radio" name="status" value="unlocked"'; if($checked_user_status == false) { echo ' checked="checked"'; } echo ' /> Unlocked profile
            <br/><br/>
			
			<input type="submit" value="Save"></form>
			<form>
			<input type="button" value="Back!" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
            </form>
		    </div>';
	}
	#Change password
	else if (isset($_GET['change_pass']) && $_GET['change_pass'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['change_pass'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		
		if ($_POST['_action_'] == FALSE) {
		print '
		<div style="margin-left:30%; margin-right:auto;">
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<h2>Username:'." ".$row['username'].'<h2>
			
			<label for="new_password1">New password1:*</label>
			<input type="password" id="new_password1" name="new_password1" value="" pattern=".{4,}" required>
			
			<label for="new_password2">New password2:*</label>
			<input type="password" id="new_password2" name="new_password2" value="" pattern=".{4,}" required>
									
			<input type="submit" style = "width="300" value="Change" >
			
		</form>
		<form>
		<input type="button" value="Back" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
        </form>
		</div>';
	}
	
	else if ($_POST['_action_'] == TRUE) {
		 if (($_POST['new_password1']) ==($_POST['new_password2'])){
			 $pass_hash = password_hash($_POST['new_password1'], PASSWORD_DEFAULT, ['cost' => 12]);		 
	         $_query  = "UPDATE users SET password ='" . $pass_hash . "' WHERE id = ".$_GET['change_pass']."";
			 $_result = @mysqli_query($MySQL, $_query);
			 $querypass = "INSERT INTO changed_passwords (admin_id, user_id) VALUES ('".$_SESSION['user']['id']."','".$row['id']."')";
			 $resultpass = @mysqli_query($MySQL, $querypass);
			 echo '<p> Successful change password for user '.$row['username'].'!</p>';
		 }
		 else{
			 echo '<p>New passwords do not match !</p>';
		 }}
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
	
	
	#Add user
	else if (isset($_GET['add']) && $_GET['add'] != '') {
	if ($_POST['_action_'] == FALSE) {
		print '
		<div style ="margin-left:28%;">
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<label for="fname" style ="margin-left:0%;">First Name *</label>
			<input type="text" id="fname" name="firstname" placeholder="Your name.." required>
			<label for="lname">Last Name *</label>
			<input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
				
			<label for="email">Your E-mail *</label>
			<input type="email" id="email" name="email" placeholder="Your e-mail.." required>
			
			<label for="username">Username:* <small>(Username must have min 5 and max 10 char)</small></label>
			<input type="text" id="username" name="username" pattern=".{5,10}" placeholder="Username.." required><br>
			
									
			<label for="password">Password:* <small>(Password must have min 4 char)</small></label>
			<input type="password" id="password" name="password" placeholder="Password.." pattern=".{4,}" required>
	
			<input type="submit" value="Save">
		</form>
		<form>
		<input type="button" value="Back" onclick="history.back()" style ="margin-left:auto; color:white; width:25%; padding:12px; background-color: #45a049;cursor: pointer; border: none; font-size: 13px; border-radius: 4px; margin-top:1%; margine-bottom:3%;">
        </form>
		</div>';
	}
		else if ($_POST['_action_'] == TRUE) {	
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row == null) {
			# password_hash https://secure.php.net/manual/en/function.password-hash.php
			# password_hash() creates a new password hash using a strong one-way hashing algorithm
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO users (firstname, lastname, email, username, password)";
			$query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "')";
			$result = @mysqli_query($MySQL, $query);
			
			# ucfirst() — Make a string's first character uppercase
			# strtolower() - Make a string lowercase
			echo '<p>'. 'Successful register user: ' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['lastname'])).'</p>
			<hr>';
		}
		else {
			echo '<p>User with this email or username already exist!</p>';
		}
	}
		
	}
	
	

	


	else {
		print '
		<a href="index.php?menu=' . $menu . '&amp;action=' . $action . '&amp;add=true" class="AddLink"> <img src="img/add-user.png" style="margin-left:47%;"></a>
		<h2 style ="text-align:center;">List of users</h2>
	<div style ="margin-right:auto; margin-left:3%;">
			<table style ="margin-right:auto; margin-left:auto;">
				<thead>
					<tr>
					<td></td>
						<th></th>
						<th></th>
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
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;change_pass=' .$row['id']. '"><img src="img/passw.png" alt="user" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="img/edit.png" alt="uredi" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="obriši" style ="width=80%; height:3.2vw;"></a></td>
					<td style =" border: 1px solid black;"><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;send_mess=' .$row['id']. '"><img src="img/send.png" alt="message" style ="width=80%; height:3.2vw;"></a></td>
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
	
	# Close MySQL connection
	@mysqli_close($MySQL);
?>