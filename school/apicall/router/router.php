<?php
ini_set('max_execution_time', 0);
//ini_set('max_input_time', 0);
$method=$_REQUEST['method'];
$postdata = file_get_contents("php://input");
$url='';
$baseUrl='http://localhost/school/apicall/';
//$baseUrl='https://www.digitalspellbee.com/digitalappapi/apicall/';
switch ($method) {

	//register and login
	case 'student_create':
	$url=$baseUrl.'logicfunction/student_crud.php';
	break;
	
	case 'get_student_list';
	$url=$baseUrl.'logicfunction/student_crud.php';
	break;
	 
	case 'student_update':
	$url=$baseUrl.'logicfunction/student_crud.php';
	break;
	
	case 'get_single_student_list';
	$url=$baseUrl.'logicfunction/student_crud.php';
	break;
	
	case 'student_delete';
	$url=$baseUrl.'logicfunction/student_crud.php';
	break;
     
	case 'teacher_create':
	$url=$baseUrl.'logicfunction/teacher_crud.php';
	break;
	case 'get_single_teacher_list';
	$url=$baseUrl.'logicfunction/teacher_crud.php';
	break;
	
	case 'get_single_question_detail';
	$url=$baseUrl.'logicfunction/grade_question.php';
	break;
	
	case 'teacher_update':
	$url=$baseUrl.'logicfunction/teacher_crud.php';
	break;
	case 'teacher_delete':
	$url=$baseUrl.'logicfunction/teacher_crud.php';
	break;
	case 'get_teacher_list';
	$url=$baseUrl.'logicfunction/teacher_crud.php';
	break;
	
	case 'Admin_register';
	$url=$baseUrl.'logicfunction/adminregister.php';
	break;

	case 'Admin_login';
	$url=$baseUrl.'logicfunction/adminregister.php';
	break;

	default:
	echo "Invalid Url";
	break;


}

$postdata=urlencode($postdata);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url.'?method='.$method.'&base_url='.$baseUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,'postdata='.$postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec ($ch);
curl_close($ch);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Cache-Control, Pragma, Origin, Authorization, Content-Type, X-Requested-With');
header('Access-Control-Allow-Methods: GET, PUT, POST');

echo $response;


?>