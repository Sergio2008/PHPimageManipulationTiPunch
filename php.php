<?php

	/* ------- reglages des parametre ------ */

	$transparency = 100;
	// header ("Content-type: image/jpeg"); // L'image que l'on va créer est un jpeg


	// On charge d'abord les images


	$uploadScFile = "images/motif/";
	$sourceName ="ecusson.png";
	$pictureSourceUrl = $uploadScFile . $sourceName;
	// echo $pictureSourceUrl;

	$uploadDsFile = "images/support/";
	$destinationName ="hommeTshirt.png";
	$pictureDestinationUrl = $uploadDsFile . $destinationName;
	// echo $pictureDestinationUrl;


	 function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);

        // copying relevant section from background to the cut resource
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

        // copying relevant section from watermark to the cut resource
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

        // insert cut resource to destination image
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

	$source = imagecreatefrompng($pictureSourceUrl); // Le logo est la source

	$largeur_source = imagesx($source);

	$hauteur_source = imagesy($source);
	// MISE A 100% DE LARGEUR OU HAUTEUR (SELON LE MOTIF) DE LA ZONE UTILE
	
	$largeur_max = 1181;
	$hauteur_max = 2362;	
	
	// Étape 1 :
	$NouvelleLargeur = 350;
	
	// Étape 2 :
	$Reduction = ( ($NouvelleLargeur * 100)/$largeur_source );
	
	// Étape 3 :
	$NouvelleHauteur = ( ($hauteur_source * $Reduction)/100 );

	$sourceScaled = imagescale( $source, $NouvelleLargeur, $NouvelleHauteur );
	//imagepng($source, $pictureSourceUrl);

	echo ("La nouvelle largeur du motif est de " . $NouvelleLargeur . " px. ");
	//
	$destination = imagecreatefrompng($pictureDestinationUrl); // La photo est la destination
	echo (getimagesize($source));


	// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image

	$largeur_destination = imagesx($destination);

	$hauteur_destination = imagesy($destination);


	// On veut placer le logo en haut à droite, on calcule les coordonnées où on 	doit placer le logo sur la photo

	//$destination_x = $largeur_destination - $NouvelleLargeur;

	//$destination_y =  $hauteur_destination - $NouvelleHauteur;

	$destination_x = $_POST['x']+673; // COIN HAUT GAUCHE DE LA ZONE UTILE EN X

	$destination_y =  $_POST['y']+613; // COIN HAUT GAUCHE DE LA ZONE UTILE EN Y
	
// $destination_x = 0;
// $destination_y = 0;
	// On met le logo (source) dans l'image de destination (la photo)


	imagesavealpha($source, true);
	imagesavealpha($destination, true);

	imagecopymerge_alpha($destination, $sourceScaled, $destination_x, $destination_y, 0, 0, 	$NouvelleLargeur, $NouvelleHauteur, $transparency);


	// On affiche l'image de destination qui a été fusionnée avec le logo

	// imagejpeg($destination);
	/* ---- generate the new shuffle file name ----- */

	// $chaine='abcdefghijklmnopqrstuvwxyz0123456789';
	// $melange=str_shuffle($chaine);
	// $resultName = substr($melange, 0, 8);

	/* ---- generate the new file name  ----- */
	$storageFile = "images_generer/";
	$resultName = "mon_image";
	$newExtentionName = ".png";
	$newFile = $storageFile.$resultName.$newExtentionName;

	/* ---- save the new file ----- */

	imagesavealpha($destination, true);
	imagesavealpha($source, true);
  	imagepng($destination, $newFile);

    // echo $newFile;
echo "<br/><img src='$newFile' width='50%' height='auto'><br/>";

	$arr = array('source' => $newFile, 'loading' => 'finished');
	$arr2 = json_encode($arr);
	echo $arr2;
	// echo json_decode($arr2);


?>
