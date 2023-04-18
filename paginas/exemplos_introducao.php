<html>
  <head>
    <title>PHP Test</title>
  </head>
  <body>

<h3>Calculadora</h3>
<form action="pagina/exemplo_introducao.php" method="get">
	<label>Num 01</label><br>
	<input type="text" name="num1" /><br>
	<label>Num 02</label><br>
	<input type="text" name="num2" /><br>
	<input type="submit" value="Enviar"/>
</form>
<?php
	if($_GET){
				$num1 = $_GET['num1'];
				$num2 = $_GET['num2'];
				echo "A Soma é: ". $num1 + $num2;
			}
?>
<h3>Pessoa Idade</h3>
<form action="index.php" method="post">
	<label>Nome</label><br>
	<input type="text" name="nome" /><br>
	<label>Ano Nascimento</label><br>
	<input type="text" name="ano_nascimento" /><br>
	<input type="submit" value="Enviar"/>
</form>
	<?php 
			if($_POST){ //vetor que pega os dados do formulario

				$nome = $_POST['nome']; // acessa o valor atraves do indice do vetor 
  			$idade = $_POST['ano_nascimento'];

				echo "<p>Olá mundo! $nome sua idade é: $idade</p>";  
			}

		$vetor = ['Uno','Camaro','Fusca','Fiesta'];
		for($i =0; $i< count($vetor);$i++){
			echo $vetor[$i].'<br>';
		}
		echo '<br>';
		foreach($vetor as $item){
			echo $item.'<br>';
		}
		echo '<br>';
		$cont = 0;
		while($cont < count($vetor)){
			echo $vetor[$cont].'<br>';
			$cont++;
		}
		
		
		$notas = ["João" => 10,"Maria"=> 8,
			"Chica"=>5,"Chaves"=>3,"Kiko"=>7];

		foreach($notas as $key => $valor){
			if($valor >= 6){
				echo "<p>Aprovado ".$key." Nota: ". $valor.'</p>';
			}
		}
	
/*

$estado[] = "PR";
$estado[] = "SC";
$estado[] = "RS";
echo $estado[1]."<br>"; 
$lista = [ ['Lara', 'Marcos', 'Miguel'], 
           [16, 15, 16]
         ];
echo $lista[0][1];

				*/
				?>
		
  </body>
</html>
