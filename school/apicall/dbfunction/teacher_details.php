<?php

class teacherdetails_functions{

	var $user_details = "teacher_info";
	public function insert_row($insertArray){		
		$db=new MySQL();
		
		return $db->InsertRow($this->user_details,$insertArray);
	    
		
	}
	
		public function update_rows($valuesArray,$whereArray=null)
		{
			$db=new MySQL();
			$result=$db->UpdateRows($this->user_details,$valuesArray,$whereArray);
			//echo $db->GetLastSQL();
			
			if(!empty($result))
			{
				return $result;
			}else{
				return 0;		
			}
			
		}
		public function select_rows($whereArray = null, $columns = null,
		$sortColumns = null, $sortAscending = true,
		$limit = null)
	{
		$db=new MySQL();
		$db->SelectRows($this->user_details, $whereArray, $columns,
			$sortColumns, $sortAscending,
			$limit);
		//echo $db->GetLastSQL();
		return json_decode($db->GetJSON());
	}
		
}

?>