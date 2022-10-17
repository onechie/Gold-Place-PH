<?php 
 
$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, 'https://robotapitest-ph.borzodelivery.com/api/business/1.2'); 
curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: 5BFA2DB65D899FD1AA548C07E4815889666E262A']); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
 
$result = curl_exec($curl); 
if ($result === false) { 
    throw new Exception(curl_error($curl), curl_errno($curl)); 
} 
 
echo $result; 