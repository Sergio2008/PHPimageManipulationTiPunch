<!DOCTYPE html>
<html>
	<head>
		<title>form</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">


	</head>

	<body>

	<!-- Menu de gauche avec avatar -->
		<form action="./php.php" method="post">

			<p>
			<label >Ordonée</label>
    		<input type="text" name="x" />
    		<label >Absysse</label>
    		<input type="text" name="y" /><br/><br/>
    		<label >Modèle</label>
        <INPUT type= "radio" name="genre" value="homme"> homme
        <INPUT type= "radio" name="genre" value="femme"> femme<br/><br/>
        <label >Transparence</label>
        <br/><br/>5 <input type="range" name="transparency" min="5" max="100" step="0.01" value="100"> 100%<br/><br/>

    		<input type="submit" value="Valider" />

			</p>

		</form>
	</body>
</html>