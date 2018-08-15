<?php 
	require_once("config.php");
	
	$cliente = new ClienteDao();
	$cliente->ordem = "nome";
	$clientes = $cliente->loadAll(True);
	
	echo "<table border = 1>";
	
	echo "	<th>CÓDIGO</th>";
	echo "	<th>NOME</th>";
	echo "	<th>ENDEREÇO</th>";		

	Foreach ($clientes as $registro) 
	{
		echo "	<tr>";
		echo 		"<td align='right'>";
		echo 			"$registro[codigo]<br>";
		echo 		"</td>";

		echo 		"<td>";
		echo 			"$registro[nome]<br>";
		echo 		"</td>";
		
		echo 		"<td>";
		echo 			"$registro[endereco]<br>";
		echo 		"</td>";
		echo "	</tr>";
	}	

	echo "</table>";

	echo "<hr>";

	$cliente->loadId(5, True);
	$cliente->delete();

	echo "CÓDIGO: " . $cliente->getCodigo() . "<br>";
	echo "NOME: " . $cliente->getNome() . "<br>";
	echo "ENDEREÇO: " . $cliente->getEndereco() . "<br>";
?>
