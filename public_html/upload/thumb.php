<?php
header('Content-Type: image/jpeg');

$filename = $_GET['img'];
$widthSet = $_GET['w'];
$heightSet = $_GET['h'];
$display = $_GET['display'];
if($widthSet == $heightSet){
    $widthSet++;
}

if($display == ''){
	$display = "paisagem";
}

$exten = substr($filename,-3);

list($width, $height) = getimagesize($filename);

if($display == "paisagem"){
//Se a altura for maior que a largura, a proporção será pela largura
	//if($height>$width){
		$calcProporcao = $width/$widthSet;
		$new_widthCalc = $width/$calcProporcao;
		$new_width = number_format($new_widthCalc,0);
		$new_heightCalc = $height/$calcProporcao;
		$new_height = $new_heightCalc;
	//}
}
/*if($height<$width){
	$calcProporcao = $width/$widthSet;
	$new_heightCalc = $height/$calcProporcao;
	$new_height = number_format($new_heightCalc,0);
	$new_width = $widthSet;
}*/

////////////////////////////////// se a imagem for menor do q a especificada mater tamanho de imagem
if($height<$heightSet && $width < $widthSet){
		$new_width = $width;
		$new_height = $height;
	}
	
if($heightSet<$widthSet && $height==$width){
	$calcProporcao = $height/$heightSet;
	$new_widthCalc = $width/$calcProporcao;
	$new_width = number_format($new_widthCalc,0);
	$new_height = $heightSet;
}

if($heightSet>$widthSet && $height==$width){
	$calcProporcao = $width/$widthSet;
	$new_heightCalc = $height/$calcProporcao;
	$new_height = number_format($new_heightCalc,0);
	$new_width = $widthSet;
}


//echo $new_height."davi".$width; 
//echo $new_width."largura". $height;
//$new_width = $widthSet;
//$new_height = $heightSet;

$image_p = imagecreatetruecolor($new_width, $new_height);

 if($exten=='png'){
        $image = imagecreatefrompng($filename);
    }
    elseif($exten=='gif'){
        $image = imagecreatefromgif($filename);
    }
    else{
        $image = imagecreatefromjpeg($filename);
    }

imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
imagejpeg($image_p, null, 100);

imagedestroy($image_p);

?>