<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Tiro & Bomba</title>
</style>
</head>

<body>
	<div id="num1">
		<h3>Número jogador 1</h3>
		<input type="password" id="numJogador1">
	</div>

	<div hidden id="num2">
		<h3>Número jogador 2</h3>
		<input type="password" id="numJogador2">
	</div>

	<br>
	
	<button id="enviarNum">Enviar</button>

	<div hidden id="divChutes">
		<div hidden id="divJogador1">
			<h3>CHUTE JOGADOR 1</h3>
			<input type="text" id="chute1">
		</div>

		<div hidden id="divJogador2">
			<h3>CHUTE JOGADOR 2</h3>
			<input type="text" id="chute2">			
		</div>

		<br>

		<button id="chutar">Chutar</button>
	</div>

</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.js"></script>
<script src="js/vanilla-masker.js"></script>
</html>

<script>
	VMasker(document.querySelector("#numJogador1")).maskPattern("9,9,9,9");
	VMasker(document.querySelector("#numJogador2")).maskPattern("9,9,9,9");

	VMasker(document.querySelector("#chute1")).maskPattern("9,9,9,9");
	VMasker(document.querySelector("#chute2")).maskPattern("9,9,9,9");

	$("#enviarNum").click(function(e){
		e.preventDefault();

		if ($("#numJogador1").val() && !$("#numJogador2").val()){
			$("#num1").hide();
			$("#num2").show();
		} else {
			$("#num2").hide();
			$("#enviarNum").hide();
			$("#divChutes").show();
			$("#divJogador1").show();
		}
	});

	$("#chutar").click(function(e){
		e.preventDefault();

		if ($("#chute1").val() && !$("#chute2").val()){
			chute = $("#chute1").val();
			jogador = "1";
			numJogador = $("#numJogador2").val();
			document.getElementById("chute1").value = "";
			$("#divJogador1").hide();
			$("#divJogador2").show();
		} else {
			chute = $("#chute2").val();
			jogador = "2";
			numJogador = $("#numJogador1").val();
			document.getElementById("chute2").value = "";
			$("#divJogador2").hide();
			$("#divJogador1").show();
		}
		$.ajax({
			url: 'calculo.php',
			data : {
				chute : chute,
				numJogador : numJogador,
				jogador : jogador
			},
			success : function(data){
				obj = JSON.parse(data);
				if (obj.bomba == '4') {
					console.log("CHUPA OTÁRIO!!! 4 BOMBAS!!!");
				} else {
					console.log(data);
				}
			},
			type : 'POST'
		});

	});
	
</script>