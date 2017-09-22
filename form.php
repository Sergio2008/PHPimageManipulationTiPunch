<!DOCTYPE html>
<html>
	<head>
		<title>form</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">


	</head>

	<body>

	<!-- Menu de gauche avec avatar -->
		<form action="upload.php" method="post" enctype="multipart/form-data"> ...
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		</form>

		<form action="./php.php" method="post">

			<p>
        <label>Nommez votre image :</label>
        <input type="text" name="imageTitre" /><br/><br/>
				<label>Ratio - Si laissé vide alors utilisation à 100% de la zone d'impression :</label>
			  <input type="text" name="reduction" /><br/><br/>
				<label >Ordonée</label>
    		<input type="text" name="x" />
    		<label >Absysse</label>
    		<input type="text" name="y" /><br/><br/>
    		<img src='http://localhost/PHPimageManipulationTiPunch/images_generer/mon_image.png' width='40%' height='auto'/><br/><br/>
    		<label >Modèle</label>
		<INPUT type= "radio" name="genre" value="homme">homme
        	<INPUT type= "radio" name="genre" value="femme">femme<br/><br/>
        	<label >Transparence</label>
        	<br/><br/>5 <input type="range" name="transparency" min="5" max="100" step="0.01" value="100"> 100%<br/><br/>
    		<input type="submit" value="Valider" />

			</p>

		</form>
	</body>
</html>
