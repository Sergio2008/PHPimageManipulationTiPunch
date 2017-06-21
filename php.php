<?php

	/* ------- reglages des parametre ------ */

	$transparency = $_POST['transparency'];


	// On charge d'abord les images


	$uploadScFile = "images/motif/";

  $copySourceUrl = "images/motif/copy/"; //pour garder la source identique on copie l'image


  $sourceName ="tumblr_onduxhdXjd1s9jja0o1_540.jpg";


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

    $largeur_max = 1181;
    $hauteur_max = 2362;
    $destination_y = $_POST['y']+613; // COIN HAUT GAUCHE DE LA ZONE UTILE EN Y
    $destinationName ="hommeTshirt.png";
  }
  else {
    $largeur_max = 1160;
    $hauteur_max = 1700;
    $destinationName = "femmeTshirt.png";
  }
  $pictureDestinationUrl = $uploadDsFile . $destinationName;

  echo $pictureDestinationUrl." <br/>";
  // var_dump($_POST);

  $widthZone = $largeur_max;
  $heightZone = $hauteur_max;

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
  // $scale = $_POST['percent'];
  var_dump($_POST['reduction'] != '');

  if ($_POST['reduction'] != '') {
    $Reduction = $_POST['reduction'];
    $NouvelleLargeur = ($largeur_source/100) * $Reduction;
    $NouvelleHauteur = ($hauteur_source/100) * $Reduction;
  }

  else {

    // Étape 1 :
    $NouvelleLargeur = $largeur_max;

    // Étape 2 :
    $Reduction = ( ($NouvelleLargeur * 100)/$largeur_source );

    // Étape 3 :
    $NouvelleHauteur = ( ($hauteur_source * $Reduction)/100 );
  };

  $sourceScaled = imagescale( $source, $NouvelleLargeur, $NouvelleHauteur );

  imagepng($sourceScaled, $copySourceUrl);
  $fichierCopy = $copySourceUrl.$sourceName;
  echo $fichierCopy;

// centre de l'image :

$centerXimg = $NouvelleLargeur / 2;
$centerYimg = $NouvelleHauteur / 2;

//


  echo ("<br/><br/>L'image est affichée a " . $Reduction . "%. <br/>La nouvelle largeur du motif est de " . $NouvelleLargeur . " px. ");
  //
  $destination = imagecreatefrompng($pictureDestinationUrl); // La photo est la destination
  echo (getimagesize($source));

  if ($NouvelleHauteur < $hauteur_max) {
    $hauteur_max = $NouvelleHauteur;
  };
  if ($NouvelleLargeur < $largeur_max) {
    $largeur_max = $NouvelleLargeur;
  };

  imagecopymerge_alpha($destination, $sourceScaled, $destination_x, $destination_y, (($NouvelleLargeur - $largeur_max) / 2), (($NouvelleHauteur - $hauteur_max) / 2), $largeur_max-$_POST['x'], $hauteur_max-$_POST['y'], $transparency);




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