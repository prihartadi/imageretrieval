<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post" action="">
		<input type="file" name="input_img" id="input_img">
		<input type="submit" name="search">
	</form>
</body>
</html>

<?php
	include 'grayscale.php';
	// include 'filterx.php';
	// include 'filtery.php';
	//include 'getkernel.php';
	//include 'getvaluekonvolusi.php';
	include 'sobel.php';
	include 'getlbp.php';

	if(isset($_POST["search"])){
		//get image file
		$userimage="sources/".$_POST["input_img"];
		$aExtraInfo = getimagesize($userimage);
		$sImage = "data:".$aExtraInfo["mime"].";base64,".base64_encode(file_get_contents($userimage));
		//show image
		echo '<img src="'.$sImage.'"alt="Your Image"/>';
		//get size
		list($width, $height) = getimagesize($userimage);

		// $img = imagecreatefrompng($userimage);

		// $grayscale = grayscale($img, $width, $height);
		// imagepng($grayscale,"grayscale/input_grayscale.png");
		// $filterx = filterx($grayscale, $width, $height);
		// $filtery = filtery($grayscale, $width, $height);
		// imagepng($filterx,"filterxy/input_filterx.png");
		// imagepng($filtery,"filterxy/input_filtery.png");
		$sobel = sobel($userimage);
		imagepng($sobel,"sobel/input_sobel.png");
		echo '<img src="sobel/input_sobel.png"alt="Your Sobel Image"/>';

		$regheight = 5;
		$regwidth = 5;
		$tipepolalbp = 9;
		
		print_r(getlbp($sobel, $height, $width, $regwidth, $regheight, $tipepolalbp));
		
	}
 ?>