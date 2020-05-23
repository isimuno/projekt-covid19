<?php 
	if ($_SESSION['user']['valid'] == 'true') {
		if (!isset($action)) { $action = 2; }
				$sender = $_SESSION['user']['id'];
				$query  = "SELECT * FROM message";
		        $query .= " WHERE recipient = '".$sender."'";
				$query .= " AND status = 'unread'";
				$result = @mysqli_query($MySQL, $query);
				$row = @mysqli_fetch_array($result);
		print '
	    <h1 style ="text-align:center;">Editors</h1>
		<div id="admin">
			<ul>
				<li><a href="index.php?menu=8&amp;action=1">News</a></li>
				<li><a href="index.php?menu=8&amp;action=2">Galery</a></li>
				<li><a href="index.php?menu=8&amp;action=3">About</a></li>
			    <li><a href="index.php?menu=8&amp;action=4">Contact</a></li>
				<li><a href="index.php?menu=8&amp;action=5">Editor</a></li>';
				if ($row != null){
					print'<li><a href="index.php?menu=8&amp;action=6"> Message <img src="img/mail.png" alt="uredi" style ="width=50%; height:21px;"></a></li>';
				}
				else if($row == null){
					print'<li ><a href="index.php?menu=8&amp;action=6">Message</a></li>';
				}
				print'
				
                <li><a href="index.php?menu=8&amp;action=7">Group chat</a></li>
				<li><a href="index.php?menu=8&amp;action=8">Change password</a></li>
				<li><a href="index.php?menu=8&amp;action=9">Sign Out</a></li>
			</ul>';
			# Admin Users
			if ($action == 1) { include("editor/news.php"); }
			
			# Register New User
			else if ($action == 2) { include("editor/galery.php"); }
			
			else if ($action == 3) { include("about-us.php"); }
			
			else if ($action == 4) { include("editor/contact.php"); }
	
			else if ($action == 5) { include("editor/news.php"); }
			
		   else if ($action == 6) { include("editor/message.php"); }	
		   
		   else if ($action == 7) { include("editor/groupchat.php"); }	

		   else if ($action == 8) { include("change_pass.php"); }
		   
		   else if ($action == 9) { include("signout.php"); }
		   		   
		print '
		</div>';
	}
	else {
		$_SESSION['message'] = '<p>Please register or login using your credentials!</p>';
		header("Location: index.php?menu=6");
	}
?>