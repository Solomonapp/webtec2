
<?php

$request_url = sprintf('%s?%s', 'http://localhost/Adwt/managersindex.php?', $queryString);
$json = curl_init($request_url);
curl_setopt($json, CURLOPT_RETURNTRANSFER, true);




$response = curl_exec($json);
//echo $response;

$api_result = json_decode($response, true);
$orders = $api_result ["orders"];
$order = $orders[0];
echo $order["products"];
//echo "Order $orderID is {$api_result['']['temperature']} Deg C", PHP_EOL;
?>
