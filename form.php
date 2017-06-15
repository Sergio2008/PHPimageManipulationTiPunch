<!DOCTYPE html>
<html>
	<head>
		<title>form</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="{{url('css/normalize.css')}}">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://unpkg.com/masonry-layout@4.1/dist/masonry.pkgd.js"></script>
		<script type="text/javascript" src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
		<script type="text/javascript" src="{{url('js/masonry.js')}}"></script>
		<script type="text/javascript" src="{{url('js/validation.js')}}"></script>
		<link rel="stylesheet" href="{{url('css/style_code_closet.css')}}">

	</head>

	<body>

	<!-- Menu de gauche avec avatar -->
		<form action="php.php" method="post">

			<p>
			<label >Ordonée</label>
    		<input type="text" name="x" />
    		<label >Absysse</label>
    		<input type="text" name="y" />

    		<input type="submit" value="Valider" />

			</p>

		</form>
	</body>
</html>
