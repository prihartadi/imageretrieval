<?php 

function getminishiftlbp($polaLBP)
{
    $minimal = 255;
    $temp = 0;
    for ($i = 0; $i < 8; $i++)
    {
        $temp = $polaLBP[7];
        $polaLBP[7] = $polaLBP[6];
        $polaLBP[6] = $polaLBP[5];
        $polaLBP[5] = $polaLBP[4];
        $polaLBP[4] = $polaLBP[3];
        $polaLBP[3] = $polaLBP[2];
        $polaLBP[2] = $polaLBP[1];
        $polaLBP[1] = $polaLBP[0];
        $polaLBP[0] = $temp;

        $value = 0;
        for ($j = 0; $j < 8; $j++)
        {
            $value = $value + ((int)pow(2, $j)) * $polaLBP[$j];
        }
        if ($minimal > $value) $minimal = $value;
    }
    return $minimal;
}
function getvaluelbp($bmp, $x, $y)
{
    $value = 0;
    $polaLBP;
    $rgb = imagecolorat($bmp, $x - 1, $y - 1);
    $r=($rgb >> 16) & 0xFF;
    $rgb2 = imagecolorat($bmp, $x, $y);
    $r2=($rgb >> 16) & 0xFF;
    if ($r >= $r2) { $polaLBP[7] = 1; } else { $polaLBP[7] = 0; }
    $rgb = imagecolorat($bmp, $x, $y - 1);
    $r=($rgb >> 16) & 0xFF;
    if ($r >= $r2) { $polaLBP[6] = 1; } else { $polaLBP[6] = 0; }
    $rgb = imagecolorat($bmp, $x+1, $y - 1);
    $r=($rgb >> 16) & 0xFF;
    if ($r >= $r2) { $polaLBP[5] = 1; } else { $polaLBP[5] = 0; }
    $rgb = imagecolorat($bmp, $x+1, $y);
    $r=($rgb >> 16) & 0xFF;
    if ($r >= $r2) { $polaLBP[4] = 1; } else { $polaLBP[4] = 0; }
    $rgb = imagecolorat($bmp, $x+1, $y+1);
    $r=($rgb >> 16) & 0xFF;
    if ($r >= $r2) { $polaLBP[3] = 1; } else { $polaLBP[3] = 0; }
    $rgb = imagecolorat($bmp, $x, $y+1);
    $r=($rgb >> 16) & 0xFF;
    if ($r >= $r2) { $polaLBP[2] = 1; } else { $polaLBP[2] = 0; }
    $rgb = imagecolorat($bmp, $x-1, $y+1);
    $r=($rgb >> 16) & 0xFF;
    if ($r >= $r2) { $polaLBP[1] = 1; } else { $polaLBP[1] = 0; }
    $rgb = imagecolorat($bmp, $x-1, $y);
    $r=($rgb >> 16) & 0xFF;
    if ($r >= $r2) { $polaLBP[0] = 1; } else { $polaLBP[0] = 0; }

    $value = getminishiftlbp($polaLBP);
            //Debug.WriteLine(""+value);
    return $value;
}

 ?>