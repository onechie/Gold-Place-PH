<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://ph-locations-api.buonzz.com/v1/provinces',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: XSRF-TOKEN=35dd2d3079967a15e92c8929f8f58917%2BU3wfaj6RtBk2t6yik1RoYOqA%2Bjb9bmj1doQneHPy4m85f339vlpVCtf0Ydo7x2IM1nbNnzxM7nSEKzo3k6pn75j2l0Hwlmut480lPjI1sfH1zhBTPczkiHDUBT9zNK%2B; ph-location-session=5f8668d0429da565476b37f323c38228%2FuGp9lfGbfi00iLz03oebvpUTo2u0085zhZCVO7PnZ3xhQB4R5cFda3h%2BG6Uq0Nn3yjQ5g6BwW7oOzKUICt%2BSAsKQJhvHpAkmpihRvE%2FNPK4ciMt81HyA7zQ%2B4OAAlrJ; ph-location-session-values=36e50fa18c9893b74870480e53b8c8095hwaBhb7kGVqR6qMoSDp2GXOn1%2FmALdEV%2Fl4d5pUdQxCjodiga6WJxSfBZnSWhcC8Ds75XpJDWuXQ6bREZy1P7h1050N8uM87SXswn9d3x17amNhLBtVj3uRIbrBq8EvUe8jztrfOSsNpnPU4zQ2KpnWl43FlrQY9ZF8MFZpAuo%3D'
  ),
));

$province_code = '';
$province = 'bulacan';

$response = curl_exec($curl);
curl_close($curl);

$value = json_decode($response, true);

foreach($value['data'] as $data){
    if(strtolower($data['name']) == $province){
        $province_code = $data['id'];
    }
}

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://ph-locations-api.buonzz.com/v1/cities',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: XSRF-TOKEN=35dd2d3079967a15e92c8929f8f58917%2BU3wfaj6RtBk2t6yik1RoYOqA%2Bjb9bmj1doQneHPy4m85f339vlpVCtf0Ydo7x2IM1nbNnzxM7nSEKzo3k6pn75j2l0Hwlmut480lPjI1sfH1zhBTPczkiHDUBT9zNK%2B; ph-location-session=5f8668d0429da565476b37f323c38228%2FuGp9lfGbfi00iLz03oebvpUTo2u0085zhZCVO7PnZ3xhQB4R5cFda3h%2BG6Uq0Nn3yjQ5g6BwW7oOzKUICt%2BSAsKQJhvHpAkmpihRvE%2FNPK4ciMt81HyA7zQ%2B4OAAlrJ; ph-location-session-values=36e50fa18c9893b74870480e53b8c8095hwaBhb7kGVqR6qMoSDp2GXOn1%2FmALdEV%2Fl4d5pUdQxCjodiga6WJxSfBZnSWhcC8Ds75XpJDWuXQ6bREZy1P7h1050N8uM87SXswn9d3x17amNhLBtVj3uRIbrBq8EvUe8jztrfOSsNpnPU4zQ2KpnWl43FlrQY9ZF8MFZpAuo%3D'
  ),
));


$response = curl_exec($curl);
curl_close($curl);

$value = json_decode($response, true);

foreach($value['data'] as $data){
    if(strtolower($data['province_code']) == $province_code){
        echo $data['name'] . ' || ';
    }
}
