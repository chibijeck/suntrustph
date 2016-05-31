<?php 

	//*** SETTINGS ***//	
	$folder_path= 'plugins/secured_ajax_contact/';	
	require($folder_path . 'settings.php');
?>
<link rel="stylesheet" href="<?php echo $folder_path; ?>secured_ajax_contact.css" type="text/css" media="screen" />
<div class="container mainBody">	
	<div class="row">

	  <div class="col-xs-8">
			<h1 class="stylh1">Contact US</h1>	
			<form action="<?php echo $folder_path;?>email_process.php" id="secured_ajax_contact">
				<table>	
				<div id="result_sac" style="display:none;"></div>
					<tr>			
					
						<div class="row">
						  <div class="col-xs-6">
							<label>Name *<span class="error_sform name"></span></label>
							<input type="text" name="name"  value="" >
						  </div>
						  <div class="col-xs-6">
							<label>Email *<span class="error_sform email"></span></label>
							<input type="text" name="email"  value="" >					  
						  </div>
						</div>	
					</tr>		

					<tr>
						<td colspan="2">
							<label>Message *<span class="error_sform message"></span></label>
							<textarea name="message" ></textarea>
						</td>
					</tr>			
					
					<tr>			
						<td>
							<input class="buttoninput" type="submit" name="submitSForm" value="Send">
									
						</td>
						<td>			
							<i class="fa fa-refresh fa-spin loaderimg"></i>
						</td>					
					</tr>			
				</table>	
			</form>				
		</div>
		
			<div class="col-xs-4">
		<h2>Company Info</h2>	
		<table class="table table-striped companyInfoContactUs">
		  <tr>
			<td>
					<i class="fa fa-home"></i>
				</td>
				<td>
					G/F Boy Scouts of the Philippines Bldg.
					181 Almeda Lopez Street
					Ermita, Manila
				</td>
			</tr>
			
			<tr>
				<td>
					<i class="fa fa-phone"></i>
				</td>
				<td>
					(632) 856-70-15 to 19
				</td>
			</tr>
			<!--tr>
				<td>
					<i class="fa fa-mobile"></i> 
				</td>
				<td>
					0922-4844650
				</td>
			</tr>	
			<tr>
				<td>
					<i class="fa fa-envelope"></i>
				</td>
				<td>
					
				</td>
			</tr-->
		</table>
	</div>
		
		
	</div>
</div>

<script>
$(function(){
	
	function emptyChecker(){
		//reset the message
		$(".error_sform").html('');
		$( '#secured_ajax_contact input,#secured_ajax_contact textarea' ).css({'border':'1px solid #DBDBDB'});
		$('#result_sac').hide();		
		willSend = true;
		//name
		if( !$("input[name='name']").val() ) {
			$(".error_sform.name").html('Name is required');
			$("input[name='name']" ).css({'border':'1px solid #EA8A8A'});
			willSend = false;			
		}		
		function validateEmail(email) { 		  
			var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return re.test(email);
		}		
		//email		
		email_input = $("input[name='email']").val();			 
		var emailChecker = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (!emailChecker.test(email_input)){				
			$("input[name='email']").css({'border':'1px solid #EA8A8A'});
			$(".error_sform.email").html('Invalid Format');
			willSend = false;
		}		
		if( !$("input[name='email']").val() ) {
			$(".error_sform.email").html('Email is required');
			$("input[name='email']").css({'border':'1px solid #EA8A8A'});
			willSend = false;
		}	
		//message
		if( !$("textarea[name='message']").val() ) {
			$(".error_sform.message").html('Message is required');
			$("textarea[name='message']").css({'border':'1px solid #EA8A8A'});
			willSend = false;
		}		
		return willSend;
	} 	 

	$( "#secured_ajax_contact" ).submit(function( event ) {		
		// Stop form from submitting normally
		event.preventDefault();
		//check first if empty using jquery
		if(emptyChecker()){
			$('.loaderimg').show();
			//resets the field border color upon submit 
			$( '#secured_ajax_contact input,#secured_ajax_contact textarea' ).css({'border':'1px solid #DBDBDB'});				
			// Get some values from elements on the page:
			var $form = $( this ),
			Name = $form.find( "input[name='name']" ).val(),
			Email = $form.find( "input[name='email']" ).val(),
			Message = $form.find( "textarea[name='message']" ).val(),
			url = $form.attr( "action" );					
			var data_form = { Name: Name,Email: Email, Message: Message };			
			var outcome = function( data ) {
							 $('#result_sac').html(data.form_message).fadeIn( "slow" );							 
							 //colorize the border error in red
							 $( data.field ).css({'border':'1px solid #EA8A8A'});
							 //hide loader
							 $('.loaderimg').hide();
							 if(data.status == "sent"){
								//removes all the data inputed except input.buttoninput
								$('#secured_ajax_contact input:not(.buttoninput) ,#secured_ajax_contact textarea').val('');
							 }					 
						};					
			//send the file
			 $.post( url,data_form,outcome, 'json');	
		}
	});	
});
</script>