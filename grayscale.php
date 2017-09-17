<?php 

function grayscale($img, $width, $height){
	$grayimg = $img;
    for ($x = 0; $x < $width; $x++){
    	for ($y = 0; $y < $height; $y++){
            
            $rgb = imagecolorat($img, $x, $y);
			$r=($rgb >> 16) & 0xFF;
			$g=($rgb >> 8) & 0xFF;
			$b=$rgb & 0xFF;
            $grey = (($r + $g + $b) / 3);
            $w=imagecolorallocate ( $grayimg , $grey , $grey , $grey );
			imagesetpixel ( $grayimg , $x , $y , $w );
        }
    }
    return $grayimg;
}

 ?>