<?php 

	print '
	<h1 style= "text-align: center;"> About Us </h1>
	<video onloadstart="this.volume=0.12" width="50%" autoplay style="display: block; margin-left: auto;margin-right: auto;">
    <source src="video\presentation.mp4" type="video/mp4">
    Your browser does not support the video tag.
    </video>
	<div style = "margin-left:auto; margin-top:20px; margin-right: auto; width: 100%;">
	<h2 style= "text-align: center;">RADNO VRIJEME PRIJEMNE AMBULANTE ZA UZIMANJE UZORAKA:</h2>
	<p style= "text-align: center; margin:auto;">*osobno doneseni uzorci se primaju: radnim danom od 7,30 – 12,00h.</p></div>	
	';

    $dan = date('Y-m-d');
    $yesterday = date('Y-m-d',strtotime($dan. "-5 days"));
	$yesterday.= date ('\TH:i:s');
	$yesterday.= "Z";
	$datum = date('d-m-Y');
	$url = 'https://api.covid19api.com/live/country/germany/status/confirmed/date/'.$yesterday;			
			$json = file_get_contents($url);
			$json_data = json_decode($json,true);
			
			foreach($json_data as $key => $value) { 
			print '
			</br>
			<h3 style="margin-left: 8%;">Covid19 izvjestaj Hrvatska na dan '.$datum.'</h3>
		    <div style="text-align:center;">
				<p><strong>Potvrđeni sučajevi u HR  :</strong> ' . $json_data[$key]["Confirmed"] . '</p>
				<p><strong>Broj umrlih u HR  :</strong> ' . $json_data[$key]["Deaths"] . '</p>
				<p><strong>Broj izlječenih u HR  :</strong> ' . $json_data[$key]["Recovered"] . '</p>
				</div>
				';
			}
	
?>