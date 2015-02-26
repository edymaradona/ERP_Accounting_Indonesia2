<?php

class MedicalComponent
{

    public static function Panfic($type,$member_id,$plan="OP")
    {
        if (!empty($member_id)) {
            $url = "http://healthcare.panfic.com/hisys/webservice.asmx/".$type ;
            $params = [
              "user_name" => "priyo.apg",
              "password" => "apg123",
              "policy_no" => "201406010600676",
              "member_id" => $member_id,
              "plan" => $plan,
            ];


            $map_url=$url . "?" . http_build_query($params);

            if (@simplexml_load_file($map_url)) {
               $response_xml_data = file_get_contents($map_url);
               libxml_use_internal_errors(true);
               $data = simplexml_load_string($response_xml_data);
               if ($data != 999999999) {
                 echo peterFunc::indoFormat((int)$data);
               } else 
                 echo 0;
            }
        } else
            return "";
    }
}

