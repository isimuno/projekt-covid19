<?php 
$allSessions = [];
$sessionNames = scandir(session_save_path());

foreach($sessionNames as $sessionName) {
    $sessionName = str_replace("sess_","",$sessionName);
    if(strpos($sessionName,".") === false) {
		echo $_SESSION;
    }
}
?>