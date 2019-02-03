<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Tiro & Bomba</title>
	<style>
	table, th, td {
		font-size: 20px;
		border: 1px black solid;
	}
	td {
		font-weight: bold;
	}

	input {
		width: 400px;
		height: 50px;
	}

	.tamanhoTexto {
		font-size: 30px;
	}
</style>
<link href="css/bootstrap.css" rel="stylesheet">
</head>

<body>
	<div hidden id="tabelaJogadas" class="container-fluid content table-responsive table-full-width">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th style="background-color: #34495e; color: white;" class="text-center" colspan="6">CHUTES DO JOGO</th>
				</tr>
				<tr>
					<th colspan="3" style="background-color: #bdc3c7;" class="text-center">JOGADOR 1</th>
					<th colspan="3" style="background-color: #bdc3c7;" class="text-center">JOGADOR 2</th>
				</tr>
				<tr>
					<td style="background-color: #bdc3c7; font-size: 15px;" class="text-center">CHUTE</td>
					<td style="background-color: #bdc3c7; font-size: 15px;" class="text-center">TIROS</td>
					<td style="background-color: #bdc3c7; font-size: 15px;" class="text-center">BOMBAS</td>
					<td style="background-color: #bdc3c7; font-size: 15px;" class="text-center">CHUTE</td>
					<td style="background-color: #bdc3c7; font-size: 15px;" class="text-center">TIROS</td>
					<td style="background-color: #bdc3c7; font-size: 15px;" class="text-center">BOMBAS</td>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

	<div class="tamanhoTexto container text-center">
		<div id="num1">
			<h1>Número jogador 1</h1>
			<input type="password" id="numJogador1">
		</div>

		<div hidden id="num2">
			<h1>Número jogador 2</h1>
			<input type="password" id="numJogador2">
		</div>

		<br>

		<button type="submit" class="btn btn-primary btn-page btn-lg" id="enviarNum">ENVIAR</button>

		<div hidden id="divChutes">
			<div hidden id="divJogador1">
				<h1>CHUTE JOGADOR 1</h1>
				<input type="text" id="chute1">
			</div>

			<div hidden id="divJogador2">
				<h1>CHUTE JOGADOR 2</h1>
				<input type="text" id="chute2">			
			</div>

			<br>

			<button type="submit" class="btn btn-success btn-page btn-lg" id="chutar">CHUTAR</button>
		</div>

	</div>



</body>
<script type="text/javascript" src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/vanilla-masker.js"></script>
</html>

<script>
	// Máscaras dos inputs
	VMasker(document.querySelector("#numJogador1")).maskPattern("9,9,9,9");
	VMasker(document.querySelector("#numJogador2")).maskPattern("9,9,9,9");
	VMasker(document.querySelector("#chute1")).maskPattern("9,9,9,9");
	VMasker(document.querySelector("#chute2")).maskPattern("9,9,9,9");

	// Pegando a ação do ENTER e colocando como submit do botão
	$("#numJogador1, #numJogador2").keypress(function (e) {
		if(e.which == 13) $('#enviarNum').click();
	});

	$("#chute1, #chute2").keypress(function (e) {
		if(e.which == 13) $('#chutar').click();
	});

	$("#enviarNum").click(function(e){
		e.preventDefault();

		if (!$("#numJogador1").val()) return alert("Coloca os números aí, caralho!");

		if ($("#numJogador1").val() && !$("#numJogador2").val()){
			$("#num1").hide();
			$("#num2").show();
		} else {
			$("#num2").hide();
			$("#enviarNum").hide();
			$("#divChutes").show();
			$("#divJogador1").show();
			$("#tabelaJogadas").show();
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
		console.log(chute, jogador, numJogador);
		$.ajax({
			url: 'calculo.php',
			data : {
				chute : chute,
				numJogador : numJogador,
				jogador : jogador
			},
			success : function(data){
				obj = JSON.parse(data);
				console.log(data);
				if (obj.jogador == '1') {
					var markup = 
					"<td style='background-color: #2ecc71;' class='text-center'>" + obj.chute + "</td><td style='background-color: #2ecc71;' class='text-center'>" + obj.tiro  + "</td><td style='background-color: #2ecc71;' class='text-center'>" + obj.bomba + "</td>";

					$("table tbody").append(markup);

					if (obj.bomba == '4') alert("CHUPA OTÁRIO!!! 4 BOMBAS!");
				} else {
					var markup =
					"<td style='background-color: #e74c3c;' class='text-center'>" + obj.chute + "</td><td style='background-color: #e74c3c;' class='text-center'>" + obj.tiro  + "</td><td style='background-color: #e74c3c;' class='text-center'>" + obj.bomba + "</td>";
					var nova_tr = "<tr></tr>";
					$("table tbody").append(markup);
					$("table tbody").append(nova_tr);

					if (obj.bomba == '4') alert("CHUPA OTÁRIO!!! 4 BOMBAS!");
				}
			},
			type : 'POST'
		});
	});	
</script>