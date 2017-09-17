<?php 
function sethistogram($histogram, $regionX, $regionY, $tipe)
{
    $save;
    $c = 0;
    for ($x = 0; $x < $regionX; $x++)
    {
        for ($y = 0; $y < $regionY; $y++)
        {
            for ($i = 0; $i < $tipe; $i++)
            {
                $save[$c] = $histogram[$x][$y][$i];
                $c++;
            }
        }
    }
    return $save;
}
?>