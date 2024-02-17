<?php



// fetch data from given endpoint
function fetchData($endpoint){

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIwYjlkOWIwOWJjZDk4M2ZjZmM1YmMzYzY3NGI5OGJmYSIsInN1YiI6IjY1Mzg2ZWYyZjQ5NWVlMDBjNTE2OTVjNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.RHv-JzZn2DgVpkvB88tXuCv2eIu34DMALsOZtdVSSro",
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);

    return json_decode($response);
}



?>