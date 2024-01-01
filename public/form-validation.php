<?php

function empty_fields(array $list){
    foreach($list as $item){
        if(empty($item)){
            return true;
        }
    }
    return false;
}

function validPassword($str){

    // Pattern allows all characters (uppercase, lowercase, numerals and special characters) but MUST include uppercase and numeral (at least one of each)
    $regex_pattern = "/^(?=.*[0-9])(?=.*[A-Z])[A-Za-z0-9!-\/:-@[-`{-~]{8,}$/";
    return(preg_match($regex_pattern, $str));
}


function validEmail($str){
    return !filter_var($str, FILTER_VALIDATE_EMAIL)?false:true;
}

function checkForDuplicates(array $list){
    foreach($list as $item){
        for($i=0;$i<count($list);$i++){
            if(strnatcasecmp($item, $list[$i]) == 0 && $i != array_search($item, $list)){
                return true;
            }
        }
    }
    return false;
}

?>