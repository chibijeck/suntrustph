<?php
	
	if(isset($_POST["submitUpdate"])){		
		try { 
			$decode = explode('|', $_POST['email']);
			//print_r($decode);
			$user_id = str_replace("user_id:", "", $decode[0]);
            $check = upcomingbillEmail($user_id, 1);	
           	if($check){
	            ?>
				<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  <strong>Email Sent!</strong>
				</div>
				<?php
	           	}
			} catch (Exception $e) {
				echo $e->getMessage(); 		
		}				
	}	
 ?>
	<div class="">		
		<form role="form" method="post" action="<?php echo $_SERVER["REQUEST_URI"] ?>" data-toggle="validator">		
	 		<div class="form-group">
				<label for="email">Name</label>
				<input type="text" value="" class="form-control" onkeyup="theFunction()" id="getemail" placeholder="Resend email? Search for name">
				<!-- <input type="text" value="" class="form-control" id="emaildisplay" placeholder=""  data-error="Required" required> -->
				<div id="emaildisplay" name="emaildisplay" class='help-block with-errors'></div>
				<input type="hidden" value="" id="email" name="email">
				<script>
				function theFunction(){
					var emailVal = $('#getemail').val();
					$.ajax({
					      type: 'POST',
					      url: "/emailList.php",
					      data: { email:emailVal },
					      dataType: "html",
					      success: function(data){ 
					      	//console.log(data); 
					      	//var emailappend = "<div class='help-block with-errors'>"+data+"</div>";
					      	$('#emaildisplay').html(data);
					      	$('#email').val($('#emaildisplay').text());
					      }
					});
				}
				</script>
				
				
			</div>	
			
			<button type="submit" class="btn btn-default" name="submitUpdate" >Submit</button>
		</form>			
	</div>