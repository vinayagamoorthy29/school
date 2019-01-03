<?php
include('../dbfunction/mysqlclass.php');
include('../dbfunction/misc_class.php');
include('../dbfunction/register.php');
if(isset($_REQUEST['method']) && !empty($_REQUEST['method'])){
	$initial_process_fn_BL = new Initial_process_BL();
	$method=$_REQUEST['method'];
	if(method_exists($initial_process_fn_BL, $_REQUEST['method'])){
		echo $initial_process_fn_BL->$method();
	}
}

class Initial_process_BL{
	var $post_obj;
	public function request_data()
	{
		return json_decode($_REQUEST['postdata']);
	}

	public function Admin_register(){
		$post_obj 			= $this->request_data();
		$staff_master_obj	= new Adminlogin_functions();
	    $commonClass 		= new CommonClass();
	    $result 			= new result();

	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
				return json_encode($result);

	        
		}else if(!isset($post_obj->email) 			|| $post_obj->email == "" 					||
				!isset($post_obj->password) 		|| $post_obj->password == "" 				
				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
		}else{
			
				$passcode_det=$commonClass->generateRandomString($post_obj->password);
      			

				$ins_arr = array(
					"email"					=> $commonClass->SQLEscape($post_obj->email,"string"),
					"password"				=> $commonClass->SQLEscape($passcode_det['password'],"string"),
					"salt_key"				=> $commonClass->SQLEscape($passcode_det['hash_key'],"string"),
					"created_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_name"			=> $commonClass->SQLEscape($post_obj->email,"string"),
					"status"				=> $commonClass->SQLEscape('1',"string")
				);
				
				$ins_res = $staff_master_obj->insert_row($ins_arr);
				if(!empty($ins_res)){
					
					$result->status 	= "7400";
					$result->message 	= 'Creating staff progress success';
					return json_encode($result);

				}else{
					$result->status 	= "7401";
					$result->message 	= 'Creating staff progress failed';
					return json_encode($result);
				}

			}

		}

		
	

	
	public function Admin_login(){
		$post_obj 		= $this->request_data();
		$staff_master_obj	= new Adminlogin_functions();
		$commonClass 	= new CommonClass();
	    $result 		= new result();

	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
				return json_encode($result);
			}else if(!isset($post_obj->email) 			|| $post_obj->email == "" 		||
				!isset($post_obj->password) 		|| $post_obj->password == "" 			
				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{
				$whr_arr = array(
					"email"		=> $commonClass->SQLEscape($post_obj->email,"string")
				);
				$user_det = $staff_master_obj->select_rows($whr_arr);
				if(!empty($user_det)){

					$decoded_password = $commonClass->password_hash_fn($user_det[0]->salt_key,$post_obj->password); 
					$condition_array=array(
						"email"		=> $commonClass->SQLEscape($post_obj->email,"string"),
						"password"	=> $commonClass->SQLEscape($decoded_password,"string")
					);

					$login_det = $staff_master_obj->select_rows($condition_array);
							
						if(!empty($login_det))
						{
							$details = array(
							"id"				=> $login_det[0]->id,
							"name"				=> $login_det[0]->email
							);
							$result->status 			= "7400";
							$result->message 			= 'success';
							$result->response 			= $details;
							return json_encode($result);
						}	
						else{
						$result->status 	= "7404";
						$result->message 	= 'Passsword dosn\'t match!!!';
						return json_encode($result);
						}
						}

					
						else{
							$result->status 	= "7404";
							$result->message 	= 'Email id not registered!!!';
							return json_encode($result);
					}

			}

		}

	

	/*public function forgot_password(){
		$post_obj 		= $this->request_data();
		$staff_master_obj= new Staff_master_functions();
		$notifi_obj= new get_notification_template();
		$commonClass 	= new CommonClass();
	    $result 		= new result();

	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			}else if(!isset($post_obj->email) 			|| $post_obj->email == "" 
							
				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			}else{
			$whr_arr = array(
				"email"		=> $commonClass->SQLEscape($post_obj->email,"string")
			);
			$user_det = $staff_master_obj->select_rows($whr_arr);
			if(!empty($user_det)){
				$id=$user_det[0]->id;
				
					$pd=$commonClass->generate_newpassword();
					
					$shuffledpassword=$pd["shuffledpassword"];

						$update_arr = array(
						"password"				=> $commonClass->SQLEscape($pd["password"],"string"),
						"salt_key"				=> $commonClass->SQLEscape($pd["hash_key"],"string"),
						"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime")
					);

					$where_arr = array(
						"id" => $commonClass->SQLEscape($id,"string")
					);

					$update_res = $staff_master_obj->update_rows($update_arr,$where_arr);
					if($update_res >0)
					{
						$mailresponse = $notifi_obj->send_forgot_password($user_det[0]->name,$post_obj->email,$shuffledpassword);
						
						if($mailresponse !== 0){
							$result->status 	= "7400";
							$result->message 	= 'password sent to your email successfully';	
						} else {
							$result->status 	= "7409";
							$result->message 	= ' password sent to your email unsuccess';
						}
					} else {
						$result->status 	= "7407";
						$result->message 	= 'password updated not successfull';

					}

					
						
					}else{
						$result->status 	= "7404";
						$result->message 	= 'Email not found...!!!';
						return json_encode($result);
					}

			}
				return json_encode($result);
			

		}

	
	public function change_password(){
		$post_obj 		= $this->request_data();
		$staff_master_obj= new Staff_master_functions();
		$commonClass 	= new CommonClass();
	    $result 		= new result();

	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
				return json_encode($result);

	        
		}else if(!isset($post_obj->user_id) 	|| $post_obj->user_id == "" 		||
				!isset($post_obj->old_password) || $post_obj->old_password == ""	||
				!isset($post_obj->new_password) || $post_obj->new_password == ""  				
				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
				return json_encode($result);

			
		}else{

			$whr_arr = array(
				"id" => $commonClass->SQLEscape($post_obj->user_id,"string")
			);
			$user_det = $staff_master_obj->select_rows($whr_arr);

			if(!empty($user_det)){

				$decoded_password = $commonClass->password_hash_fn($user_det[0]->salt_key,$post_obj->old_password); 
				$condition_array=array(
					"id"		=> $commonClass->SQLEscape($post_obj->user_id,"string"),
					"email"		=> $commonClass->SQLEscape($user_det[0]->email,"string"),
					"password"	=> $commonClass->SQLEscape($decoded_password,"string")
				);

				$login_det = $staff_master_obj->select_rows($condition_array);

				if (!empty($login_det)) {
					$passcode_det = $commonClass->generateRandomString($post_obj->new_password);
					$update_arr = array(
						"password"				=> $commonClass->SQLEscape($passcode_det['password'],"string"),
						"salt_key"				=> $commonClass->SQLEscape($passcode_det['hash_key'],"string"),
						"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime")
					);

					$where_arr = array(
						"id" => $commonClass->SQLEscape($post_obj->user_id,"string")
					);

					$update_res = $staff_master_obj->update_rows($update_arr,$where_arr);

					$result->status 	= "7400";
					$result->message 	= 'Your new password updated successfully';
					return json_encode($result);
				} else {
					$result->status 	= "7401";
					$result->message 	= 'Your old password is incorrect';
					return json_encode($result);
				}
			} else {
				$result->status 	= "7402";
				$result->message 	= 'User details is incorrect';
				return json_encode($result);
			}
		}
	}
		public function profile_pic_update()
		{

				$post_obj 		= $this->request_data();
				$staff_master_obj= new Staff_master_functions();
				$commonClass 	= new CommonClass();
			    $result 		= new result();
			    if(empty($post_obj)){
					$result->status 	= "7401";
			        $result->message 	= 'Empty Post';
						return json_encode($result);

			        
				}else if(!isset($post_obj->user_image) 	|| $post_obj->user_image == "" ||
						!isset($post_obj->user_id) 		|| $post_obj->user_id == ""  				
						){
					$result->status 	= "7402";
					$result->message 	= 'Invalid Post';
					return json_encode($result);
						}else{

							$user_detail=$staff_master_obj->single_staff_details($post_obj->user_id);

							if(!empty($user_detail))
							{
								$i="";

								if($user_detail[0]->image!="")
								{
									$unstatus=$commonClass->unlink_image($user_detail[0]->image);
									if($unstatus=="1")
									{
										$i=1;
									}

								}
								else
								{
									$i=1;
									
								}
								
								if($i=="1")
								{
								$update_arr = array(
								"image"	=> $commonClass->SQLEscape($post_obj->user_image,"string")
								);

								$where_arr = array(
									"id" => $commonClass->SQLEscape($post_obj->user_id,"string")
								);

								$update_res = $staff_master_obj->update_rows($update_arr,$where_arr);
								if($update_res > 0)
								{
									$result->status 	= "7400";
									$result->message 	= 'Your Image updated successfully';
								}
								else
								{
									$result->status 	= "7405";
									$result->message 	= 'Your Image updated failed';
								}
								}
								else
								{
									$result->status 	= "7409";
									$result->message 	= "your have not update your image";

								}
								}
								else
								{
									$result->status 	= "7403";
									$result->message 	= 'No user information found....';
								}
					}
					
					return json_encode($result);
				
		}
		public function sample_excel_files()
		{
			$commonClass 	= new CommonClass();
	    	$result 		= new result();	

	    	$excellist=$commonClass->excelPath();

	    	if(!empty($excellist))
	    	{
	    		$result->status 	= "7400";
				$result->message 	= "success";
				$result->response 	= $excellist;

	    	}
	    	else
	    	{
	    		$result->status 	= "7402";
			    $result->message 	= "No sample list found...";

	    	}

	    	return json_encode($result);

		}
	public function contact_no_update(){
		$post_obj 		= $this->request_data();
		$staff_master_obj= new Staff_master_functions();
		$commonClass 	= new CommonClass();
	    $result 		= new result();

	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
				return json_encode($result);

	        
		}else if(!isset($post_obj->user_id) 	|| $post_obj->user_id == "" 		||
				!isset($post_obj->phone) 		|| $post_obj->phone == ""  				
				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
				return json_encode($result);

			
		}else{

			$update_arr = array(
				"phone"	=> $commonClass->SQLEscape($post_obj->phone,"string")
			);

			$where_arr = array(
				"id" => $commonClass->SQLEscape($post_obj->user_id,"string")
			);

			$update_res = $staff_master_obj->update_rows($update_arr,$where_arr);

			$result->status 	= "7400";
			$result->message 	= 'Your Contact number updated successfully';
			return json_encode($result);
		}
	}

*/
}


?>