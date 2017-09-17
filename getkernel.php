<?php

function getkernel($i){

	$sobelX[0][0] = -3; 
	$sobelX[0][1] = 0; 
	$sobelX[0][2] = 3;
	$sobelX[1][0] = -10; 
	$sobelX[1][1] = 0; 
	$sobelX[1][2] = 10;
	$sobelX[2][0] = -3; 
	$sobelX[2][1] = 0; 
	$sobelX[2][2] = 3;

	$sobelY[0][0] = -3; 
	$sobelY[0][1] = -10; 
	$sobelY[0][2] = -3;
	$sobelY[1][0] = 0;
	$sobelY[1][1] = 0; 
	$sobelY[1][2] = 0;
	$sobelY[2][0] = 3; 
	$sobelY[2][1] = 10; 
	$sobelY[2][2] = 3;

	$kernelfilter;
	if($i==0){
		$kernelfilter = array_values($sobelX);
	}
	else if($i==1) {
		$kernelfilter = array_values($sobelY);
	}
	return $kernelfilter;
}

 ?>