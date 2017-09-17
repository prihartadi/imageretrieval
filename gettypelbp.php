<?php 

function gettypelbp($value, $tipe)
{
    $typeLBP;
    $typeLBP[0] = 1;
    $typeLBP[1] = $value;
    if ($tipe == 9)
    {
        if ($value == 255) { $typeLBP[1] = 0; }
        else if ($value == 127) { $typeLBP[1] = 1; }
        else if ($value == 63) { $typeLBP[1] = 2; }
        else if ($value == 31) { $typeLBP[1] = 3; }
        else if ($value == 15) { $typeLBP[1] = 4; }
        else if ($value == 7) { $typeLBP[1] = 5; }
        else if ($value == 3) { $typeLBP[1] = 6; }
        else if ($value == 1) { $typeLBP[1] = 7; }
        else if ($value == 0) { $typeLBP[1] = 8; }
        else { $typeLBP[0] = 0; }
    }
    else if ($tipe == 36)
    {
        if ($value == 255) { $typeLBP[1] = 0; }
        else if ($value == 127) { $typeLBP[1] = 1; }
        else if ($value == 63) { $typeLBP[1] = 2; }
        else if ($value == 31) { $typeLBP[1] = 3; }
        else if ($value == 15) { $typeLBP[1] = 4; }
        else if ($value == 7) { $typeLBP[1] = 5; }
        else if ($value == 3) { $typeLBP[1] = 6; }
        else if ($value == 1) { $typeLBP[1] = 7; }
        else if ($value == 0) { $typeLBP[1] = 8; }

        else if ($value == 95) { $typeLBP[1] = 9; }
        else if ($value == 111) { $typeLBP[1] = 10; }
        else if ($value == 119) { $typeLBP[1] = 11; }
        else if ($value == 47) { $typeLBP[1] = 12; }
        else if ($value == 79) { $typeLBP[1] = 13; }
        else if ($value == 55) { $typeLBP[1] = 14; }
        else if ($value == 87) { $typeLBP[1] = 15; }
        else if ($value == 103) { $typeLBP[1] = 16; }
        else if ($value == 91) { $typeLBP[1] = 17; }

        else if ($value == 23) { $typeLBP[1] = 18; }
        else if ($value == 39) { $typeLBP[1] = 19; }
        else if ($value == 71) { $typeLBP[1] = 20; }
        else if ($value == 27) { $typeLBP[1] = 21; }
        else if ($value == 43) { $typeLBP[1] = 22; }
        else if ($value == 75) { $typeLBP[1] = 23; }
        else if ($value == 51) { $typeLBP[1] = 24; }
        else if ($value == 83) { $typeLBP[1] = 25; }
        else if ($value == 85) { $typeLBP[1] = 26; }

        else if ($value == 11) { $typeLBP[1] = 27; }
        else if ($value == 19) { $typeLBP[1] = 28; }
        else if ($value == 35) { $typeLBP[1] = 29; }
        else if ($value == 67) { $typeLBP[1] = 30; }
        else if ($value == 21) { $typeLBP[1] = 31; }
        else if ($value == 37) { $typeLBP[1] = 32; }
        else if ($value == 5) { $typeLBP[1] = 33; }
        else if ($value == 9) { $typeLBP[1] = 34; }
        else if ($value == 17) { $typeLBP[1] = 35; }

        else { $typeLBP[0] = 0; }
    }
    else {
                //do nothing
    }

    return $typeLBP;
}
 ?>