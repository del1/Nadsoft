<?php
require_once('Database.php');

class Employee
{
	public $db;
	public $Employee_with_parent;
	public $single_employee;
	private static $_instance;
	public function __construct()
	{
		
	}

	public function get_all_employee()
	{
		$this->db= Database::getInstance();
		return $this->db->getAll('SELECT * FROM employee'); // 1 line selection, return 1 line
	}

	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function print_employee_tree($employeeList)
	{
		if(is_array($employeeList))
		{
			//part 1- array sapration
			foreach ($employeeList as $employee) {
				//saperate the employee with parent 
				if(isset($employee['parentId'])) //
				{ //allemployeee with parent_id
					if(isset($this->Employee_with_parent[$employee['parentId']]))
					{//already exist array
						array_push($this->Employee_with_parent[$employee['parentId']], $employee);
					}else{//create one
						$this->Employee_with_parent[$employee['parentId']]=array($employee);
					}
				}else{ // all singles//without parent id
					$this->single_employee[$employee['id']]=$employee;
				}
			}

			//part 2- begining of execution //keeping one task at one place
			if(!empty($this->single_employee)){
				foreach ($this->single_employee as $employee) {
					echo "<ul>";
					echo "<li>".$employee['name']."</li>";
					if(isset($this->Employee_with_parent[$employee['id']]))
					{
						$this->pass_by_single($this->Employee_with_parent[$employee['id']]);
					}
					echo "</ul>";	
				}
			}
		}
	}

	public function pass_by_single($employeeList)
	{//part 3-end of play
		foreach ($employeeList as $employee) {
			echo "<ul>";
			echo "<li>".$employee['name']."</li>";
			if(isset($this->Employee_with_parent[$employee['id']]))
			{
				$this->pass_by_single($this->Employee_with_parent[$employee['id']]);
			}
			echo "</ul>";
		}
	}

	public function insert_new_employee($args)
	{
		print_r($args);
	}
}