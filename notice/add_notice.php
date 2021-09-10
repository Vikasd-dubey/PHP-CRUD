<?php include('../app.php') ?>
<?php 
 include('../inc/nav.php');	
 include('../db.php'); 
?>
<?php 
  
  if(isset($_POST['submit'])){
	$subject = isset($_POST['subject'])? $_POST['subject']: "";  
	$message = isset($_POST['message'])? $_POST['message']: "";
	$sql = "INSERT INTO notice (subject, message) VALUES ('". $subject ."', '". $message ."');";
	if (mysqli_query($conn,$sql)){
		$success = "New notice added successfully";
	}else {
		echo "Ërror: " .$sql. "<br>" .mysqli_error($conn);
	}
  }
  ?>
 <?php
 $sql = "SELECT * FROM notice";
 $result = mysqli_query($conn,$sql);
?>

<section class="add-notice pt-5">
 <div class="container bg-primary">
   <div class="row">
   
   <div class="col">
     <h3 class="text-center pt-3">Add Notice</h3>
	 <?php include('../inc/success-alert.php'); ?>
    <form class="m-5" method="POST" action="add_notice.php">
		<div class="mb-3">
		  <label for="subject1" class="form-label">Subject</label>
		  <input type="text" name="subject" class="form-control bg-white" id="subject" placeholder="subject">
		</div>
		<div class="form-outline datepicker" data-mdb-toggle-button="false">
  <input type="text" class="form-control" id="exampleDatepicker1">
  <label for="exampleDatepicker1" class="form-label">Example label</label>
  <button type="button" class="datepicker-toggle-button" data-mdb-toggle="datepicker">
    <i class="fas fa-calendar datepicker-toggle-icon"></i>
  </button>
</div>
		<div class="mb-3">
		  <label for="message" class="form-label">Message</label>
		  <textarea name="message" class="form-control" id="message" rows="3"></textarea>
		</div>
		<div class="mb-3 d-flex justify-content-between">
		 <button type="submit" name="submit" class="btn btn-success">Submit</button>
		 <a href="notice.php" name="back" class="btn btn-warning">Back</a>
		</div>
	
	</form>
	</div>
   </div>
 </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5-stable/tinymce.min.js"></script>
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
	
	tinymce.init({
  selector: 'textarea#message',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});


</script>
</body>
</html>
