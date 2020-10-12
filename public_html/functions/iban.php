<?php

//LT12 1000 0111 0100 1000
function GenerateIban()
{
    $iban = 'LT12 1000 0';
    $iban .= '' . rand(100, 999) . ' ' . rand(1000, 9999) . ' ' . rand(1000, 9999);
    return $iban;
}

// function validatePersonNumber($number)
// {
//     $is_valid = true;


//     if (strlen($number . '') != 11) {
//         $is_valid = false;
//         return $is_valid;
//     }

//     if (!is_numeric($number)) {
//         $is_valid = false;
//         return $is_valid;
//     }

//     //First digit
//     if (!((substr($number . '', 0, 1) > 0) && (substr($number . '', 0, 1) < 7))) {
//         $is_valid = false;
//         return $is_valid;
//     }

//     $year = substr($number . '', 1, 2);
//     $month = substr($number . '', 3, 2);
//     $day = substr($number . '', 5, 2);
//     $year = $year > 30 ? '19' . $year : '20' . $year;
//     _c($year);
//     _c($month);
//     _c($day);

//     if (!checkdate($month, $day, $year)) {
//         $is_valid = false;
//         return $is_valid;
//     }

//     return $is_valid;
// }

function validatePersonNumber($s)
{
    if (!is_numeric($s) || strlen($s) != 11) {

        return false;
    }
    $d = 0;
    $e = 0;
    $b = 1;
    $c = 3;
    for ($i = 0; $i < 10; $i++) {
        $a = $s[$i];
        $d = $d + ($b * $a);
        $e = $e + ($c * $a);
        $b++;
        if ($b == 10) $b = 1;
        $c++;
        if ($c == 10) $c = 1;
    }
    $d = $d % 11;
    $e = $e % 11;
    if ($d == 10) {
        $i = ($e == 10) ? 0 : $e;
    } else {
        $i = $d;
    }
    return ($s[10] == $i) ? true : false;
}

function uniquePersonalNumber($number) {

    $db = json_decode(file_get_contents(__DIR__.'/../db.json'), 1);
    // _c($db);


    $is_unique = true;
    foreach($db as $value) {
        // _c(''.$value['personalnumber'], $number);


        if('a'.$value['personalnumber'] == 'a'.$number) {
            $is_unique = false;
            // _c("Hello");
            return false;
        }
    }
    return true;
}

function inputStringValidation($str) {
    $is_name_valid = true;
    $pattern = '/(\d)|(\W)/'; 
    $pattern2 = '/([ąčęėįšųūžĄČĘĖĮŠŲŪŽ])/'; 
    $str_lt_replace = preg_replace($pattern2, '', $str);

    if(strlen($str) < 4) {
        $is_name_valid = false;
        return $is_name_valid;
    }

    // _c($str_lt_replace);

    if(preg_match($pattern, $str_lt_replace) != 0) {
        // _c(preg_match($pattern, $str_lt_replace));
        $is_name_valid = false;
    }
    return $is_name_valid;
}


function validSum($money) {
    $pattern = '/^[0-9]+(\.[0-9]{1,2})?/';
    if(strlen(preg_replace($pattern, '', $money)) != 0) {
        return false;
    }
    return true;
}
