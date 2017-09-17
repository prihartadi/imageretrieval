<?php 

function getvaluekonvolusi($hasilkernel, $grayscale, $x,$y){
	$value = 0;
	$dimensi = 3;
	$pembagi = 1;
	if($dimensi ==3){
		$value += $hasilkernel[0][0] * ((imagecolorat($grayscale,($x-1),($y-1)) >> 16) & 0xFF);
		$value += $hasilkernel[0][1] * ((imagecolorat($grayscale,$x,($y-1)) >> 16) & 0xFF);
        $value += $hasilkernel[0][2] * ((imagecolorat($grayscale,($x+1),($y-1)) >> 16) & 0xFF);

        $value += $hasilkernel[1][0] * ((imagecolorat($grayscale,($x-1),$y) >> 16) & 0xFF);
		$value += $hasilkernel[1][1] * ((imagecolorat($grayscale,$x,$y) >> 16) & 0xFF);	
        $value += $hasilkernel[1][2] * ((imagecolorat($grayscale,($x+1),$y) >> 16) & 0xFF);

        $value += $hasilkernel[2][0] * ((imagecolorat($grayscale,($x-1),($y+1)) >> 16) & 0xFF);
		$value += $hasilkernel[2][1] * ((imagecolorat($grayscale,$x,($y+1)) >> 16) & 0xFF);	
        $value += $hasilkernel[2][2] * ((imagecolorat($grayscale,($x+1),($y+1)) >> 16) & 0xFF);
	}
	if ($value < 0) 
		$value = 0;
    if ($value > 255) 
    	$value = 255;
    return ($value / $pembagi);
}

 ?>