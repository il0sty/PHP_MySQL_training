<?php
	
	function verAcName($n,&$messages){ //function - check name usability
	
		if (strlen($n)<3): //lenght verification (min)
			$messages[] = "The name must have, at least, 3 characeters <br>";			
		elseif (strlen($n)>=20): //lenght verification (max)
			$messages[] = "The name must have 20 caracteres maximum <br>";	
		else:
			return $n; //set name
		endif;
	}

	function verAcUser($u,$dbConnect,&$messages){ //function - check user usability

		$avUser=true;

		$sql = "SELECT user FROM contas WHERE user = '$u'";
		$user_av = mysqli_query($dbConnect,$sql); 
		
		if (mysqli_num_rows($user_av)>0):
			$messages[] = "This user is not available <br>";
			$avUser = false;	
		endif;

		if (strlen($u)<6): //lenght verification (min)
			$messages[] = "The user must have, at least, 6 caracteres <br>";
			$avUser = false;
		elseif (strlen($u)>=20): //lenght verification (max)
			$messages[] = "The user must have 20 caracteres maximum <br>";
			$avUser = false;
		endif;
		if($avUser==true):
			return $u; //set user

		endif;

	}

	

	function verAcPass($p,$cp,&$messages){ //function - check password usability
		
		$avPass = true; //check password usability

		if (strlen($p)<8): //lenght verification (min)
			$messages[] = "The password must have, at least, 8 caracteres <br>";
			$avPass = false;
		elseif(strlen($p)>20): //lenght verification (max)
			$messages[] = "The password must have 20 caracteres maximum <br>";
			$avPass = false;
		endif;
		if ($p==filter_var($p,FILTER_SANITIZE_NUMBER_INT)): //char/special char verification
			$messages[] = "The password must have, at least, one characeter/special characeter <br>";
			$avPass = false;
		endif;
		if ($p!==$cp): // password equal confirm password verification
			$messages[] = "The password and confirm password must be the same <br>";
			$avPass = false;
		endif;
		if ($avPass == true):
			return $p; //set password
		endif;
	}


?>