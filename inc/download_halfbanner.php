<?php

function getOS($user_agent) { 

    $os_platform  = "Unknown";
    $os_array     = array(
                          '/windows/i'            =>  'Windows',
                          '/win98/i'              =>  'Windows',
                          '/win95/i'              =>  'Windows',
                          '/win16/i'              =>  'Windows',
                          '/macintosh|mac os x/i' =>  'macOS',
                          '/mac_powerpc/i'        =>  'macOS',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Linux',
                          '/iphone/i'             =>  'iOS',
                          '/ipod/i'               =>  'iOS',
                          '/ipad/i'               =>  'iOS',
                          '/android/i'            =>  'Android'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }

    return $os_platform;
}

$user_os        = getOS($_SERVER['HTTP_USER_AGENT']);

$device_details = "<strong>Operating System: </strong>".$user_os."<br /><br /><br />";

print_r($device_details);

?>
