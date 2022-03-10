<?php
function redimensionarImagen($imagen, $ancho_final, $alto_final){
		list($ancho_orig, $alto_orig, $nroTipo) = getimagesize($imagen);
		$exit = 0;
		switch ($nroTipo) {
			case 1: $img_original=imagecreatefromgif($imagen);break;
			case 2: $img_original=imagecreatefromjpeg($imagen);break;
			case 3: $img_original=imagecreatefrompng($imagen);break;
			case 6: $img_original=imagecreatefrombmp($imagen);break;
			case 15: $img_original=imagecreatefromwebp($imagen);break;
			case 16: $img_original=imagecreatefromxbm($imagen);break;
			default: echo 'Tipo de archivo incorrecto<br>'; $exit = 1; break;	
		}
		if ($exit == 0) {
            $aspecto = $ancho_orig / $alto_orig;
				if ($aspecto > $alto_final / $ancho_final) {
					$alto_final = $ancho_final / $aspecto;
				}
				else {
					$ancho_final = $aspecto * $alto_final;
				}
			$nueva_img = imageCreateTrueColor($ancho_final, $alto_final);
			imagecopyresampled($nueva_img, $img_original, 0, 0, 0, 0, $ancho_final,
			$alto_final, $ancho_orig, $alto_orig);
			imagedestroy($img_original);
			$nombre_imagen = time().'-product.webp';
			imagewebp($nueva_img, '../ar/products/'.$nombre_imagen , 100);
			return $nombre_imagen;
		}
	}
?>