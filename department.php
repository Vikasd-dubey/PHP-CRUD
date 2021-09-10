<?php include('app.php');?>
<?php include('inc/nav.php');?>
<?php include('db.php');?>
<?php 
  if(isset($_POST['insert'])){
	 $name = isset($_POST['name'])? $_POST['name']: "";
	 $sql = "INSERT INTO departments (name) VALUES ('". $name ."');";
	 if (mysqli_query($conn,$sql)){
		 $success = "New department created successfully";
	 } else {
		 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	 }
  }
  if(isset($_POST['delete'])){
	  $id = isset($_POST['id'])? $_POST['id']: "";
	  $sql = "DELETE FROM departments WHERE id = ". $id .";";
	  if(mysqli_query($conn,$sql)){
		  $success = "Record deleted successfully.";
	  }else{
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
	  }
  }
 ?>
<?php 
  $sql = "SELECT * FROM departments;";
  $result = mysqli_query($conn,$sql);
?>
<section class="department pt-5">
 <div class="container bg-primary">
  <div class="row">
       <div class="col-lg-12 py-5">
	     <h3>Department</h3>
		 <?php include('inc/success-alert.php'); ?>
		    <form method="post" action="department.php">
			<div class="row mb-3">
				<label for="department" class="col-sm-2 col-form-label">Add Department</label>
				<div class="col-sm-8">
					<input type="text" class="form-control bg-white text-dark" name="name" id="#department">
				</div>
				<div class="col-sm-2">
					<button type="submit" name="insert" class="btn btn-warning mb-3">Add Department</button>
				</div>
			</div>	
			 </form>
	   </div>
	   
	   <div class="col-4 mx-auto">
	    <table class="table table-hover table-dark">
		  <thead>
			<tr class="table-warning">
			  <th scope="col">Name</th>
			  <th>Action</th>
			</tr>
		  </thead>
		  <tbody>
			<?php 
				if(mysqli_num_rows($result)>0) {
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td class='text-uppercase'>";
						echo $row['name'];?>
					
						</td><td><form action='department.php' onsubmit="return confirm('Are you sure?');" method='post'>
						<input type='hidden' name='id' value='<?= $row['id'] ?>'/>
						<button type='submit' name='delete' class='btn btn-sm btn-danger remove'>Delete</button>
						</form>
						<?php
						echo "</td></tr>";
					}
				} else {
					echo "<tr><td>Sorry, No Department Found!	</td></tr>";
				}
			?>
		  </tbody>
		</table>
	   </div>	   
  </div>
 </div>
</section>



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