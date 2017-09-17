<?php 
include 'getvaluelbp.php';
include 'gettypelbp.php';
include 'sethistogram.php';

function getlbp($sobelimg, $height, $width, $regwidth, $regheight, $tipepolalbp){
	
	for ($i = 0; $i < $regheight; $i++){
        for ($j = 0; $j < $regwidth; $j++){
            for($k=0; $k < $tipepolalbp; $k++){
                $binLBP[$j][$i][$k] = 0;
            }
        }
    }

    $value = 0;
    for ($i = 0; $i < $regheight; $i++){
        for ($j = 0; $j < $regwidth; $j++){
            $batasX1 = $i * $width / $regwidth + 1;
            $batasX2 = ($i + 1) * $width / $regwidth - 1;
            $batasY1 = $j * $height / $regheight + 1;
            $batasY2 = ($j + 1) * $height / $regheight - 1;

            for ($y = $batasY1; $y < $batasY2; $y++){
                for ($x = $batasX1; $x < $batasX2; $x++){
                    //$w = imagecolorat($sobelimg, $x, $y)
                    $value = getvaluelbp($sobelimg, $x, $y);
                            
                    $typeLBP = array_values(gettypelbp($value,$tipepolalbp));
                    if($typeLBP[0]==1)
                        $binLBP[$j][$i][$typeLBP[1]]= $binLBP[$j][$i][$typeLBP[1]]+1;
                }
            }
        }
    }
    //return $binLBP;
    $save = sethistogram($binLBP, $regwidth, $regheight, $tipepolalbp);
    return $save;
}

// function getlbpvalue(){
// 	$value = 0;
//     //int[] polaLBP = new int[8];

//     for ($i = 0; $i < 8; $i++){
//         switch ($i){
//             case 0:
//                 if (((imagecolorat($grayscale,($x-1),($y-1)) >> 16) & 0xFF) >= bmp.GetPixel($x, y).R)
//                     $polaLBP[7] = 1;
//                 else
//                     $polaLBP[7] = 0;
//                 break;
//             case 1:
//                 if (bmp.GetPixel(x, y - 1).R >= bmp.GetPixel(x, y).R)
//                     $polaLBP[6] = 1;
//                 else
//                     $polaLBP[6] = 0;
//                 break;
//             case 2:
//                 if (bmp.GetPixel(x + 1, y - 1).R >= bmp.GetPixel(x, y).R)
//                     $polaLBP[5] = 1;
//                 else
//                     $polaLBP[5] = 0;
//                 break;
//             case 3:
//                 if (bmp.GetPixel(x + 1, y).R >= bmp.GetPixel(x, y).R)
//                     $polaLBP[4] = 1;
//                 else
//                     $polaLBP[4] = 0;
//                 break;
//             case 4:
//                 if (bmp.GetPixel(x + 1, y + 1).R >= bmp.GetPixel(x, y).R)
//                     $polaLBP[3] = 1;
//                 else
//                     $polaLBP[3] = 0;
//                 break;
//             case 5:
//                 if (bmp.GetPixel(x, y + 1).R >= bmp.GetPixel(x, y).R)
//                     $polaLBP[2] = 1;
//                 else
//                     $polaLBP[2] = 0;
//                 break;
//             case 6:
//                 if (bmp.GetPixel(x - 1, y + 1).R >= bmp.GetPixel(x, y).R)
//                     $polaLBP[1] = 1;
//                 else
//                     $polaLBP[1] = 0;
//                 break;
//             case 7:
//                 if (bmp.GetPixel(x - 1, y).R >= bmp.GetPixel(x, y).R)
//                     $polaLBP[0] = 1;
//                 else
//                     $polaLBP[0] = 0;
//                 break;

//         }
//     }
//     $value = getmin($polaLBP);
//     return $value;
// }

// function getmin(){

// }

// function gettypelbp(){

// }

 ?>