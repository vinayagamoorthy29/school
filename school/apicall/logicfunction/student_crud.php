<?php
include('../dbfunction/mysqlclass.php');
include('../dbfunction/misc_class.php');
//include('../dbfunction/gradequestion.php');
include('../dbfunction/student_details.php');

if(isset($_REQUEST['method']) && !empty($_REQUEST['method'])){
	$student_fn_BL = new Student_process_BL();
	$method=$_REQUEST['method'];
	if(method_exists($student_fn_BL, $_REQUEST['method'])){
		echo $student_fn_BL->$method();
	}
}

class Student_process_BL{
	var $post_obj;
	public function request_data()
	{
		return json_decode($_REQUEST['postdata']);
	}
	public function student_create(){
		$post_obj 			= $this->request_data();
		$student_obj	= new studentdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
	    	
	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		!isset($post_obj->name) 			|| $post_obj->name == ""||
		!isset($post_obj->grade) 			|| $post_obj->grade == ""||
		!isset($post_obj->admission_no) 			|| $post_obj->admission_no == ""||
		!isset($post_obj->address) 			|| $post_obj->address == ""||
		!isset($post_obj->dob) 			|| $post_obj->dob== ""||
		!isset($post_obj->gender) 			|| $post_obj->gender == ""||
		!isset($post_obj->contact_no) 			|| $post_obj->contact_no == ""||
		!isset($post_obj->parent_info) 			|| $post_obj->parent_info == ""||
		!isset($post_obj->parent_pass_away) 			|| $post_obj->parent_pass_away == ""||
		!isset($post_obj->parent_disease) 			|| $post_obj->parent_disease == ""||
		!isset($post_obj->user_id) 			|| $post_obj->user_id == ""

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{

				
				
			 $ins_arr = array(
			 		"name"					=> $commonClass->SQLEscape($post_obj->name,"string"),
					"grade"					=> $commonClass->SQLEscape($post_obj->grade,"string"),
					"adm_no"	=> $commonClass->SQLEscape($post_obj->admission_no,"string"),
					"address"	=> $commonClass->SQLEscape($post_obj->address,"string"),
					"dob"		=> $commonClass->SQLEscape($post_obj->dob,"date"),
					"gender"				=> $commonClass->SQLEscape($post_obj->gender,"string"),
					"contact_no"				=> $commonClass->SQLEscape($post_obj->contact_no,"string"),
					"parent_info"				=> $commonClass->SQLEscape(json_encode($post_obj->parent_info),"string"),
					"parent_pass_away"				=> $commonClass->SQLEscape(json_encode($post_obj->parent_pass_away),"string"),
					"parent_disease"				=> $commonClass->SQLEscape(json_encode($post_obj->parent_disease),"string"),
					"created_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_name"			=> $commonClass->SQLEscape($post_obj->user_id,"string"),
					"status"				=> $commonClass->SQLEscape('1',"string")
					);


			 		
					$ins_res = $student_obj->insert_row($ins_arr);
					
            	
				
				if(!empty($ins_res)){
					
					$result->status 	= "7400";
					$result->message 	= 'student details inserted successfully....';
					return json_encode($result);

				}else{
					$result->status 	= "7404";
					$result->message 	= 'question inserted failed....';
					return json_encode($result);
				}

			

		}

		
	}
	
