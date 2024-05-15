@include('header')
@include('navbar')
<link rel="stylesheet" href="{{ asset('plugins/morris/morris.css') }}">
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Welcome Admin!</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
				
					<div class="row">
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fa-solid fa-user"></i></span>
									<div class="dash-widget-info">
										<h3>00</h3>
										<span>Total Employee</span>
									</div>
								</div>
							</div>


						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<a href="#">
								<div class="card dash-widget">
									<div class="card-body">
										<span class="dash-widget-icon"><i class="fas fa-check-circle"></i></span>
										<div class="dash-widget-info">
											<h3>00</h3>
											<span>Today Present</span>
										</div>
									</div>
								</div>
							</a>
						</div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<a href="#">
								<div class="card dash-widget">
									<div class="card-body">
										<span class="dash-widget-icon"><i class="fas fa-user-slash"></i></span>
										<div class="dash-widget-info">
											<h3>00</h3>
											<span>Today Absent</span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
							<div class="card dash-widget">
								<div class="card-body">
									<span class="dash-widget-icon"><i class="fas fa-bed"></i></span>
									<div class="dash-widget-info">
										<h3>00</h3>
										<span>Today On Leave</span>
									</div>
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->
    </body>
</html>