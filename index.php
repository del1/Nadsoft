<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php
require_once(__DIR__.'/classes/Employee.php');

$emp = Employee::getInstance(); 
$employeeList = $emp->get_all_employee();
if(!empty($employeeList))
{
	$emp->print_employee_tree($employeeList);
}else{
	echo "No employee Found";
}

$base_url=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>

<button type="button" class="btn btn-primary showEmployeeList" data-toggle="modal" data-target="#myModal">Add member</button>
<div id="myModal" class="modal fade" role="dialog">
  	<div class="modal-dialog">
    	<!-- Modal content-->
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">&times;</button>
        		<h4 class="modal-title">Add member</h4>
      		</div>
      		<div class="modal-body">
		  		<form id="add_new_member" action="/action_page.php">
		    		<div class="form-group">
		      			<label for="email">Select Parent:</label>
		      			<div class="memberContent">
		      				
		      			</div>
		    		</div>
		    		<div class="form-group">
		      			<label for="pwd">Name:</label>
		      			<input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
		    		</div>
		  		</form>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		<button type="button" class="btn btn-primary addNewEmployee">Submit</button>
      		</div>
    	</div>
  	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		var base_url="<?php echo $base_url; ?>";
		$(".showEmployeeList").click(function(e){
			//$.post(base_url+'Ajax.php?page=getMembers',, 
			$.post('ajax_handlers.php',{ page:"getMembers"}, function(data, status){
				$(".memberContent").html(data);
        		//console.log(data);
    		});
		})

		$(".addNewEmployee").click(function(e){
			//var form=$("#add_new_member");
			//var data=new FormData(form[0]);
			

			var formObj = $("#add_new_member");
			var formData = new FormData(formObj[0]);
			console.log(formData);
			/*$.post('ajax_handlers.php',{ page:"addMember",data: }, function(data, status){
				//$(".memberContent").html(data);
				console.log(data);
    		});*/
		})
	})
</script>
