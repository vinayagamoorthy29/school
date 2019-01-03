<?php
include('../dbfunction/mysqlclass.php');
include('../dbfunction/misc_class.php');
//include('../dbfunction/gradequestion.php');
include('../dbfunction/teacher_details.php');

if(isset($_REQUEST['method']) && !empty($_REQUEST['method'])){
	$teacher_fn_BL = new Teacher_process_BL();
	$method=$_REQUEST['method'];
	if(method_exists($teacher_fn_BL, $_REQUEST['method'])){
		echo $teacher_fn_BL->$method();
	}
}

class Teacher_process_BL{
	var $post_obj;
	public function request_data()
	{
		return json_decode($_REQUEST['postdata']);
	}
	public function teacher_create(){
		$post_obj 			= $this->request_data();
		$teacher_obj	= new teacherdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
	    	
	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		!isset($post_obj->title) 			|| $post_obj->title == ""||
		!isset($post_obj->first_name) 			|| $post_obj->first_name == ""||
		!isset($post_obj->last_name) 			|| $post_obj->last_name == ""||
		!isset($post_obj->nic_number) 			|| $post_obj->nic_number == ""||
		!isset($post_obj->dob) 			|| $post_obj->dob== ""||
		!isset($post_obj->gender) 			|| $post_obj->gender == ""||
		!isset($post_obj->district) 			|| $post_obj->district == ""||
		!isset($post_obj->dsd) 			|| $post_obj->dsd == ""||
		!isset($post_obj->gnd) 			|| $post_obj->gnd == ""||
		!isset($post_obj->address) 			|| $post_obj->address == ""||
		!isset($post_obj->contact_no) 			|| $post_obj->contact_no == ""||
		!isset($post_obj->mobile_no) 			|| $post_obj->mobile_no == ""||
		!isset($post_obj->email) 			|| $post_obj->email == ""||
		!isset($post_obj->designation) 			|| $post_obj->designation == ""||
		!isset($post_obj->year_service) 			|| $post_obj->year_service == ""||
		!isset($post_obj->dfappoint) 			|| $post_obj->dfappoint == ""||
		!isset($post_obj->marital_status) 			|| $post_obj->marital_status == ""||
		!isset($post_obj->spouse_info) 			|| $post_obj->spouse_info == ""||
		!isset($post_obj->children_info) 			|| $post_obj->children_info == ""||
		!isset($post_obj->user_id) 			|| $post_obj->user_id == ""

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{

				
				
			 $ins_arr = array(
			 		"title"					=> $commonClass->SQLEscape($post_obj->title,"string"),
					"first_name"					=> $commonClass->SQLEscape($post_obj->first_name,"string"),
					"last_name"					=> $commonClass->SQLEscape($post_obj->last_name,"string"),
					"nic_number"	=> $commonClass->SQLEscape($post_obj->nic_number,"string"),
					"dob"		=> $commonClass->SQLEscape(date('Y-M-d',strtotime($post_obj->dob)),"date"),
					"gender"				=> $commonClass->SQLEscape($post_obj->gender,"string"),
					"district"				=> $commonClass->SQLEscape($post_obj->district,"string"),
					"dsd"				=> $commonClass->SQLEscape($post_obj->dsd,"string"),
					"gnd"				=> $commonClass->SQLEscape($post_obj->gnd,"string"),
					"p_address"	=> $commonClass->SQLEscape($post_obj->address,"string"),
					"contact_no"				=> $commonClass->SQLEscape($post_obj->contact_no,"string"),
					"mobile_no"				=> $commonClass->SQLEscape($post_obj->mobile_no,"string"),
					"email"				=> $commonClass->SQLEscape($post_obj->email,"string"),
					"designation"				=> $commonClass->SQLEscape($post_obj->designation,"string"),
					"year_service"				=> $commonClass->SQLEscape($post_obj->year_service,"string"),
					"dfappoint"				=> $commonClass->SQLEscape(date('Y-M-d',strtotime($post_obj->dfappoint)),"date"),
					"marital_status"				=> $commonClass->SQLEscape($post_obj->marital_status,"string"),
					
					"spouse_info"				=> $commonClass->SQLEscape(json_encode($post_obj->spouse_info),"string"),
					"children_info"				=> $commonClass->SQLEscape(json_encode($post_obj->children_info),"string"),
					
					"created_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_name"			=> $commonClass->SQLEscape($post_obj->user_id,"string"),
					"status"				=> $commonClass->SQLEscape('1',"string")
					);


			 		
					$ins_res = $teacher_obj->insert_row($ins_arr);
					
            	
				
				if(!empty($ins_res)){
					
					$result->status 	= "7400";
					$result->message 	= 'teacher details inserted successfully....';
					return json_encode($result);

				}else{
					$result->status 	= "7404";
					$result->message 	= 'teacher inserted failed....';
					return json_encode($result);
				}

			

		}

		
	}
	public function teacher_update(){
		$post_obj 			= $this->request_data();
		$teacher_obj	= new teacherdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
	    	
	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		!isset($post_obj->teacher_id) 			|| $post_obj->teacher_id == ""||
		!isset($post_obj->title) 			|| $post_obj->title == ""||
		!isset($post_obj->first_name) 			|| $post_obj->first_name == ""||
		!isset($post_obj->last_name) 			|| $post_obj->last_name == ""||
		!isset($post_obj->nic_number) 			|| $post_obj->nic_number == ""||
		!isset($post_obj->dob) 			|| $post_obj->dob== ""||
		!isset($post_obj->gender) 			|| $post_obj->gender == ""||
		!isset($post_obj->district) 			|| $post_obj->district == ""||
		!isset($post_obj->dsd) 			|| $post_obj->dsd == ""||
		!isset($post_obj->gnd) 			|| $post_obj->gnd == ""||
		!isset($post_obj->address) 			|| $post_obj->address == ""||
		!isset($post_obj->contact_no) 			|| $post_obj->contact_no == ""||
		!isset($post_obj->mobile_no) 			|| $post_obj->mobile_no == ""||
		!isset($post_obj->email) 			|| $post_obj->email == ""||
		!isset($post_obj->designation) 			|| $post_obj->designation == ""||
		!isset($post_obj->year_service) 			|| $post_obj->year_service == ""||
		!isset($post_obj->dfappoint) 			|| $post_obj->dfappoint == ""||
		!isset($post_obj->marital_status) 			|| $post_obj->marital_status == ""||
		!isset($post_obj->spouse_info) 			|| $post_obj->spouse_info == ""||
		!isset($post_obj->children_info) 			|| $post_obj->children_info == ""||
		!isset($post_obj->user_id) 			|| $post_obj->user_id == ""

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{

				
				
			 $ins_arr = array(
			 		"title"					=> $commonClass->SQLEscape($post_obj->title,"string"),
					"first_name"					=> $commonClass->SQLEscape($post_obj->first_name,"string"),
					"last_name"					=> $commonClass->SQLEscape($post_obj->last_name,"string"),
					"nic_number"	=> $commonClass->SQLEscape($post_obj->nic_number,"string"),
					"dob"		=> $commonClass->SQLEscape(date('Y-M-d',strtotime($post_obj->dob)),"date"),
					"gender"				=> $commonClass->SQLEscape($post_obj->gender,"string"),
					"district"				=> $commonClass->SQLEscape($post_obj->district,"string"),
					"dsd"				=> $commonClass->SQLEscape($post_obj->dsd,"string"),
					"gnd"				=> $commonClass->SQLEscape($post_obj->gnd,"string"),
					"p_address"	=> $commonClass->SQLEscape($post_obj->address,"string"),
					"contact_no"				=> $commonClass->SQLEscape($post_obj->contact_no,"string"),
					"mobile_no"				=> $commonClass->SQLEscape($post_obj->mobile_no,"string"),
					"email"				=> $commonClass->SQLEscape($post_obj->email,"string"),
					"designation"				=> $commonClass->SQLEscape($post_obj->designation,"string"),
					"year_service"				=> $commonClass->SQLEscape($post_obj->year_service,"string"),
					"dfappoint"				=> $commonClass->SQLEscape(date('Y-M-d',strtotime($post_obj->dfappoint)),"date"),
					"marital_status"				=> $commonClass->SQLEscape($post_obj->marital_status,"string"),
					
					"spouse_info"				=> $commonClass->SQLEscape(json_encode($post_obj->spouse_info),"string"),
					"children_info"				=> $commonClass->SQLEscape(json_encode($post_obj->children_info),"string"),
					
					
					"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_name"			=> $commonClass->SQLEscape($post_obj->user_id,"string"),
					
					);


			 		
					$whr_arr=array(
				"id"					=> $commonClass->SQLEscape($post_obj->teacher_id,"string"),
				);
			 		
					$ins_res = $teacher_obj->update_rows($ins_arr,$whr_arr);
					
            	
				
				if(!empty($ins_res)){
					
					$result->status 	= "7400";
					$result->message 	= 'teacher details updated successfully....';
					return json_encode($result);

				}else{
					$result->status 	= "7404";
					$result->message 	= 'teacher details updated failed....';
					return json_encode($result);
				}

			

		}

		
	}
	
	
	public function teacher_delete(){
		$post_obj 			= $this->request_data();
		$teacher_obj	= new teacherdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
	    	
	    	
	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		
		!isset($post_obj->teacher_id) 			|| $post_obj->teacher_id== ""||
		!isset($post_obj->user_id) 			|| $post_obj->user_id == ""

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{
				
		     $whr_arr = array(
			 		"id"					=> $commonClass->SQLEscape($post_obj->teacher_id,"string"));
			 $ins_arr = array(
			 		"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_name"			=> $commonClass->SQLEscape($post_obj->user_id,"string"),
					"status"				=> $commonClass->SQLEscape('0',"string")
					);
			 		//$grade=$post_obj->grade;
					$ins_res = $teacher_obj->update_rows($ins_arr,$whr_arr);
					
            	
				
				if(!empty($ins_res)){
					
					$result->status 	= "7400";
					$result->message 	= 'teacher details deleted successfully....';
					return json_encode($result);

				}else{
					$result->status 	= "7404";
					$result->message 	= 'teacher details  failed....';
					return json_encode($result);
				}

			

		}

		
	}
	
	
	
