<?php
	require('../server_pages/database.php');

	$form_data = file_get_contents("php://input");

	//echo json_encode($form_data);
		
	$data = json_decode($form_data);

	$what_to_do = $data->what_to_do;

	if ($what_to_do == 'authenticate_user'){
		// authenticate_ the user againsta the database
			$db_handler = new Database();
			$result = $db_handler->authenticate($data->email, $data->password, $data->remember_me);
			echo json_encode($result);
	} else if($what_to_do == 'check_if_logged_in'){
		$db_handler = new Database();
		$result = $db_handler->get_session_data();
		echo json_encode($result);
	}else if ($what_to_do == 'log_me_out') {
		$db_handler = new Database();
		$db_handler->logout();
		
	}
	else if($what_to_do == 'isAuthenticated'){
		$db_handler = new Database();
		echo $db_handler->is_cookie_set();

	}

?>