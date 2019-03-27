
<?php

	$APIkey='af8437f7573e78fd7075179dfbe0ab2ccea8b8cee6d8402ea2470252d5275acd';
	$firstTeamId=2616;
	$secondTeamId=2617;

	$curl_options = array(
  	  CURLOPT_URL => "https://allsportsapi.com/api/football/?met=H2H&APIkey=$APIkey&firstTeamId=$firstTeamId&secondTeamId=$secondTeamId",
  	  CURLOPT_RETURNTRANSFER => true,
  	  CURLOPT_HEADER => false,
  	  CURLOPT_TIMEOUT => 30,
  	  CURLOPT_CONNECTTIMEOUT => 5
	);

	$curl = curl_init();
	curl_setopt_array( $curl, $curl_options );
	$result = curl_exec( $curl );

	//$result = (array) json_decode($result);

	//var_dump($result);


	$db = mysqli_connect("127.0.0.1", "admin", "password", "490db");
	
	//$json = file_get_contents('api.json');
	$jsonDecoded = json_decode($result, true);

	foreach($jsonDecoded['result']['H2H'] as $apidata) {
	$event_key = $apidata['event_key'];
        $event_date = $apidata['event_date'];
        $event_time = $apidata['event_time'];
        $event_home_team = $apidata['event_home_team'];
        $event_away_team = $apidata['event_away_team'];
        $event_final_result = $apidata['event_final_result'];
        $event_status = $apidata['event_status'];
        $country_name = $apidata['country_name'];
        $league_name = $apidata['league_name'];

        $insertQuery = "INSERT INTO api SET
		event_key = '".$apidata['event_key']."',
                event_date = '".$apidata['event_date']."',
                event_time = '".$apidata['event_time']."',
                event_home_team = '".$apidata['event_home_team']."',
                event_away_team = '".$apidata['event_away_team']."',
                event_final_result = '".$apidata['event_final_result']."',
                event_status = '".$apidata['event_status']."',
                country_name = '".$apidata['country_name']."',
                league_name = '".$apidata['league_name']."'";
        	
	mysqli_query($db, $insertQuery);
	}
	echo "\nInserted data\n";

?>