	public function get_teacher_list()
	{
		$post_obj 			= $this->request_data();
		$teacher_obj	= new teacherdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
		if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		!isset($post_obj->user_id) 			|| $post_obj->user_id == "" 
		

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{
				$whr_arr = array(
			 		"status"					=> $commonClass->SQLEscape('1',"string"));
				$teacher_info=$teacher_obj->select_rows($whr_arr);
	   
	    
		if(!empty($teacher_info)){
			foreach($teacher_info as $st)
			{
			
						$teacher_arr[]=array(
						"teacher_id" =>$st->id,
						"title"					=>$st->title ,
						"first_name"					=>$st->first_name ,
						"last_name"					=>$st->last_name ,
						"nic_number"					=>$st->nic_number ,
						"dob"					=>date('Y-m-d',strtotime($st->dob)) ,
						"gender"				=> $st->gender,
						"district"					=> $st->district,
						"dsd"	=> $st->dsd,
						"gnd"	=> $st->gnd,
						"address"	=> $st->p_address,					
						"contact_no"				=> $st->contact_no,
						"mobile_no"				=> $st->mobile_no,
						"email"	=> $st->email,	
						"designation"	=> $st->designation,					
						"year_service"				=> $st->year_service,
						"dfappoint"				=> date('Y-m-d',strtotime($st->dfappoint)),
						"marital_status"				=> $st->marital_status,
						"spouse_info"				=> json_decode($st->spouse_info),
						"children_info"				=> json_decode($st->children_info));
						
			}
					     $result->status 	= "7400";
						$result->message 	= 'question List....';
						$result->value=$teacher_arr;
						return json_encode($result);
					}else{
					$result->status 	= "7403";
					$result->message 	= 'question details not found....';
					return json_encode($result);
				}
			}
	}
	public function get_single_teacher_list()
	{
		$post_obj 			= $this->request_data();
		$teacher_obj	= new teacherdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
		if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		!isset($post_obj->user_id) 			|| $post_obj->user_id == "" ||
!isset($post_obj->teacher_id) 			|| $post_obj->teacher_id == ""		
		

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{
				$whr_arr = array(
				"id"					=> $commonClass->SQLEscape($post_obj->teacher_id,"string"),
			 		"status"					=> $commonClass->SQLEscape('1',"string"));
				$teacher_info=$teacher_obj->select_rows($whr_arr);
	   
	    
		if(!empty($teacher_info)){
			foreach($teacher_info as $st)
			{
			
						$teacher_arr[]=array(
						"teacher_id" =>$st->id,
						"title"					=>$st->title ,
						"first_name"					=>$st->first_name ,
						"last_name"					=>$st->last_name ,
						"nic_number"					=>$st->nic_number ,
						"dob"					=>date('Y-m-d',strtotime($st->dob)) ,
						"gender"				=> $st->gender,
						"district"					=> $st->district,
						"dsd"	=> $st->dsd,
						"gnd"	=> $st->gnd,
						"address"	=> $st->p_address,					
						"contact_no"				=> $st->contact_no,
						"mobile_no"				=> $st->mobile_no,
						"email"	=> $st->email,	
						"designation"	=> $st->designation,					
						"year_service"				=> $st->year_service,
						"dfappoint"				=> date('Y-m-d',strtotime($st->dfappoint)),
						"marital_status"				=> $st->marital_status,
						"spouse_info"				=> json_decode($st->spouse_info),
						"children_info"				=> json_decode($st->children_info));
						
			}
					     $result->status 	= "7400";
						$result->message 	= 'question List....';
						$result->value=$teacher_arr;
						return json_encode($result);
					}else{
					$result->status 	= "7403";
					$result->message 	= 'question details not found....';
					return json_encode($result);
				}
			}
	}

	
	
}



?>