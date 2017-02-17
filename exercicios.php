<?php 

	$arrayTeste = array(1,2,3,4,5,6,7,8,9);

	echo "A somatório do array é : " . somarArray($arrayTeste);

	function somarArray($array){
		$somatoria = 0;

		for ($i=0; $i < sizeof($array); $i++) { 
			$somatoria += $array[$i];
		}

		return $somatoria;
	}