<?php

$image_path = "../../dist/watermark/images/watermark.png";

function watermark_image($oldimage_name, $new_image_name)
{
	global $image_path;
	$filetype = pathinfo(strtolower($oldimage_name), PATHINFO_EXTENSION);

	switch ($filetype) {
		case 'jpg':
			$img_src=imagecreatefromjpeg($oldimage_name);
			break;
		case 'png':
			$img_src=imagecreatefrompng($oldimage_name);
			break;
		case 'jpeg':
			$img_src=imagecreatefromjpeg($oldimage_name);
			break;
		default:
			# code...
			break;
	}
	
	// print_r($filetype); exit();
	list($owidth,$oheight) = getimagesize($oldimage_name);
	$width = $owidth; //ukuran gambar setelah mark
	$height = $oheight; //ukuran gambar setelah mark
	$im = imagecreatetruecolor($width, $height);
	unlink($oldimage_name); //delete image lama sebelum membuat image baru dengan nama yang sama
	imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
	$mark = imagecreatefrompng($image_path);
	list($w_width, $w_height) = getimagesize($image_path); 
	$pos_x = $width - $w_width; 
	$pos_y = $height - $w_height;
	//$pos_x-10 supaya gambar mark ke atas sepuluh pixel
	imagecopy($im, $mark, $pos_x-490, $pos_y-150, 0, 0, $w_width, $w_height);
	imagejpeg($im, $new_image_name, 1000);
	imagedestroy($im);
	//unlink($newImage);
	return true;
}
?>