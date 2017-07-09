<?php 

	function factorial($num){
		$res = 1;
		for ($i=1;$i<=$num;$i++) 
			$res=$res*$i;
		return $res;
	}

	function binomial_coeff($n,$k){
		return factorial($n)/(factorial($k)*factorial($n-$k));
	}

?>