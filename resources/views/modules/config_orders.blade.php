@extends('layout.base')

@section('content')

	<section class="home_gallery_area p_120">
	    <div class="container">
	        <div class="main_title">
	            <h2>Config Orders</h2>
	            <hr><br>
				<div class="container">
					<form action="" method="POST" id="">
						<div class="row">
							<div class="col-md-12">
								<label class="h5">Quantity orders by day by custumer</label>
								<input type="number" min="0" class="form-control text-center" value="1" name="" required="true">
							</div>
							<div class="col-md-12">
								<br>
								<label class="h5">Ranch of time</label>
								<div class="row">
									<div class="col-md-6">
										<label>initial</label>
										<input type="text" class="form-control text-center" name="" required="true" placeholder="HH:MM:SS">
									</div>
									<div class="col-md-6">
										<label>final</label>
										<input type="text" class="form-control text-center" name="" required="true" placeholder="HH:MM:SS">
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<br>
								<button class="btn btn-primary">save</button>
							</div>
						</div>
					</form>
				</div>	          
	        </div>
	    </div>
	</section>

@endsection