<?
$infos = check_http('https://cooptr.com','Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
$infos_decoded = json_decode($infos);
var_dump($infos_decoded);

function check_http($url, $userAgent){
    /*POST fields we'll be sending.*/
    /*$postFields = array();*/

    /*Initiate cURL*/
    $ch = curl_init();

    /*Setup some of our options.   */     
    curl_setopt($ch, CURLOPT_URL, $url);
    /*curl_setopt($ch, CURLOPT_POST, true);*/
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_USERAGENT, $userAgent);

    /*Execute the cURL request. */       
    $result = curl_exec($ch);

    /*Get the resulting HTTP status code from the cURL handle.*/
    $info = curl_getinfo($ch);

    /*Close cURL handle*/
    curl_close($ch);

    /*Dump HTTP status code out onto the screen*/
    return json_encode($info);
}
?>