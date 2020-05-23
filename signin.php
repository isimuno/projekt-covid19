<?php 
	print '
	<div style="display: block; margin-left:20%; margin-right: auto; ">
	<h1  style ="margin-left:0%;">Sign In</h1>
	<div id="signin" style ="margin-left:auto%;">';
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">

			<label for="username">Username:*</label>
			<input type="text" id="username" name="username" value="" pattern=".{5,10}" required>
									
			<label for="password">Password:*</label>
			<input type="password" id="password" name="password" value="" pattern=".{4,}" required>
									
			<input type="submit" style = "margin-left:0px; margin-bottom:40px; margin-top:5px;" value="Sign In" >
		</form></div>';
	}
	else if ($_POST['_action_'] == TRUE) {
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
	
		
		if ($row['admin_role'] == 'Y'){
		if (password_verify($_POST['password'], $row['password'])) {
			if($row['status'] == 'unlocked'){
			#password_verify https://secure.php.net/manual/en/function.password-verify.php
			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['id'];
			$_SESSION['user']['username'] = $row['username'];
			$_SESSION['user']['firstname'] = $row['firstname'];
			$_SESSION['user']['lastname'] = $row['lastname'];
			$_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
			# Redirect to admin website
			header("Location: index.php?menu=7");
			}
			else {
			echo 'Your account has been suspended, please contact your administrator';
		}
		}
		}
		else if ($row['admin_role'] == 'N'){
		if (password_verify($_POST['password'], $row['password']))  {
			if($row['status'] == 'unlocked'){
			#password_verify https://secure.php.net/manual/en/function.password-verify.php
			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['id'];
			$_SESSION['user']['username'] = $row['username'];
			$_SESSION['user']['firstname'] = $row['firstname'];
			$_SESSION['user']['lastname'] = $row['lastname'];
			$_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
			# Redirect to admin website
			header("Location: index.php?menu=8");
			}
			else {
			echo 'Your account has been suspended, please contact your administrator';
		}
		}}
		# Bad username or password
		else {
			unset($_SESSION['user']);
			echo $_SESSION['message'] = '<p>You entered wrong email or password!</p>';
			header("Location: index.php?menu=6");
		}
	}
	print '
	</div>';
?>