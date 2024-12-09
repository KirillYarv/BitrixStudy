<?php 
function resize_photo($photo,$newWidth = 39, $newHeight = 39){
    $renderImage = CFile::ResizeImageGet($photo, Array("width" => $newWidth, "height" => $newHeight),BX_RESIZE_IMAGE_EXACT);
	return $renderImage['src'];
}