<!DOCTYPE html>
<html>
<head>
<title>Company Employees Records</title>
<link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css"/> 
</head>
<body>
<?php include('db.php'); 
 
 $sql = "SELECT * FROM employee" ;
 $result = mysqli_query($conn, $sql);
 
 if(isset($_POST['insert'])) {
	//print_r($_POST);
	$name = isset($_POST['name'])? $_POST['name'] : "";
	$email = isset($_POST['email'])? $_POST['email'] : "";
	$gender = isset($_POST['gender'])? $_POST['gender'] : "";
	
	$sql = "INSERT INTO employee (name, email, gender) VALUES ('". $name ."', '". $email ."', '". $gender ."');";
	if (mysqli_query($conn,$sql)){
		$success =  "New record created successfully";
	} else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

 }

 if(isset($_POST['update'])) {
	 $id = isset($_POST['id'])? $_POST['id'] : "";
	 $name = isset($_POST['name'])? $_POST['name'] : "";
	 $email = isset($_POST['email'])? $_POST['email'] : "";
	 $gender = isset($_POST['gender'])? $_POST['gender'] : "";
	 
	 $sql = "UPDATE employee SET name='". $name ."', email='". $email ."', gender='". $gender ."' WHERE id=". $id.";";
	 if (mysqli_query($conn,$sql)){		 
		 $success = "Record Updated Successfully";
	 } else {
		 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	 }
 }
 
  if(isset($_POST['delete'])) {
	 $id = isset($_POST['id'])? $_POST['id'] : ""; 
	 $sql = "DELETE FROM employee WHERE id=". $id.";";
	 if (mysqli_query($conn,$sql)){		 
		 $success = "Record Deleted Successfully";
	 } else {
		 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	 }
 }

?>
<header>
 <h2 class="text-white text-center py-2">ACME INC.</h2>
</header>
<section class="content">
  <div class="container bg-primary">
    <div class="row">
     <div class="col p-5">
	   <?php if(isset($success)): ?>
	    <div class="alert alert-dismissible alert-success">
			<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
			<strong>Well done!&nbsp;<?= $success ?></strong>.
	    </div>
		
	   <?php endif; ?>
<button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">New Record</button>

<!-- Modal -->
<div class="modal " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Insert New Record Beta </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  
   <form method="post" action="index.php">
	<div class="mb-3">
    <label for="exampleInputName" class="form-label">Name</label>
    <input type="name" name="name" class="form-control" id="exampleInputName">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
   <label for="exampleInputEmail1" class="form-label">Gender</label><br>
		   <!-- Default radio -->
		<input type="radio" name="gender" value="Male" checked>Male<br> <!--This one is automatically checked when the user opens the page -->
<input type="radio" name="gender" value="Female">Female
  </div>
  <button type="submit" name="insert" class="btn btn-primary">Submit</button>
</form>

      </div>
      
    </div>
  </div>
</div>

<table class="table table-hover">
  <thead>
    <tr class="table-primary">
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Gender</th>
	  <th scope="col">Action</th>
      
    </tr>
  </thead>
  <tbody>
    
	  <?php 
	  
	  if(mysqli_num_rows($result)>0){
	   while($row = mysqli_fetch_assoc($result)){
		  echo " <tr class='table-dark'>";
		  echo "<td>".$row['name']."</td>";
		   echo "<td>".$row['email']."</td>";
		    echo "<td>".$row['gender']."</td>";
			 echo "<td>"."
			 <button type='button' class='btn btn-sm btn-warning my-2' data-bs-toggle='modal' data-bs-target='#editBackdrop' data-id='" . $row['id'] . "' data-name='". $row['name'] . "' data-email='" . $row['email'] . "' data-gender='" .$row['gender']. "'>Edit</button>";?>
			  <form method='post' onsubmit="return confirm('Are you sure?');" action='index.php'>
			  <input type='hidden' name='id' value='<?= $row['id'] ?>'/>
			  <button type='submit' name="delete" class='btn btn-sm btn-danger remove'>Delete</button>
			  </form>
			  <?php echo"</td>";
					echo "</tr>";
				}
			} else {
					echo "0 results";
			}
	  ?>

     
    
    
  </tbody>
</table>

    
	 </div>
	</div>
  </div>
</section>

<!-- Modal for edit button-->
<div class="modal " id="editBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Record Beta </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
	  
   <form method="post" action="index.php">
    <input type="hidden" name="id" id="eid"/>
	<div class="mb-3">
    <label for="exampleInputName" class="form-label">Name</label>
    <input type="name" name="name" class="form-control" id="edit_name">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="edit_email" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
   <label for="exampleInputEmail1" class="form-label">Gender</label><br>
		   <!-- Default radio -->
		<input type="radio" name="gender" value="Male" checked>Male<br> <!--This one is automatically checked when the user opens the page -->
<input type="radio" name="gender" value="Female">Female
  </div>
  <button type="submit" name="update" class="btn btn-primary">Submit</button>
</form>

      </div>
      
    </div>
  </div>
</div>
<!-- Modal for edit button end-->


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
<script>
	$(document).ready(function() {
		$('#editBackdrop').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var name = $(e.relatedTarget).data('name');
			var email = $(e.relatedTarget).data('email');
			var gender = $(e.relatedTarget).data('gender');
			$('#edit_name').val(name);
			$('#edit_email').val(email);
			$('#eid').val(id);
		});	
	});
</script>
</body>
</html>
