<?php 

$myToken = '5BFA2DB65D899FD1AA548C07E4815889666E262A';
$myAddress = 'Balanga, Bataan';

$curl = curl_init(); 
curl_setopt($curl, CURLOPT_URL, 'https://robotapitest-ph.borzodelivery.com/api/business/1.2/calculate-order'); 
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
curl_setopt($curl, CURLOPT_HTTPHEADER, ['X-DV-Auth-Token: '. $myToken]); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
 
$data = [ 
    'matter' => 'This is Test item number 1', 
    'points' => [ 
        [ 
            'address' =>'Palapat,Hagonoy, Bulacan', 
            'contact_person' => [ 
                'phone' => '639195380326', 
            ], 
        ], 
        [ 
            'address' =>'Malolos Sports & Convention Center, MacArthur Highway, Malolos, Bulacan, Philippines', 
            'contact_person' => [ 
                'phone' => '639195380326', 
            ],
        ], 
        
    ], 
]; 
 
$json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $json); 
 
$result = curl_exec($curl); 
if ($result === false) { 
    throw new Exception(curl_error($curl), curl_errno($curl)); 
} 
 
echo $result; 