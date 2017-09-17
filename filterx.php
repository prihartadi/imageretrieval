<?php 
include 'getvaluekonvolusi.php';
include 'getkernel.php';
function filterx($grayscale, $width, $height){
	$filterximg = $grayscale;
	for($y=1; $y<($height-1); $y++){
		for($x=1; $x<($width-1); $x++){
			$fx = getvaluekonvolusi(getkernel(0),$grayscale,$x,$y);
			$w=imagecolorallocate ($filterximg , $fx , $fx , $fx );
			imagesetpixel ( $filterximg , $x , $y , $w );
		}
	}
	return $filterximg; 
}

 ?>