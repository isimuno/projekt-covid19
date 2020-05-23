<?php 

	print '
	<h1 style= "text-align: center;"> About Us </h1>
	<video onloadstart="this.volume=0.12" width="50%" autoplay style="display: block; margin-left: auto;margin-right: auto;">
    <source src="video\presentation.mp4" type="video/mp4">
    Your browser does not support the video tag.
    </video>
	<div style = "margin-left:auto; margin-top:20px; margin-right: auto; width: 100%;">
	<h2 style= "text-align: center;">Automatic Slideshow View Report Of Coronavirus:</h2>
	<br>
	';

   print'

<div class="slideshow-container">';
	$datum = date('Y-m-d');
    $yesterday = date('Y-m-d',strtotime($datum. "-2 days"));
	$yesterday.= date ('\TH:i:s');
	$yesterday.= "Z";	
            
    	
print '		
<div class="mySlides fade" style ="margin-left:5%; margin-right:5%; ">';
	$url = 'https://api.covid19api.com/total/dayone/country/croatia';	
			$json = file_get_contents($url);
			$json_data = json_decode($json,true);
                foreach($json_data as $key => $value) {
				if($json_data[$key]["Date"] > $yesterday){
				print'
				<p><strong>Confirmed in Croatia  :</strong> ' . $json_data[$key]["Confirmed"] . '</p>
				<p><strong style = "color:red;">Deaths in Croatia  :</strong> ' . $json_data[$key]["Deaths"] . '</p>
				<p><strong style = "color:green;">Recovered in Croatia  :</strong> ' . $json_data[$key]["Recovered"] . '</p>
				<p><strong style = "color: #e6b800;">Active in Croatia  :</strong> ' .( $json_data[$key]["Confirmed"]- $json_data[$key]["Deaths"]-$json_data[$key]["Recovered"]). '</p>
				<p><strong>Date  :</strong> ' . $datum . '</p>
				<hr>';}}
				print'
</div>
<div class="mySlides fade" style ="margin-left:5%; margin-right:5%; ">';
$url = 'https://api.covid19api.com/total/dayone/country/germany';		
			$json = file_get_contents($url);
			$json_data = json_decode($json,true);	
                foreach($json_data as $key => $value) {
				if($json_data[$key]["Date"] > $yesterday){
				print'
				<p><strong>Confirmed in Germany  :</strong> ' . $json_data[$key]["Confirmed"] . '</p>
				<p><strong style = "color:red;">Deaths in Germany  :</strong> ' . $json_data[$key]["Deaths"] . '</p>
				<p><strong style = "color:green;">Recovered in Germany  :</strong> ' . $json_data[$key]["Recovered"] . '</p>
				<p><strong style = "color: #e6b800;">Active in Germany  :</strong> ' .( $json_data[$key]["Confirmed"]- $json_data[$key]["Deaths"]-$json_data[$key]["Recovered"]). '</p>
				<p><strong>Date  :</strong> ' . $datum . '</p>
				<hr>';}}
				print'
</div>

<div class="mySlides fade" style ="margin-left:5%; margin-right:5%; ">';
$url = 'https://api.covid19api.com/total/dayone/country/italy';		
			$json = file_get_contents($url);
			$json_data = json_decode($json,true);	
                foreach($json_data as $key => $value) {
				if($json_data[$key]["Date"] > $yesterday){
				print'
				<p><strong>Confirmed in Italy  :</strong> ' . $json_data[$key]["Confirmed"] . '</p>
				<p><strong style = "color:red;">Deaths in Italy :</strong> ' . $json_data[$key]["Deaths"] . '</p>
				<p><strong style = "color:green;">Recovered in Italy :</strong> ' . $json_data[$key]["Recovered"] . '</p>
				<p><strong style = "color: #e6b800;">Active in Italy  :</strong> ' .( $json_data[$key]["Confirmed"]- $json_data[$key]["Deaths"]-$json_data[$key]["Recovered"]). '</p>
				<p><strong>Date  :</strong> ' . $datum . '</p>
				<hr>';}}
				print'
</div>

<div class="mySlides fade" style ="margin-left:5%; margin-right:5%; ">';		
$url = 'https://api.covid19api.com/total/dayone/country/spain';	
			$json = file_get_contents($url);
			$json_data = json_decode($json,true);	
                foreach($json_data as $key => $value) {
				if($json_data[$key]["Date"] > $yesterday){
				print'
				<p><strong>Confirmed in Spain  :</strong> ' . $json_data[$key]["Confirmed"] . '</p>
				<p><strong style = "color:red;">Deaths in Spain :</strong> ' . $json_data[$key]["Deaths"] . '</p>
				<p><strong style = "color:green;">Recovered in Spain :</strong> ' . $json_data[$key]["Recovered"] . '</p>
				<p><strong style = "color: #e6b800;">Active in Spain  :</strong> ' .( $json_data[$key]["Confirmed"]- $json_data[$key]["Deaths"]-$json_data[$key]["Recovered"]). '</p>
				<p><strong>Date  :</strong> ' . $datum . '</p>
				<hr>';}}
				print'
</div>
</div>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
</div>

<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); // Change image every 5 seconds
}
</script>';
	
?>