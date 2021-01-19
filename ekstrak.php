<?php
    //open connection to mysql db
	function kbbi($kata){
		$a = file_get_contents('kamus.json');
		$b = json_decode($a, true);
		$c = @$b[$kata];
		return $c;
	}
	
	echo kbbi('kabel');