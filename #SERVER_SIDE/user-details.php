<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if( isset($_GET["e"]) && isset($_GET["p"]) ){	
		if( !empty($_GET["e"])  && !empty($_GET["p"])  ){	
		
$conn = new mysqli("localhost", "238488", "pedro.2018", "238488");					
			$username=$_GET["e"];		$password=$_GET["p"];				
			
			// To protect MySQL injection for Security purpose		
			$username = stripslashes($username);		
			$password = stripslashes($password);		
			$username = $conn->real_escape_string($username);		
			$password = $conn->real_escape_string($password);		
			$password = md5($password);		
			
			$query="SELECT u_name, u_id, u_phone, u_address, u_pincode FROM users 
					where u_verified=1 and u_id like '".$username."' and u_password like '".$password."'";	
					
			$result = $conn->query($query);		$outp = "";				
		
			if( $rs=$result->fetch_array(MYSQLI_ASSOC)) {			
				
				if ($outp != "") {$outp .= ",";}
				
				$outp .= '{"u_name":"'  . $rs["u_name"] . '",';			
				$outp .= '"u_id":"'   . $rs["u_id"]        . '",';			
				$outp .= '"u_phone":"'   . $rs["u_phone"]        . '",';			
				$outp .= '"u_address":"'   . $rs["u_address"]        . '",';			
				$outp .= '"u_pincode":"'. $rs["u_pincode"]     . '"}';		
			}	
			
			$outp ='{"records":'.$outp.'}';		
			$conn->close();		
			echo($outp);	
		}
	}
	
?> 