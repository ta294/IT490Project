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

        $result = (array) json_decode($result);

        var_dump($result);

?>
