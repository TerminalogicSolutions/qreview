<?php 
function postImage($image, $recid, $max_width, $max_height, $cat, $directory)
	{
			if($image)

						//Function would start here.
						$output =  $directory . $recid . '_' . $cat . '.jpg';

						$size = GetImageSize($image);
						$width = $size[0];
						$height = $size[1];
						
						
						if ($width > 0)
						{
							$x_ratio = $max_width / $width;
							$y_ratio = $max_height / $height;
						
							if ( ($width <= $max_width) && ($height <= $max_height) ) 
							{
							  $tn_width = $width;
							  $tn_height = $height;
							}
							else if (($x_ratio * $height) < $max_height) 
							{
							  $tn_height = ceil($x_ratio * $height);
							  $tn_width = $max_width;
							}
							else 
							{
							  $tn_width = ceil($y_ratio * $width);
							  $tn_height = $max_height;
							}
						
							$src = ImageCreateFromJpeg($image);
						
							$dst =  imagecreatetruecolor($tn_width,$tn_height);
						
							ImageCopyResized($dst, $src, 0, 0, 0, 0, $tn_width,$tn_height,$width,$height);
						
							ImageJpeg($dst,$output, 100);
						}
	}
?>
