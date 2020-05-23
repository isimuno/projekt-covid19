<?php 
	print '
	<div style="display: block; margin-left:30%; margin-right: 30%; ">
	<h1 style ="margin-left:auto;">Najnoviji podatci po državama</h1>';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<form action="" id="json_form" name="json_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			
			<label for="country">Country:</label>
			<select name="country" id="country">
		    	<option value="HR" selected>Croatia</option>
				<option value="BE">Belgium</option>
				<option value="LU">Luxembourg</option>
				<option value="HU">Hungary</option>
				<option value="DE">Germany</option>
				<option value="IT">Italy</option>
				<option value="SI">Slovenia</option>
				<option value="BA">Bosnia and Herzegovina</option>
				<option value="FR">France</option>';
			print '
			</select>

			<input type="submit" value="Submit">
		</form></div>';
	}
	else if ($_POST['_action_'] == TRUE) {
			$url = 'https://api.covid19api.com/total/dayone/country/' . $_POST['country'];
			
			$json = file_get_contents($url);
			$json_data = json_decode($json,true);
			
			foreach($json_data as $key => $value) { 
			
			$datum = date("d-m-Y", strtotime($json_data[$key]["Date"]));
			print '
		   <div style="display: block; text-align:center;  border-style: double; margin-top:3%;">
		   <div style =margin-left:5%;>
				<p style="margin-left:0px;"><strong>Country:</strong> ' . $json_data[$key]["Country"] . '</p>
                <p style="margin-left:0px;"><strong>Confirmed:</strong> ' . $json_data[$key]["Confirmed"] . '</p>
				<p style="margin-left:0px;"><strong>Deaths:</strong> ' . $json_data[$key]["Deaths"] . '</p>
				<p style="margin-left:0px;"><strong>Active:</strong> ' . ($json_data[$key]["Confirmed"]-$json_data[$key]["Deaths"]- $json_data[$key]["Recovered"]) . '</p>
				<p style="margin-left:0px;"><strong>Recovered:</strong> ' . $json_data[$key]["Recovered"] . '</p>
			    <p style="margin-left:0px;"><strong>Date:</strong> '.$datum.'</p>
</div></div>
				';
			}
	}
	print '
	</div>';
?>