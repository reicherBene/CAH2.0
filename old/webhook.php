<?php

/*function send($url, $username, $avatar, $message) {
    $data = array(
        'content' => $message,
        'username' => $username,
        'avatar_url' => $avatar,
    );
    $data_string = json_encode($data);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $output = curl_exec($curl);
    $output = json_decode($output, true);
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
        throw new Exception($output['message']);
    }
    curl_close($curl);
    return true;
}*/

function send($username, $message) {
    $data = array(
        'content' => $message,
        'username' => $username,
        'avatar_url' => "https://www.cah.lysin-games.com/img/dark_cyan.png",
    );
    $data_string = json_encode($data);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://discordapp.com/api/webhooks/470645478090866688/PadRMyLloGI7CTz-F2RaASIs2byX0o1c4IOTJeth1kT0yC35yzlQN4NKS0iJzBXJ-6S0");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $output = curl_exec($curl);
    $output = json_decode($output, true);
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) != 204) {
        throw new Exception($output['message']);
    }
    curl_close($curl);
    return true;
}
