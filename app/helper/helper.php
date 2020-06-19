<?php

// Read Providers From Json Files

function readJsonFile($name,$key){
    $path = storage_path() . "/jsonfiles/".$name.".json";
    $json = json_decode(file_get_contents($path), true);
    $test = [];
    for ($i=0; $i < count($json[$key]); $i++) { 
        $json[$key][$i]['provider'] = $name;
    }
    return $json;
}

// Merge Providers Json

function combineProviders($providers){
    $result = [];
    for ($i=0; $i < count($providers); $i++) {
        for ($j=0; $j < count($providers[$i]['users']); $j++) { 
            array_push($result,$providers[$i]['users'][$j]);
        }
    }
    return $result;
}

/*
    $providers => Array of Provider
    $needles   => Array of Needle Do You Want To Search By Them ex: status,statusCode,...
    $values    => Array of Results' Values ex 1,100,2,200,...
*/
function searchProviders($providers , $needles , $values)
{
    $output = [];
    foreach ($providers as $provider) {
        foreach ($provider as $key => $value) {
            if (in_array($key,$needles)) {
                if (is_array($values)) {
                    if (in_array($value,$values)) {
                        array_push($output,$provider);
                    }
                }else{
                    if ($value == $values) {
                        array_push($output,$provider);
                    } 
                }
            }
        }
    }
    return $output;
}