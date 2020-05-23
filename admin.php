<?php 
	if ($_SESSION['user']['valid'] == 'true') {
		if (!isset($action)) { $action = 1; }
				$sender = $_SESSION['user']['id'];
				$query  = "SELECT * FROM message";
		        $query .= " WHERE recipient = '".$sender."'";
				$query .= " AND status = 'unread'";
				$result = @mysqli_query($MySQL, $query);
				$row = @mysqli_fetch_array($result);
		print '
		<h1 style ="text-align:center;">Administration</h1>
		<div id="admin">
			<ul>
				<li><a href="index.php?menu=7&amp;action=1">Users</a></li>
				<li><a href="index.php?menu=7&amp;action=2">News</a></li>
				<li><a href="index.php?menu=7&amp;action=3">Galery</a></li>
				<li><a href="index.php?menu=7&amp;action=4">About</a></li>
				<li><a href="index.php?menu=7&amp;action=5">Admin</a></li>';
				if ($row != null){
					print'<li><a href="index.php?menu=7&amp;action=6"> Message <img src="img/mail.png" alt="uredi" style ="width=50%; height:1.5vw; float:top;"></a></li>';
				}
				else if($row == null){
					print'<li ><a href="index.php?menu=7&amp;action=6">Message</a></li>';
				}
				print'
				<li><a href="index.php?menu=7&amp;action=7">Group chat</a></li>
				<li><a href="index.php?menu=7&amp;action=8">Change password</a></li>
				<li><a href="index.php?menu=7&amp;action=9">Sign Out</a></li>
			</ul>';
			# Admin Users
			if ($action == 1) { include("admin/users.php");}
			
			# Admin News
			else if ($action == 2) { include("admin/news.php");}
			
			# Register New User
			
			else if ($action == 3) { include("admin/galery.php"); }
			
			else if ($action == 4) { include("about-us.php"); }
			
			else if ($action == 5) { include("admin/users.php"); }
			
			else if ($action == 6) { include("admin/message.php"); }
			
			else if ($action == 7) { include("admin/groupchat.php"); }
			
			else if ($action == 8) { include("admin/change_pass.php"); }
			
			else if ($action == 9) { include("signout.php"); }
			
			
	
			
		print '
		</div>';
	}
	else {
		$_SESSION['message'] = '<p>Please register or login using your credentials!</p>';
		header("Location: index.php?menu=6");
	}
?>