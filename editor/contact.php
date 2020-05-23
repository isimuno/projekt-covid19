<?php 
	print '
	<h1 style ="display:block; margin-left:42%; margin-right:38%; margin-top:20px; margin-bottom:30px;">Contact Form</h1>
	<div id="contact">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d22232.516961749337!2d15.853056850366194!3d45.850006012436374!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x40ba359f13386bc7!2sKlinika%20za%20infektivne%20bolesti%20Dr.%20Fran%20Mihaljevi%C4%87!5e0!3m2!1shr!2shr!4v1587407230317!5m2!1shr!2shr"  frameborder="0" width="59%" style="border:0; allowfullscreen;  display: block; margin-left:23%; margin-right:auto;" ></iframe>
		<form action="send_email.php" id="contact_form" name="contact_form" method="POST">
		</div>
		<div style="display: block; margin-left:5%; margin-right:auto; margin-top:50px; text-align:center;">
			<label for="fname">First Name *</label>
			<input type="text" id="fname" name="firstname" placeholder="Your name.." required>
			
			<label for="lname">Last Name *</label>
			<input type="text" id="lname" name="lastname" placeholder="Your last natme.." required>
				
			<label for="email">Your E-mail *</label>
			<input type="email" id="email" name="email" placeholder="Your e-mail.." required>

			<label for="country">Country</label>
			<select id="country" name="country">
				<option value="">Please select</option>
				<option value="BE">Belgium</option>
				<option value="HR" selected>Croatia</option>
				<option value="LU">Luxembourg</option>
				<option value="HU">Hungary</option>
			</select>

			<label for="subject">Subject</label>
			<textarea id="subject" name="subject" placeholder="Write something.."></textarea>

	    	<input type="submit" value="Send" style ="margin-left:38%;">
		</form>
		</div>';
?>