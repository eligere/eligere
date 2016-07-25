<?php

/**********************************************************************************************************
 *  <ELIGERE: a Fuzzy AHP Distributed Software Platform for Group Decision Making in Engineering Design>  *
 *   Copyright (C) 2016  by Mateusz Gospodarczyk and Stanislao Grazioso                                   *
 *  																									  *
 *   ELIGERE is free software: you can redistribute it and/or modify									  *
 *   it under the terms of the GNU General Public License as 											  *
 *   published by the Free Software Foundation, either version 3 of the 								  *
 *   License, or (at your option) any later version.													  *
 *																										  *
 *   This program is distributed in the hope that it will be useful,									  *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of										  *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the										  *
 *   GNU General Public License for more details.														  *
 *																										  *
 *   You should have received a copy of the GNU General Public License									  *
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.								  *
 * 																										  *
 *   Contacts: mateusz.gospodarczyk@uniroma2.it and stanislao.grazioso@unina.it 						  *
 *********************************************************************************************************/
 
 
	 function sec_session_start() {
			$session_name = 'sec_session_id'; // Imposta un nome di sessione
			$secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
			$httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
			ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
			$cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
			session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
			session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
			session_start(); // Avvia la sessione php.
			session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
	}

 
 
	function login($email, $password, $mysqli) {
	   // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
	   if ($stmt = $mysqli->prepare("SELECT id, username, password, salt FROM user WHERE email = ? LIMIT 1")) { 
		  $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
		  $stmt->execute(); // esegue la query appena creata.
		  $stmt->store_result();
		  $stmt->bind_result($user_id, $username, $db_password, $salt); // recupera il risultato della query e lo memorizza nelle relative variabili.
		  $stmt->fetch();
		  $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.
		  if($stmt->num_rows == 1) { // se l'utente esiste
			 // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
			 if(checkbrute($user_id, $mysqli) == true) { 
				// Account disabilitato
				// Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.
				return false;
			 } else {
			 if($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
				// Password corretta!            
				   $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
	 
				   $user_id = preg_replace("/[^0-9]+/", "", $user_id); // ci proteggiamo da un attacco XSS
				   $_SESSION['user_id'] = $user_id; 
				   $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // ci proteggiamo da un attacco XSS
				   $_SESSION['username'] = $username;
				   $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
				   // Login eseguito con successo.
				   return true;    
			 } else {
				// Password incorretta.
				// Registriamo il tentativo fallito nel database.
				$now = time();
				$mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
				return false;
			 }
		  }
		  } else {
			 // L'utente inserito non esiste.
			 return false;
		  }
	   }
	}
	
	function checkbrute($user_id, $mysqli) {
	   // Recupero il timestamp
	   $now = time();
	   // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
	   $valid_attempts = $now - (2 * 60 * 60); 
	   if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) { 
		  $stmt->bind_param('i', $user_id); 
		  // Eseguo la query creata.
		  $stmt->execute();
		  $stmt->store_result();
		  // Verifico l'esistenza di più di 5 tentativi di login falliti.
		  if($stmt->num_rows > 5) {
			 return true;
		  } else {
			 return false;
		  }
	   }
	}
	
	function login_check($mysqli) {
   // Verifica che tutte le variabili di sessione siano impostate correttamente
   if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
     $user_id = $_SESSION['user_id'];
     $login_string = $_SESSION['login_string'];
     $username = $_SESSION['username'];     
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
     if ($stmt = $mysqli->prepare("SELECT password FROM user WHERE id = ? LIMIT 1")) { 
        $stmt->bind_param('i', $user_id); // esegue il bind del parametro '$user_id'.
        $stmt->execute(); // Esegue la query creata.
        $stmt->store_result();
 
        if($stmt->num_rows == 1) { // se l'utente esiste
           $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
           $stmt->fetch();
           $login_check = hash('sha512', $password.$user_browser);
           if($login_check == $login_string) {
              // Login eseguito!!!!
              return true;
           } else {
              //  Login non eseguito
              return false;
           }
        } else {
            // Login non eseguito
            return false;
        }
     } else {
        // Login non eseguito
        return false;
     }
   } else {
     // Login non eseguito
     return false;
   }
}
	
	
	
?>