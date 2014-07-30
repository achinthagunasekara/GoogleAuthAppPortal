<?php

/* 
 * Archie Gunasekara
 * 2014
 */

class Authenticator {

		function  __construct() {
		
			global $config;
			$this->config = $config;
		}

        public function user_login($user_name, $pass) {
	
			$radius = radius_auth_open(); 
			
			if (! radius_add_server($radius, $this->config["RADIUS"]["server"], 0, $this->config["RADIUS"]["secret"], 5, 3)) { 

				print "Radius Error: " . radius_strerror($radius);
				return false;
			} 

			if (! radius_create_request($radius,RADIUS_ACCESS_REQUEST)) { 

				print "Radius Error: " . radius_strerror($radius);
				return false;
			} 

			radius_put_attr($radius,RADIUS_USER_NAME, $user_name); 
			radius_put_attr($radius,RADIUS_USER_PASSWORD, $pass); 

			switch (radius_send_request($radius)) 
			{ 
				case RADIUS_ACCESS_ACCEPT: 
					return true; 
					break; 
					
				case RADIUS_ACCESS_REJECT: 
					return false;
					break; 
					
				case RADIUS_ACCESS_CHALLENGE: 
					return false;
					break; 
					
				default: 
					print "Radius Error: " . radius_strerror($radius); 
					return false;
			} 
        }
		
		public function destroy_session_data() {
		
			//Unset all of the session variables.
			$_SESSION = array();

			//If it's desired to kill the session, also delete the session cookie.
			//Note: This will destroy the session, and not just the session data!
			if (ini_get("session.use_cookies")) {
			
				$params = session_get_cookie_params();
				setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
			}
			
			session_destroy();
		}
}

?>
