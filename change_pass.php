<?php 
    if ($_POST['_action_'] == FALSE) {
		print '
		<div style="display: block; margin-left:auto; margin-right:auto; margin-top:50px; text-align:center;">
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<h2>Username:'." ".$_SESSION['user']['username'].'<h2>
			
			<label for="password">Old password:*</label>
			<input type="password" id="password" name="password" value=""  required>
			
			<label for="new_password1">New password1:*</label>
			<input type="password" id="new_password1" name="new_password1" value="" pattern=".{4,}" required>
			
			<label for="new_password2">New password2:*</label>
			<input type="password" id="new_password2" name="new_password2" value="" pattern=".{4,}" required>
									
			<input type="submit" style = "margin-left:37%;" value="Save" >
		</form></div>';
	}
	
	else if ($_POST['_action_'] == TRUE) {
		 if (($_POST['new_password1']) == ($_POST['new_password2'])){
             $query  = "SELECT * FROM users";
	         $query .= " WHERE username='" .$_SESSION['user']['username']. "'";
	    	 $result = @mysqli_query($MySQL, $query);
	     	 $row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
	  		 $pass_hash = password_hash($_POST['new_password1'], PASSWORD_DEFAULT, ['cost' => 12]);
			 if( password_verify($_POST['password'], $row['password'])){
					$_query  = "UPDATE users SET password ='" . $pass_hash . "' WHERE id = ".$_SESSION['user']['id']."";
					$_result = @mysqli_query($MySQL, $_query);
					echo '<p> Successful change password !</p>';
			 }
			 		 else{
			 echo '<p>Wrong old password !</p>';
		 }
		 }
		 else{
			 echo '<p>New passwords do not match !</p>';
		 }
		
		
	}
?>
