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
	set_time_limit(0);
	include 'grayscale.php';
	include 'sobel.php';
	include 'getlbp.php';

	$regheight = 5;
	$regwidth = 5;
	$tipepolalbp = 9;

	//createjson($regwidth, $regheight, $tipepolalbp);
	//hitungjarak($tipepolalbp, $fitur_input);

	if(isset($_POST["search"])){
		//get image file
		//salah, ganti ke upload file
		$userimage="sources/".$_POST["input_img"];
		$aExtraInfo = getimagesize($userimage);
		$sImage = "data:".$aExtraInfo["mime"].";base64,".base64_encode(file_get_contents($userimage));
		//show image
		echo '<img src="'.$sImage.'"alt="Your Image"/>';
		//get size
		list($width, $height) = getimagesize($userimage);

		$sobel = sobel($userimage);
		imagepng($sobel,"sobel/input_sobel.png");
		echo '<img src="sobel/input_sobel.png"alt="Your Sobel Image"/>';
		
		$fitur_input = getlbp($sobel, $height, $width, $regwidth, $regheight, $tipepolalbp);
		//print_r($fitur_input);
		hitungjarak($tipepolalbp, $fitur_input);
		
	}

	function createjson($regwidth, $regheight, $tipepolalbp){
		$sources = scandir('sources');
		$dbfitur = scandir('json'.$tipepolalbp);
		$nsources = count($sources);
		$ndbfitur = count($dbfitur);
		// echo $nsources;
		// echo "<br>";
		// print_r($sources);
		// echo "<br>";
		// echo $ndbfitur;

		for($i=2; $i<$nsources; $i++){
			$sourcesimage = "sources/".$sources[$i];
			list($width1, $height1) = getimagesize($sourcesimage);
			$sobelsources = sobel($sourcesimage);
			imagepng($sobelsources,"sobel/".$sources[$i]);
			$fitur_sources = getlbp($sobelsources, $height1, $width1, $regwidth, $regheight, $tipepolalbp);
			$jsonfile = json_encode($fitur_sources);
			$fp = fopen('json'.$tipepolalbp.'/'.substr($sources[$i], 0,-4).'.json', 'w');
			fwrite($fp, $jsonfile);
			fclose($fp);
		}
	}

	function hitungjarak($tipepolalbp, $fitur_input){
		$dbfitur = scandir('json'.$tipepolalbp);
		$ndbfitur = count($dbfitur);
		//echo $ndbfitur;
		$jarak;
		$count = 0;
		for($i=2; $i<$ndbfitur; $i++){
			$jarak[$count] = 0;
			$resultimage[$count] = substr($dbfitur[$i], 0,-5).'.png';
			$fiturfile = file_get_contents('json'.$tipepolalbp.'/'.$dbfitur[$i]);
			$fiturimage = json_decode($fiturfile);
			for ($j=0; $j < count($fiturimage); $j++) { 
				$jarak[$count] = $jarak[$count]+pow(abs($fiturimage[$j]-$fitur_input[$j]),2);
			}
			$jarak[$count]=sqrt($jarak[$count]);
			$count++;
		}
		array_multisort($jarak,SORT_ASC,$resultimage);

		for($i=0; $i<10; $i++){
			echo '<img src="sources/'.$resultimage[$i].'"/>';
		}	
	}
 ?>