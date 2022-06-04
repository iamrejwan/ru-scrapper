<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url_components = parse_url($actual_link);

parse_str($url_components['query'], $params);
$url = base64_decode($params['vid']);
//$url = $params['vid'];

$url = 'https://m.ok.ru/video/' .$url;
$context = [
    'http' => [
        'method' => 'GET',
        'header' => "User-Agent:",
    ],
];

$context = stream_context_create($context);
$data = file_get_contents($url, false, $context);
$regex = '/href="(https:\/\/m.ok.ru\/dk([^"]+))/';
    if (preg_match($regex, $data, $match)) {
	    $res =$match[1];
		$res = str_replace( 'https', 'http', $res );
		 echo $res;
        //header("Location:".$res);
    }

?>