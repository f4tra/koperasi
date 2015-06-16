<style type="text/css">
	
    input.error {
        color: #B94A48 !important;
        background-color: #F2DEDE !important;
        border: 1px solid #EED3D7 !important;
		
    }
	
	label.error {		
		display: inline-block;
		text-align:center;
		margin: 10px;
	}
	label.valid {
		display: inline-block;
		text-align:center;
		margin: 10px;
		background: url(<?=base_url()?>assets/img/valid.png) center center no-repeat;
				
	}
	#availability_status {
		font-size:15px;
		margin-left:5px;
	}
</style>
<div class="all-wrapper no-menu-wrapper light-bg">
  <div class="login-logo-w">
    <a href="<?php echo base_url();?>" class="logo">
      <i class="icon-home"></i>
    </a>
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">

      <div class="widget widget-blue">
        <div class="widget-title">
          <h3 class="text-center"><i class="icon-lock"></i> Register</h3>
        </div>
        <div class="widget-content">
          <form action="" role="form" method="post" id="my-form">
            
            <div class="form-group relative-w">
              <input type="text" class="form-control" placeholder="Enter Full Name" name="name" id="name">
              <i class="icon-user input-abs-icon"></i>
			  
            </div>
			
            <div class="form-group relative-w">
              <input type="email" class="form-control" placeholder="Enter Email" name="email" id="email">
              <i class="icon-envelope-alt input-abs-icon"></i>
			  <span id="availability_status"></span> 
            </div>
            
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" id="cek" name="cek"> I agree to <a href="#">terms of use</a> and <a href="#">policy</a>.
                </label>
              </div>
            </div>
			<input  onclick="save(this);" type="submit" class="btn btn-success btn-rounded btn-iconed" value="Register Now">
            <div class="no-account-yet">
              Already have an account? <a href="<?php echo base_url();?>">Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test( email ) ) {
        return false;
        } else {
        return true;
       }
}
$("#email").change(function()
	{
		//if theres a change in the email textbox
		var email = $("#email").val();//Get the value in the email textbox
		//var email = 'emails='+ $(this).val();
		if(validateEmail(email))//if the lenght greater than 3 characters
		{
			$("#availability_status").html('Checking availability...');
			//Add a loading image in the span id="availability_status"
			$.ajax({
				//Make the Ajax Request
				type: "POST",
				url: "<?=base_url();?>index.php/auth/register/cek_email",
				data: "email="+email,
				success: function(server_response){
					//$("#availability_status").ajaxComplete(function(event, request){
						if(server_response == '0')
						{
							$("#availability_status").html('<font color="Green">Tersedia </font>');
							
						}
						else if(server_response == '1')//if it returns "1"
						{
							$("#availability_status").html('<font color="red">Sudah Digunakan </font>');
							
						}
					//});
				}
			});
		}
	return false;
});

$("#loading").hide();
function save(){
	$("#my-form").validate({
		rules:{			
			email: {
				required:true,
				email	:true
			},
			cek: {
				required:true,				
			},
		},
		highlight: function(element) {
			$(element).closest('input').removeClass('success').addClass('error');
		},
		unhighlight:function(element){
			$(element).closest('input').removeClass('error').addClass('success');
		},
		success: function(element) {
			element
			.addClass('valid')
			.closest('input').removeClass('error').addClass('success');
		},
		submitHandler: function(form){
				//form.submit();
				
			$.ajax({
			url: '<?=site_url('auth/register/execute');?>',				
			type: "POST",
			dataType:"json",
			data: $("#my-form").serialize(),
			beforeSend: function(){
				$("#loading").show();				
			},				
			success:function(data){
				console.log(data);
					if(data.retcode==="10"){
						$.pnotify({
							title: 'Invalid Parameter',
							text: 'Invalid Parameter.',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "notice",
						});
					$("#loading").hide();
					//form.reset("#my-form");
					}else if(data.retCode==="20"){
						$.pnotify({
							title: 'Email Not Available',
							text: 'Email Not Available',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "notice",
						});
					$("#loading").hide();
					//form.reset("#my-form");
					
					}else if(data.retCode==='00'){
						$.pnotify({
							title: 'Sukses',
							text: 'Cek Your Email For Activation. Thks',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "success",
						});
					$("#loading").hide();
					form.reset("#my-form");
					//window.setTimeout( function(){ window.location = data.url;}, 3000 );
					}else{
						$.pnotify({
							title: 'Error',
							text: 'Error System.',
							animation: {
								effect_in: 'show',
								effect_out: 'slide'
							},
							type : "error",
						});
						$("#loading").hide();
					}
			},
			error: function (request, status, error) {
				//show_stack_bottomright('error');				
					$.pnotify({
						title: 'System Bussy',
						text: 'System Bussy.',
						animation: {
								effect_in: 'show',
								effect_out: 'slide'
						},
						type : "info",
					});
					$("#loading").hide();
			}, 	
			});
		}
	});		    
}


</script>