<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
		<meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Include CSRF token -->

        <title>Create User</title>
		
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/material.css') }}">
					
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    </head>
	
    <body class="account-page" style="background:  linear-gradient(277.57deg, #6258a6 0%, #82cae8 100%);">
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="container">					
					
					<div class="account-box">
						<div class="account-wrapper">
						

							<p class="account-subtitle">Access to our dashboard</p>
                            <!-- error show -->
							@if ($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    <div class="txt-success">{{ $message }}</div>
                                </div>
                            @endif

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger" role="alert">
                                    <div class="txt-danger">{{ $message }}</div>
                                </div>
                            @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger" role="alert">
                                    <div class="txt-danger">
                                        <ul class="list-group">
                                            @foreach ($errors->all() as $error)
                                                <li><i class="icofont icofont-arrow-right"></i> {{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <!-- error show -->
							<!-- Account Form -->
							<form action="{{route('createUser')}}" method="post" >
								@csrf
                                <div class="input-block mb-4">
									<label class="col-form-label">Name</label>
									<input class="form-control" type="text" name="name">
								</div>
								<div class="input-block mb-4">
									<label class="col-form-label">Email Address</label>
									<input class="form-control" type="text" name="email">
								</div>
                                <div class="input-block mb-4">
                                    <label class="col-form-label">Select Account Type<span class="text-danger">*</span></label>
                                    <select name="account_type" class=" form-select" required>
                                        <option value="Individual">Individual</option>
                                        <option value="Business">Business</option>
                                    </select>
								</div>
								<div class="input-block mb-4">
									<div class="row align-items-center">
										<div class="col">
											<label class="col-form-label">Password</label>
										</div>
										
									</div>
									<div class="position-relative">
										<input class="form-control" type="password" name="password" id="password">
										<span class="fa-solid fa-eye-slash" id="toggle-password" style="cursor: pointer"></span>
									</div>
								</div>
                                <div class="input-block mb-4">
									<div class="row align-items-center">
										<div class="col">
											<label class="col-form-label">Confirm Password</label>
										</div>
									</div>
									<div class="position-relative">
										<input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
										<span class="fa-solid fa-eye-slash" id="toggle-password" style="cursor: pointer"></span>
									</div>
								</div>
                                <div id="message"></div>
								<div class="input-block mb-4 text-center">
									<button class="btn btn-primary account-btn" type="submit">create user</button>
								</div>
								<div class="account-footer">
									<p>have account already? <a href="#">Login</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<script> 

$(document).ready(function() {
    $('#password, #password_confirmation').on('keyup', function () {
        var password = $('#password').val();
        var confirmPassword = $('#password_confirmation').val();

        if (password.length >= 6) {
            if (password == confirmPassword) {
                $('#message').html('Matching').css('color', 'green');
                $('#submitBtn').prop('disabled', false); // Enable the submit button
            } else {
                $('#message').html('Not Matching').css('color', 'red');
                $('#submitBtn').prop('disabled', true); // Disable the submit button

            }
        } else {
            $('#message').html('Password must be at least 6 characters').css('color', 'red');
            $('#submitBtn').prop('disabled', true); // Disable the submit button

        }
    });
});

document.getElementById('toggle-password').addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    var icon = document.getElementById('toggle-password');

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordInput.type = "password";
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
});


			$(document).ready(function() {
				$('#loginform').submit(function(e) {
					e.preventDefault();
					console.log('ok');
					var formData = new FormData(this);
					$.ajax({
							url: '/login', 
							type: 'POST',
							data: formData,
							contentType: false,
							processData: false,
							
							error: function(xhr, status, error) {
								if (xhr.status === 422 ) {
									var errors = xhr.responseJSON.error;
									var errorMessage = "<ul>";
									for (var field in errors) {
										errorMessage += "<li>" + errors[field][0] + "</li>";
									}
									errorMessage += "</ul>";
								}
								if(xhr.status === 401){
									var errors = xhr.responseJSON.error;
									var errorMessage = "";
									for (var field in errors) {
										errorMessage += errors[field][0] ;
									}
								}
								Swal.fire({
									icon: 'error',
									title: 'Validation Error',
									html: errorMessage
								});
								
							}
						});
					});
				});
		</script>
			
    </body>
</html>