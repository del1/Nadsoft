<?php

if(isset($_POST['page']))
{
	if($_POST['page']=="getMembers")
	{
		require_once(__DIR__.'/classes/Employee.php');
		$emp = Employee::getInstance();
		$employeeList = $emp->get_all_employee();
		echo "<select name='parentId' class='form-control'>";
		foreach ($employeeList as $employee) {
			echo  "<option value='".$employee['id']."'>".$employee['name']."</option>";
		}
		echo "</select>";
	} 
	if($_POST['page']=="addMember")
	{
		print_r($_POST['data']);

	}
}

