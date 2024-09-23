<?php
function get_CURL($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
  
    return json_decode($result, true);
}

$result = get_CURL('https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics&key=AIzaSyCQOlwi_1xlLBJK1FeHrWHuw8VUVpKWDO4&id=UCroS8cTyIpGnlPQmFk7lRjQ');

$youtubeProfilePic = $result['items'][0]['snippet']['thumbnails']['medium']['url'];
$channelName = $result['items'][0]['snippet']['title'];
$subscriber = $result['items'][0]['statistics']['subscriberCount'];

// Latest video
$urlLatestVideo = 'https://www.googleapis.com/youtube/v3/search?key=AIzaSyCQOlwi_1xlLBJK1FeHrWHuw8VUVpKWDO4&channelId=UCroS8cTyIpGnlPQmFk7lRjQ&maxResults=1&order=date&part=snippet';
$result = get_CURL($urlLatestVideo);
$latestVideoId = $result['items'][0]['id']['videoId'];

// Pass data to the HTML file
$data = [
    'youtubeProfilePic' => $youtubeProfilePic,
    'channelName' => $channelName,
    'subscriber' => $subscriber,
    'latestVideoId' => $latestVideoId,
];

header('Content-Type: application/json');
echo json_encode($data);
?>