	public function student_update(){
		$post_obj 			= $this->request_data();
		$student_obj	= new studentdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
	    	
	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		!isset($post_obj->name) 			|| $post_obj->name == ""||
		!isset($post_obj->grade) 			|| $post_obj->grade == ""||
		!isset($post_obj->admission_no) 			|| $post_obj->admission_no == ""||
		!isset($post_obj->address) 			|| $post_obj->address == ""||
		!isset($post_obj->dob) 			|| $post_obj->dob== ""||
		!isset($post_obj->gender) 			|| $post_obj->gender == ""||
		!isset($post_obj->contact_no) 			|| $post_obj->contact_no == ""||
		!isset($post_obj->parent_info) 			|| $post_obj->parent_info == ""||
		!isset($post_obj->parent_pass_away) 			|| $post_obj->parent_pass_away == ""||
		!isset($post_obj->parent_disease) 			|| $post_obj->parent_disease == ""||
		!isset($post_obj->user_id) 			|| $post_obj->user_id == "" ||
		!isset($post_obj->student_id) 			|| $post_obj->student_id == ""

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{

				
				
			 $ins_arr = array(
			 		"name"					=> $commonClass->SQLEscape($post_obj->name,"string"),
					"grade"					=> $commonClass->SQLEscape($post_obj->grade,"string"),
					"adm_no"	=> $commonClass->SQLEscape($post_obj->admission_no,"string"),
					"address"	=> $commonClass->SQLEscape($post_obj->address,"string"),
					"dob"		=> $commonClass->SQLEscape($post_obj->dob,"date"),
					"gender"				=> $commonClass->SQLEscape($post_obj->gender,"string"),
					"contact_no"				=> $commonClass->SQLEscape($post_obj->contact_no,"string"),
					"parent_info"				=> $commonClass->SQLEscape(json_encode($post_obj->parent_info),"string"),
					"parent_pass_away"				=> $commonClass->SQLEscape(json_encode($post_obj->parent_pass_away),"string"),
					"parent_disease"				=> $commonClass->SQLEscape(json_encode($post_obj->parent_disease),"string"),
					"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_name"			=> $commonClass->SQLEscape($post_obj->user_id,"string")
					
					);

				$whr_arr=array(
				"id"					=> $commonClass->SQLEscape($post_obj->student_id,"string"),
				);
			 		
					$ins_res = $student_obj->update_rows($ins_arr,$whr_arr);
					
            	
				
				if(!empty($ins_res)){
					
					$result->status 	= "7400";
					$result->message 	= 'student details updated successfully....';
					return json_encode($result);

				}else{
					$result->status 	= "7404";
					$result->message 	= 'student details updated failed....';
					return json_encode($result);
				}

			

		}

		
	}
	public function student_delete(){
		$post_obj 			= $this->request_data();
		$student_obj	= new studentdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
	    	
	    	
	    if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		
		!isset($post_obj->student_id) 			|| $post_obj->student_id== ""||
		!isset($post_obj->user_id) 			|| $post_obj->user_id == ""

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{
				
		     $whr_arr = array(
			 		"id"					=> $commonClass->SQLEscape($post_obj->student_id,"string"));
			 $ins_arr = array(
			 		"session_date"			=> $commonClass->SQLEscape(date('Y-M-d H:i:s'),"datetime"),
					"session_name"			=> $commonClass->SQLEscape($post_obj->user_id,"string"),
					"status"				=> $commonClass->SQLEscape('0',"string")
					);
			 		//$grade=$post_obj->grade;
					$ins_res = $student_obj->update_rows($ins_arr,$whr_arr);
					
            	
				
				if(!empty($ins_res)){
					
					$result->status 	= "7400";
					$result->message 	= 'student details deleted successfully....';
					return json_encode($result);

				}else{
					$result->status 	= "7404";
					$result->message 	= 'student details  failed....';
					return json_encode($result);
				}

			

		}

		
	}
	
	
	public function get_student_list()
	{
		$post_obj 			= $this->request_data();
		$student_obj	= new studentdetails_functions();
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
				$student_info=$student_obj->select_rows($whr_arr);
	   
	    
		if(!empty($student_info)){
			foreach($student_info as $st)
			{
						$student_arr[]=array(
						"student_id" =>$st->id,
						"name"					=>$st->name ,
						"grade"					=> $st->grade,
						"adm_no"	=> $st->adm_no,
						"address"	=> $st->address,					
						"dob"		=> date('Y-m-d',strtotime($st->dob)),
						"gender"				=> $st->gender,
						"contact_no"				=> $st->contact_no,
						"parent_info"				=> json_decode($st->parent_info),
						"parent_pass_away"				=> json_decode($st->parent_pass_away),
						"parent_disease"				=> json_decode($st->parent_disease));
						
			}
					     $result->status 	= "7400";
						$result->message 	= 'question List....';
						$result->value=$student_arr;
						return json_encode($result);
					}else{
					$result->status 	= "7403";
					$result->message 	= 'question details not found....';
					return json_encode($result);
				}
			}
	}
	public function get_single_student_list()
	{
		$post_obj 			= $this->request_data();
		$student_obj	= new studentdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();
		if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(
		!isset($post_obj->user_id) 			|| $post_obj->user_id == "" ||
		!isset($post_obj->student_id) 			|| $post_obj->student_id == ""		
		

				){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{
				$whr_arr = array(
			 		"id"					=> $commonClass->SQLEscape($post_obj->student_id,"string"),
					"status"					=> $commonClass->SQLEscape('1',"string"));
				$student_info=$student_obj->select_rows($whr_arr);
	   
	    
		if(!empty($student_info)){
			foreach($student_info as $st)
			{
						$student_arr[]=array(
						"student_id" =>$st->id,
						"name"					=>$st->name ,
						"grade"					=> $st->grade,
						"adm_no"	=> $st->adm_no,
						"address"	=> $st->address,					
						"dob"		=> date('Y-m-d',strtotime($st->dob)),
						"gender"				=> $st->gender,
						"contact_no"				=> $st->contact_no,
						"parent_info"				=> json_decode($st->parent_info),
						"parent_pass_away"				=> json_decode($st->parent_pass_away),
						"parent_disease"				=> json_decode($st->parent_disease));
						
			}
					     $result->status 	= "7400";
						$result->message 	= 'question List....';
						$result->value=$student_arr;
						return json_encode($result);
					}else{
					$result->status 	= "7403";
					$result->message 	= 'question details not found....';
					return json_encode($result);
				}
			}
	}
	public function get_single_question_detail()
	{
		$post_obj 			= $this->request_data();
		$type_one_obj	= new Typeone_functions();
		$user_db	=new userdetails_functions();
		$commonClass 		= new CommonClass();
	    $result 			= new result();

		if(empty($post_obj)){
			$result->status 	= "7401";
	        $result->message 	= 'Empty Post';
			return json_encode($result);
		}else if(!isset($post_obj->grade) 			|| $post_obj->grade == ""||
		!isset($post_obj->question_id) 			|| $post_obj->question_id== "" ||
		!isset($post_obj->user_id) 			|| $post_obj->user_id== "" ||
		!isset($post_obj->user_type) 			|| $post_obj->user_type== ""
		){
			$result->status 	= "7402";
			$result->message 	= 'Invalid Post';
			return json_encode($result);
			}else{
				
					if($post_obj->user_type=="demo")
				{
					$whr_arr = array(
			 		"id"					=> $commonClass->SQLEscape($post_obj->user_id,"string"));
					$user_det=$user_db->select_rows_user($whr_arr);
				}
				else
				{
					$whr_arr = array(
			 		"digital_id"					=> $commonClass->SQLEscape($post_obj->user_id,"string"));
					$user_det=$user_db->select_rows_user_digital($whr_arr);
				}
				

				
				$list=json_decode($user_det[0]->question_list);
				$a=array();

				foreach ($list as  $l) {
					
					array_push($a, $l);
				}
				

				$val=$post_obj->question_id;
				$qval=$star=$status=$lastq="";
				
				if (in_array($val,$a))
			 	 {
			      		$sval= array_search($val, $a);

			    		if(count($a)==$sval+1)
					    {
					        $qval=0;
					        
					       
					       
					        
					    }
					    else{
					         $qval= $a[$sval+1];
					        
					          
					          
					          
					    	}
			    
			  	}
				else
			  	{
			      $qval=0;
			    }


				if($qval!="" && $qval > 0)
				{
				 $question=$type_one_obj->select_rows_single_question($post_obj->grade,$qval);
				 if(end($a)==$qval)
				{
					 $lastq="1";
					
				}
				else
				{
					$lastq="0";
				}
				 $qs_arr = array(
					"user_id"					=> $commonClass->SQLEscape($post_obj->user_id,"string"),
			 		"question_id"					=> $commonClass->SQLEscape($qval,"string"),
			 		"grade"					=> $commonClass->SQLEscape($post_obj->grade,"string"),
			 		);
				$qs_det=$type_one_obj->select_rows_answers($qs_arr);
				if(!empty($qs_det))
				{
					
					$star=$qs_det[0]->stars;
					$status="1";
				}
				else
				{
					$star="";
					$status="0";
				}
				}
				else
				{
					 $question=array();
				}

	   

	   
	    //$count=count($question);
		if(!empty($question)){
					
					
					foreach ($question as $q) {
						
						if($q->type=="1")
						{
							$opt=$q->set1_option;
							$opt2="-";
							$correctAns=$q->answer;
						}
						else if($q->type=="2" )
						{
								$opt=json_decode($q->set1_option);
								$opt2=json_decode($q->set2_option);
								$correctAns=json_decode($q->answer);
						}
						
						else if($q->type=="3" || $q->type=="4")
						{	

							$opt=json_decode($q->set1_option);
							$opt2="-";
							//shuffle($opt);
							//
							$correctAns=$q->answer;
						}
						else if($q->type=="5")
						{
							$opt=json_decode($q->set1_option);
							$opt2="-";
							
							$correctAns=json_decode($q->answer);
						}
						else if($q->type=="6")
							{	$opt=json_decode($q->set1_option);
								$opt2=json_decode($q->set2_option);
								$correctAns=json_decode($q->answer);
							}
						else if($q->type=="7")
						{
							$opt=json_decode($q->set1_option);
							$opt2=json_decode($q->set2_option);
							
							
							$correctAns=$q->answer;
						}
						else
						{

						}
						/*if($q->set2_option!="-")
						{
							if($q->round=="4" &&$q->type=="3" )
							{
								$opt2=$q->set2_option;
							}
							if($q->type=="6")
							{	$opt=json_decode($q->set1_option);
								$opt2=json_decode($q->set2_option);
								$correctAns=json_decode($q->answer);
							}
							else
							{
								if($q->sub_question=="-")
								{
									$opt2=$q->sub_question;
								}
								else
								{
									$opt2=json_decode($q->set2_option);
									shuffle($opt2);
								}
						
							}
								
								
						}
						else
						{
							$opt2=$q->set2_option;
						}*/
						$sq="";
						if($q->type=="7")
						{
							$sq=json_decode($q->sub_question);
						}
						else
						{
							$sq=$q->sub_question;
						}


						$question_arr[]=array(
							"question_id"=>$q->id,
							"type"=>$q->type,
							"round"=>$q->round,
							"q"=>$q->question,
							"sq"=>$sq,
							"correctAns"=>$correctAns,
							"opt"=>$opt,
							"opt2"=>$opt2,
							"time"=>$q->duration,
							"status"=>$status,
							"star" =>$star,
							"lastq"=>$lastq
							);
					
					}
					
					
						$result->status 	= "7400";
						$result->message 	= 'question List....';
						$result->value=$question_arr;
						
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