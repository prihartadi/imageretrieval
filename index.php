<?php 
set_time_limit(0);
include 'sobel.php';
include 'getlbp.php';
$regheight = 10;
$regwidth = 10;
$tipepolalbp = 9;
//createjson($regwidth, $regheight, $tipepolalbp);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>Image Retrieval</title>
</head>
<body>
	<div class="jumbotron">
		<div class="container">
			<h1 id="title">Find your Aves!</h1>
			<form method="post" action="">
				<input type="file" name="input_img" id="input_img" class="btn btn-lg btn-default" onchange="this.form.submit();">
			</form>
			<br>
		</div>
	</div>
	<div class="container">

		<?php 
		if(isset($_POST["input_img"])){
			$userimage="sources/".$_POST["input_img"];
			echo '<img src="'.$userimage.'"alt="Your Image" class="img-rounded"/>';
			echo "<h3>Your Bird Image</h3>";
			echo "<br>";
		}
		?>

		<div class="row">

			<?php 
			if(isset($_POST["input_img"])){
				list($width, $height) = getimagesize($userimage);
				$sobel = sobel($userimage);
				imagepng($sobel,"sobel/input_sobel.png");
				$fitur_input = getlbp($sobel, $height, $width, $regwidth, $regheight, $tipepolalbp);
				$hasil = hitungjarak($tipepolalbp, $fitur_input);
				for($i=0; $i<9; $i++){
					echo '<div class="col-md-4"><img src="sources/'.$hasil[$i].'" class="img-rounded"/></div>';
				}				
			}
			?>

		</div>
    </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/ie-emulation-modes-warning.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
function createjson($regwidth, $regheight, $tipepolalbp){
	$sources = scandir('sources');
	$dbfitur = scandir('json'.$tipepolalbp);
	$nsources = count($sources);
	$ndbfitur = count($dbfitur);
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
	return $resultimage;
}
?>