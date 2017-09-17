<?php 
include 'getvaluekonvolusi.php';
include 'getkernel.php';
function filtery($grayscale, $width, $height){
	$filteryimg = $grayscale;
	for($y=1; $y<($height-1); $y++){
		for($x=1; $x<($width-1); $x++){
			$fy = getvaluekonvolusi(getkernel(1),$grayscale,$x,$y);
			$w=imagecolorallocate ($filteryimg , $fy , $fy , $fy );
			imagesetpixel ( $filteryimg , $x , $y , $w );
		}
	}
	return $filteryimg; 
}

 ?>