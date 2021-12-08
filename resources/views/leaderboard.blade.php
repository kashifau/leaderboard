<!doctype html>
<head>
    <title>Leaderboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="/style.css" >
	<script src="script.js"></script>
</head>

<!-- For layout I will be using Bootstrap cards and grid as it seemed most appropriate based on the image provided, and it is also something I am more comfortable with -->
<body>
	<div class="row">

		<div class="col-4">
			<div class="sidebar">
				<div class="row">
					<div class="card">
						<div class="card-body">
							<div class="row">
								@foreach($data as $key)
									@if($key['name'] == "House Stark")
										<div class="col rounded-img">
											<img src="/assets/house-stark.jpg" alt="house stark rank">
											<span class="rank"><span>#{{ $loop->index+1 }}</span></span>
										</div>
										<div class="col points">
											<span class="upper grey">{{$key['name']}}</span>
											<span class="upper grey strong">Challenge Points</span>
											<span class="large-points strong">{{number_format($key['points'], 0, '.', ',')}}</span>
											
										</div>
									@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="card points-table">
						<div class="card-body">
							<div class="trophy">
								<img src="assets/trophy.svg"/ alt="" >
								<h6 class="grey upper">Overall <span class="grey upper strong">Rankings</span></h6>
							</div>							
						</div>
						<div class="table-responsive">
							<table class="table table-striped">
								@foreach($data as $key)
									<tr>
										@if($key['image'] != null)
											<td class="table-rounded-img">
												<img src="assets/{{$key['image']}}">
											</td>
										@else
											<td><div class="blank-rounded-img">
													<span class="initials">{{preg_filter('/[^A-Z]/', '', $key['name'])}}</span>
												</div>
											</td>
										@endif
										@if($key['name'] == "House Stark")
											<td class="strong dark-blue">{{ $loop->index+1 }}. {{$key['name']}}</td>
											<td class="strong dark-blue">{{number_format($key['points'], 0, '.', ',')}}pts</td>
										@else
											<td>{{ $loop->index+1 }}. {{$key['name']}}</td>
											<td class="strong">{{number_format($key['points'], 0, '.', ',')}}pts</td>
										@endif
									</tr>
								@endforeach
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="card">
						<div class="card-body">
							<h5 class="upper grey about">About</h5>
							<p class="grey"> Closes on <span class="strong">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', '2021-12-23 05:00:00')->format('l, M. d Y, g:iA')}}</span></p>
							<p class="grey"> '<span class="upper">Shift</span>' was designed to show you how a seemingly small change, like adding more steps into your day with your team, can have a huge impact on you and those with whom you participated.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-8 content">
			<div class="card">
				<div class="card-body">
					<h5 class="upper grey">Shift Challenge</h5>
				</div>
				<!-- use of label and role attributes for web accessibility -->
				<span class="header-img" role="img" aria-label="header image"></span>
				<div class="card-body">
					<span><strong> {{now()->format('l, M. d')}} </strong></span>
					<h4 class="upper"><strong>Track your steps</strong></h4>
					<p class="grey">Using your movement-tracking device, keep track of the number of steps you take each day.</p>
					
					<form method="POST" action="store">
						@csrf
						<!-- use of strong tag for web accessibility -->
						<p><strong>Enter your step count for this day.</strong></p>
						<span>Enter your answer</span>
						<div class='col-sm-3'>
							<div class="input-group mb-3">
								<input name="steps" type="number" class="form-control" aria-label="steps" aria-describedby="numOfSteps">
								<div class="input-group-append">
									<button class="btn btn-outline-secondary" type="button">steps</button>
								</div>
							</div>
						</div>
						@if (count($errors) > 0)
							<div class = "alert alert-danger col-4">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<div class='col-4'>
							<input class="btn btn-primary upper" type="submit" value="Save Answer">
						</div>
					</form>
				</div>
			</div>
		</div>

	</div>

</body>
