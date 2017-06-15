<?php
	
	/* ------- reglages des parametre ------ */

	$transparency = 60;
	// header ("Content-type: image/jpeg"); // L'image que l'on va créer est un jpeg


	// On charge d'abord les images
	

	$uploadScFile = "images/motif/";
	$sourceName ="ecusson.png"; 
	$pictureSourceUrl = $uploadScFile  . $sourceName;
	// echo $pictureSourceUrl;

	$uploadDsFile = "images/support/";
	$destinationName ="hommeTshirt.png"; 
	$pictureDestinationUrl = $uploadDsFile  . $destinationName;
	// echo $pictureDestinationUrl;

	$source = imagecreatefrompng($pictureSourceUrl); // Le logo est la source

	$destination = imagecreatefrompng($pictureDestinationUrl); // La photo est la destination


	// Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image

	$largeur_source = imagesx($source);

	$hauteur_source = imagesy($source);

	$largeur_destination = imagesx($destination);

	$hauteur_destination = imagesy($destination);


	// On veut placer le logo en bas à droite, on calcule les coordonnées où on 	doit placer le logo sur la photo
/*
	$destination_x = $largeur_destination - $largeur_source;

	$destination_y =  $hauteur_destination - $hauteur_source;
	*/
	$destination_x = $_POST['x'];

	$destination_y =  $_POST['y'];


	// On met le logo (source) dans l'image de destination (la photo)

	imagecopymerge($destination, $source, $destination_x, $destination_y, 0, 0, 	$largeur_source, $hauteur_source, $transparency);


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

    imagepng($destination, $newFile);

    // echo $newFile;
    

	$arr = array('source' => $newFile, 'loading' => 'finished');
	$arr2 = json_encode($arr);
	echo $arr2;
	//echo json_decode($arr2);
	

	/*	$a = "dfwbsd";
	var_dump ($a); 
	*/
/*
<!DOCTYPE html>
<html>
<head>
		<title>titre</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
		<form method="post" action="reception.php" enctype="multipart/form-data">
     <label for="icone">Icône du fichier (JPG, PNG ou GIF | max. 15 Ko) :</label><br />
     <input type="file" name="icone" id="icone" /><br />
     <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br />
     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
     <input type="file" name="mon_fichier" id="mon_fichier" /><br />
     <label for="titre">Titre du fichier (max. 50 caractères) :</label><br />
     <input type="text" name="titre" value="Titre du fichier" id="titre" /><br />
     <label for="description">Description de votre fichier (max. 255 caractères) :</label><br />
     <textarea name="description" id="description"></textarea><br />
     <input type="submit" name="submit" value="Envoyer" />
</form>
	</body>

	
</html>
*/
?>
