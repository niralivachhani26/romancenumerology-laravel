<?php
// echo "*****************";
// die();
$body = [
    // 'ad_tracking' => 'ebook',
    // 'custom_fields' => [
    //   'apple' => 'fuji',
    //   'pear' => 'bosc'
    // ],
    'email' => 'user@example.com',
    'ip_address' => '192.168.0.1',
    // 'last_followup_message_number_sent' => 0,
    // 'misc_notes' => 'string',
    'name' => 'John Doe',
    // 'strict_custom_fields' => true,
    // 'tags' => [
    //   'slow',
    //   'fast',
    //   'lightspeed'
    // ]
  ];
  $accountId = '2206221';
  $listId = '6666681';
  $headers = [
      'Content-Type' => 'application/json',
      'Accept' => 'application/json',
      'Authorization' => 'Bearer WMjH74ji2LyXG1W1YTqIosmUCVhpRSRL',
      'User-Agent' => 'AWeber-PHP-code-sample/1.0'
  ];
//   $url = "https://api.aweber.com/1.0/accounts/{$accountId}/lists/{$listId}/subscribers";

//   $response = $client->post($url, ['json' => $body, 'headers' => $headers]);
//   echo $response->getHeader('Location')[0];



$ch = curl_init();

$headers = [
    'Authorization: Bearer At5t7fS57rwnIHuCwoLy66vE009pKhlx',
    'Content-Type: application/json',
];
$url = "https://api.aweber.com/1.0/accounts/{$accountId}/lists/{$listId}/subscribers?subscriber_email=gemorab865@bitofee.com";

// echo $url;
// die();

$postData = json_encode([
    'email' => 'gemorab865@bitofee.com',
    'name' => 'Anubhav Test',
    'tags' => [
        'add' => ['Main'],
    ]
    // Add other fields as needed
]);

curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);

if ($response === false) {
    $error = curl_error($ch);
    // Handle error
    // return response()->json([
    //     'success' => false,
    //     'message' => 'Failed to send data: ' . $error,
    // ], 500);

    echo '<pre>';
    echo '<pre>****************';
    print_r($error);
    die();
}

curl_close($ch);

echo '<pre>AAAAAAAAAAAAAAAAAAAAAAAAAAAA';
print_r(json_decode($response));
die();
