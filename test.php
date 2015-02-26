<?php

$url = "http://healthcare.panfic.com/hisys/webservice.asmx/claim_status" ;
$params = [
  "user_name" => "priyo.apg",
  "password" => "apg123",
  "policy_no" => "201406010600676",
  "member_id" => "00001354-1",
  "plan" => "claim_status",
];


$map_url=$url . "?" . http_build_query($params);

//if (@simplexml_load_file($map_url)) {
   $response_xml_data = file_get_contents($map_url);
   libxml_use_internal_errors(true);
   $data = simplexml_load_string($response_xml_data);

   //echo print_r($data);
   //die;
   foreach($data as $books) { 
      echo print_r($books); 
   } 
//}

?>