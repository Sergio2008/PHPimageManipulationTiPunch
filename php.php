<?php

	/* ------- reglages des parametre ------ */

	$transparency = $_POST['transparency'];


	// On charge d'abord les images


	$uploadScFile = "images/motif/";

  $copySourceUrl = "images/motif/copy/"; //pour garder la source identique on copie l'image


  $sourceName ="21avril2017.png";


  $pictureSourceUrl = $uploadScFile . $sourceName;

  $fileType = strtolower(substr($pictureSourceUrl, strlen($pictureSourceUrl)-3));

  switch($fileType) {
      case('gif'):
          $source = imagecreatefromgif($pictureSourceUrl);
          echo "$pictureSourceUrl<br/><br/>";
          break;

      case('png'):
          $source = imagecreatefrompng($pictureSourceUrl); // Le logo est la source
          echo "$pictureSourceUrl<br/><br/>";
          break;

      default:
          $source = imagecreatefromjpeg($pictureSourceUrl);
          echo "$pictureSourceUrl<br/><br/>";

  }

  $uploadDsFile = "images/support/";
  $destination_y = $_POST['y']+1000; // COIN HAUT GAUCHE DE LA ZONE UTILE EN Y;
  $destination_x = $_POST['x']+673; // COIN HAUT GAUCHE DE LA ZONE UTILE EN X
  if ($_POST['genre']=='homme') {

      $destination_y = $_POST['y']+613; // COIN HAUT GAUCHE DE LA ZONE UTILE EN Y
      $destinationName ="hommeTshirt.png";
  }
  else $destinationName = "femmeTshirt.png";
  $pictureDestinationUrl = $uploadDsFile . $destinationName;

  echo $pictureDestinationUrl." <br/>";
  // var_dump($_POST);


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




  $largeur_source = imagesx($source);

  $hauteur_source = imagesy($source);
  // MISE A 100% DE LARGEUR OU HAUTEUR (SELON LE MOTIF) DE LA ZONE UTILE
  $largeur_max = 1181;
  $hauteur_max = 2362;
  // $scale = $_POST['percent'];
  var_dump($_POST['reduction'] != '');

  if ($_POST['reduction'] != '') {
    $Reduction = $_POST['reduction'];
    $NouvelleLargeur = ($largeur_source/100) * $Reduction;
    $NouvelleHauteur = ($hauteur_source/100) * $Reduction;
  }

  else {
    // Étape 1 :
    $NouvelleLargeur = 1181;

    // Étape 2 :
    $Reduction = ( ($NouvelleLargeur * 100)/$largeur_source );

    // Étape 3 :
    $NouvelleHauteur = ( ($hauteur_source * $Reduction)/100 );
  };

  $sourceScaled = imagescale( $source, $NouvelleLargeur, $NouvelleHauteur );
  imagepng($sourceScaled, $copySourceUrl);
  $fichierCopy = $copySourceUrl.$sourceName;
  echo $fichierCopy;



  echo ("<br/><br/>L'image est affichée a " . $Reduction . "%. <br/>La nouvelle largeur du motif est de " . $NouvelleLargeur . " px. ");
  //
  $destination = imagecreatefrompng($pictureDestinationUrl); // La photo est la destination
  echo (getimagesize($source));


  // Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image

  $largeur_destination = imagesx($destination);

  $hauteur_destination = imagesy($destination);


  // On veut placer le logo en haut à droite, on calcule les coordonnées où on  doit placer le logo sur la photo

  //$destination_x = $largeur_destination - $NouvelleLargeur;

  //$destination_y =  $hauteur_destination - $NouvelleHauteur;

// $destination_x = 0;
// $destination_y = 0;
	// On met le logo (source) dans l'image de destination (la photo)


	imagesavealpha($source, true);
	imagesavealpha($destination, true);

	imagecopymerge_alpha($destination, $sourceScaled, $destination_x, $destination_y, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $transparency);


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
  echo "<br/><img src='$newFile' width='40%' height='auto'/><br/>";

	$arr = array('source' => $newFile, 'loading' => 'finished');
	$arr2 = json_encode($arr);

  //bouton Back
	echo $arr2 . "<br/><br/><form action='./form.php'>
    <input type='submit' value='Back' />
</form>";

  $imglist = glob('./images/motif/*.{jpg,jpeg,gif,png}', GLOB_BRACE);
  var_dump($imglist);
  foreach ($imglist as $key => $value) {
    // var_dump($key => $value);
    echo("<br/><br/><ul><li style='display:inline;'><img src='$value' width='100px' height='auto'/></li></u>");
  }
	// echo json_decode($arr2);


?>