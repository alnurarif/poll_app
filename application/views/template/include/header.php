<!-- header section start  -->
<section id="header_section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
					<a class="navbar-brand" href="<?php echo base_url(); ?>">Home</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item">
								<a class="nav-link" href="<?php echo base_url(); ?>Dashboard">Dashboard</span></a>
							</li>

							<li class="nav-item active">
								<a class="nav-link" href="#">Library <span class="sr-only">(current)</span></a>
							</li>

							<li class="nav-item active">
								<a class="nav-link" href="<?php echo base_url(); ?>Insights">Insight <span class="sr-only">(current)</span></a>
							</li>


							<li>
								<div class="dropdown">
									<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Create Poll
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="<?php echo base_url(); ?>Dashboard/addSpeedoMeter">Speedometer</a>
										<a class="dropdown-item" href="<?php echo base_url(); ?>Dashboard/addCompass">Compass</a>
										<a class="dropdown-item" href="<?php echo base_url(); ?>Dashboard/addSliderPoll"">Slider</a>
									</div>
								</div>
							</li>


						</ul>
						<a href="<?php echo base_url(); ?>Authentication/logOut" style="color: #fff">Logout</a>
					</div>
				</nav>
			</div>
		</div>
	</div>

</section>