<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Smart Warehouse</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link rel="stylesheet" href="https://cdn.tailwindcss.com">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="/" class="logo">
					Smart Warehouse
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					
					<form class="navbar-left navbar-form nav-search mr-md-3" action="">
						<div class="input-group">
							<input type="text" placeholder="Search ..." class="form-control">
							<div class="input-group-append">
								<span class="input-group-text">
									<i class="la la-search search-icon"></i>
								</span>
							</div>
						</div>
					</form>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-envelope"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="la la-bell"></i>
								<span class="notification">3</span>
							</a>
							<ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
									<div class="notif-center">
										<a href="#">
											<div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
											<div class="notif-content">
												<span class="block">
													New user registered
												</span>
												<span class="time">5 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
											<div class="notif-content">
												<span class="block">
													Rahmad commented on Admin
												</span>
												<span class="time">12 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-img"> 
												<img src="assets/img/profile2.jpg" alt="Img Profile">
											</div>
											<div class="notif-content">
												<span class="block">
													Reza send messages to you
												</span>
												<span class="time">12 minutes ago</span> 
											</div>
										</a>
										<a href="#">
											<div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
											<div class="notif-content">
												<span class="block">
													Farrah liked Admin
												</span>
												<span class="time">17 minutes ago</span> 
											</div>
										</a>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="la la-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							<img src="assets/img/profile.jpg">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span>
								{{ Auth::user()->name }}
								<span class="user-level">
									{{ ucfirst(Auth::user()->role) }}
								</span>
								<span class="caret"></span>
							</span>
	
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<class="nav">
									</li>
									<a class="link-collapse" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>Logout</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
								</ul>
							</div>
						</div>
					</div>
						<ul class="nav">
							<li class="nav-item active">
								<a href="/">
									<i class="la la-dashboard"></i>
									<p>Dashboard</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="forms.html">
									<i class="la la-keyboard-o"></i>
									<p>Forms</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="tables.html">
									<i class="la la-th"></i>
									<p>List Barang</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="hasil.html">
									<i class="la la-fonticons"></i>
									<p>Hasil Algoritma</p>
								</a>
							</li>	
						</ul>
					</div>
				</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<div class="row">
						
<!-- 							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center icon-warning">
													<i class="la la-pie-chart text-warning"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Number</p>
													<h4 class="card-title">150GB</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body ">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-bar-chart text-success"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Revenue</p>
													<h4 class="card-title">$ 1,345</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-times-circle-o text-danger"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Errors</p>
													<h4 class="card-title">23</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<div class="row">
											<div class="col-5">
												<div class="icon-big text-center">
													<i class="la la-heart-o text-primary"></i>
												</div>
											</div>
											<div class="col-7 d-flex align-items-center">
												<div class="numbers">
													<p class="card-category">Followers</p>
													<h4 class="card-title">+45K</h4>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							</div>
							<div class="row">
    
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Desain Gudang Obat Nyamuk</h4>
									<p class="card-category">Tampilan Atas</p>
								</div>
    <!-- KANAN: WAREHOUSE -->
							<div class="card-body">
								<div class="racks-section ">
									@for ($x = 0; $x < 10; $x++)
										<div class="rack">
											@for ($y = 0; $y <= 3; $y++)
												@php
													$rackData = $groupedBarang[$x][$y][$z] ?? null;

												@endphp
												<div class="rack-shelf {{ $rackData ? 'occupied' : '' }}">
													@if ($rackData)
														<div class="tooltip">
															<span class="item-name">{{ $rackData[0]['nama_barang'] ?? '' }}</span>
															<div class="tooltiptext">
																@foreach ($rackData as $item)
																	<p><strong>Nama Barang:</strong> {{ trim($item['nama_barang']) }}</p>
																	<p><strong>Jenis Barang:</strong> {{ trim($item['jenis_barang']) }}</p>
																	<p><strong>Jumlah:</strong> {{ $item['jumlah'] }}</p>
																@endforeach
															</div>
														</div>
													@endif
												</div>
											@endfor
										</div>
									@endfor
								</div>

								<!-- CONVEYOR BELT -->
								<div class="conveyor-belt">
									<div class="entry-exit">E</div>
									@for ($i = 0; $i < 10; $i++)
										<div class="conveyor-marker"></div>
									@endfor
								</div>

								<!-- RAK BAWAH -->
								 <div class="overflow-container">
								<div class="racks-section ">
									@for ($x = 10; $x < 20; $x++)
										<div class="rack">
											@for ($y = 0; $y <= 3; $y++)
												@php
													$rackData = $groupedBarang[$x][$y][$z] ?? null;
												@endphp
												<div class="rack-shelf {{ $rackData ? 'occupied' : '' }}">
													@if ($rackData)
														<div class="tooltip">
															<span class="item-name">{{ $rackData[0]['nama_barang'] ?? '' }}</span>
															<div class="tooltiptext">
																@foreach ($rackData as $item)
																	<p><strong>Nama Barang:</strong> {{ $item['nama_barang'] }}</p>
																	<p><strong>Jenis Barang:</strong> {{ $item['jenis_barang'] }}</p>
																	<p><strong>Jumlah:</strong> {{ $item['jumlah'] }}</p>
																@endforeach
															</div>
														</div>
													@endif
												</div>
											@endfor
										</div>
									@endfor
								</div>
							</div>
							<div class="warehouse">
								<style>/* WAREHOUSE LAYOUT */
									.warehouse {
										display: flex;
										flex-direction: column;
										gap: 20px;
										align-items: center;
										width: 100%;
										max-width: 900px;
										margin: 0 auto;
									}

									/* RACKS SECTION */
									.racks-section {
										overflow: visible;
										display: flex;
										gap: 10px;
										width: 100%;
										justify-content: flex-start;
										flex-wrap: nowrap;
										overflow-x: auto;
										min-width: max-content;
									}

									/* INDIVIDUAL RACK */
									.rack {
										background-color: #4CAF50;
										border: 1px solid #E6A970;
										width: 40px;
										height: 80px;
										display: flex;
										flex-direction: column;
										justify-content: space-between;
										border-radius: 6px;
										flex-shrink: 0;
									}

									/* RACK SHELF */
									.rack-shelf {
										height: 18px;
										border-bottom: 1px solid #E6A970;
										position: relative;
										overflow: visible;
									}
									/* Ganti background solid dengan pola garis diagonal */
										.rack-shelf.occupied {
										background: repeating-linear-gradient(
											-45deg,
											#F44336,
											#F44336 2px,
											transparent 2px,
											transparent 8px
										);
										border-bottom: 1px solid #E6A970;
										position: relative;
										}

										/* Efek tambahan untuk memperjelas arsiran */
										.rack-shelf.occupied::after {
										content: "";
										position: absolute;
										top: 0;
										left: 0;
										right: 0;
										bottom: 0;
										background: linear-gradient(
											to bottom,
											rgba(0,0,0,0.1) 0%,
											transparent 50%,
											rgba(0,0,0,0.1) 100%
										);
										pointer-events: none;
										}
								/* Enhanced Tooltip Styles */
									.tooltip {
										position: relative;
										display: inline-block;
									}

									.tooltiptext {
										visibility: hidden;
										width: 160px;
										background-color: #333;
										color: #fff;
										text-align: left;
										border-radius: 5px;
										padding: 5px;
										position: absolute;
										z-index: 9999;
										bottom: 125%; /* Naik ke atas elemen */
										left: 50%;
										transform: translateX(-50%);
										opacity: 0;
										transition: opacity 0.3s;
									}

									.tooltip:hover .tooltiptext {
										visibility: visible;
										opacity: 1;
									}

									
									.rack-shelf:hover .tooltip .tooltiptext {
										visibility: visible;
										opacity: 1;
									}
									
									/* Improved Rack Styling */
									.rack-shelf {
										position: relative;
										cursor: pointer;
										transition: all 0.2s;
									}
									
									.rack-shelf:hover {
										transform: scale(1.05);
										z-index: 10;
									}
									
									.rack-shelf.occupied:hover {
										box-shadow: 0 0 0 2px #fff;
									}

									/* CONVEYOR BELT */
									.conveyor-belt {
										background-color: #A4B8D3;
										height: 40px;
										width: 100%;
										max-width: calc(10 * 40px + 9 * 10px);
										display: flex;
										position: relative;
										align-items: center;
										margin: 20px 0;
									}

									.conveyor-marker {
										background-color: #3A5998;
										width: 15px;
										height: 100%;
										margin: 0 35px 0 0;
									}

									.sensor {
										background-color: #FF5733;
										width: 15px;
										height: 15px;
										border-radius: 50%;
										position: absolute;
										z-index: 2;
									}

									/* ITEM SIMULATION ON BELT */
									.item {
										width: 12px;
										height: 12px;
										background-color: #FF6347;
										border-radius: 50%;
										position: absolute;
										top: 14px;
										animation: moveItem 5s linear infinite;
									}

									@keyframes moveItem {
										0% { left: 0px; }
										100% { left: 850px; }
									}

									/* ENTRY / EXIT POINT */
									.entry-exit {
										background-color: #7AB594;
										width: 40px;
										height: 40px;
										display: flex;
										align-items: center;
										justify-content: center;
										color: white;
										font-weight: bold;
										margin-left: auto;
									}

									/* LEGEND */
									.legend {
										margin-top: 20px;
										display: flex;
										gap: 20px;
										justify-content: center;
										flex-wrap: wrap;
									}
									.legend-item {
										display: flex;
										align-items: center;
										gap: 5px;
									}
									.legend-color {
										width: 20px;
										height: 20px;
										border-radius: 4px;
									}

									/* SPECIFICATIONS / LABEL */
									.specifications {
										margin-top: 20px;
										text-align: center;
										font-size: 14px;
										color: #555;
									}

									/* OPTIONAL: RACK LABELS */
									.rack-label {
										font-size: 10px;
										text-align: center;
										margin-top: 2px;
										color: #333;
									}
									
								</style>
							</div>
               <!-- Legend -->
							<div class="legend">
								<div class="legend-item">
									<div class="legend-color" style="background-color: #4CAF50;"></div> Rak Kosong
								</div>
								<div class="legend-item">
									<div class="legend-color" style="background-color: #F44336;"></div> Rak Terisi
								</div>
								<div class="legend-item">
									<div class="legend-color" style="background-color: #A4B8D3;"></div> Conveyor Belt
								</div>
								<div class="legend-item">
									<div class="legend-color" style="background-color: #7AB594;"></div> Pintu Masuk
								</div>
							</div>
								<form method="GET" action="{{ 'index' }}">
								<label for="z">Pilih Level :</label>
								<select name="z" id="z" onchange="this.form.submit()">
									<option value="1" {{ request('z') == 1 ? 'selected' : '' }}>Bawah</option>
									<option value="2" {{ request('z') == 2 ? 'selected' : '' }}>Tengah</option>
									<option value="3" {{ request('z') == 3 ? 'selected' : '' }}>Atas</option>
								</select>
								</form>
							<!-- Spesifikasi Gudang -->
							<div class="specifications">
								<h5>Spesifikasi Gudang:</h5>
								<ul style="list-style-type: none; padding: 0;">
									<li>Total Rak: 20 Unit (10 atas, 10 bawah)</li>
									<li>Conveyor Belt: 1 Jalur Tengah</li>
									<li>Kapasitas Rak: 4 baris Per Rak</li>
								</ul>
								<div class="legend">
									<i class="la la-circle text-primary"></i> Completed ({{ $slotTerisi }} / {{ $totalSlot }} slot terisi)
								</div>
							</div>
						</div>
					</div>
				</div><div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<div class="card-title">Table list Barang</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
													<th>ID</th>
                									<th>Jenis Barang</th>
                									<th>Nama Barang</th>
                									<th>Text ID</th>
                									<th>Jumlah Barang</th>
                									<th>Tanggal Masuk</th>
														
													</tr>
												</thead>
												<tbody>
												@foreach($items as $item)
            										<tr>
														<td>{{ $item->id }}</td>
														<td>{{ $item->jenis_barang }}</td>
														<td>{{ $item->nama_barang }}</td>
														<td>{{ $item->text_id }}</td>
														<td>{{ $item->jumlah_barang }}</td>
														<td>{{ $item->created_at }}</td>
													</tr>
													@endforeach
													<tr>
									<td colspan="5"><strong>TOTAL BARANG DI GUDANG</strong></td>
									<td><strong>{{ $totalBarang }}</strong></td>
									</tr>
											<tr style="border-top: 2px solid #ddd;">
										<tr style="background: #f9f9f9; font-weight: bold;">


												</tbody>
											</table>
											<div class="d-flex justify-content-center mt-4">
    										{{ $items->links('pagination::bootstrap-5') }}
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Okupansi</h4>
									<p class="card-category">Complete</p>
								</div>
								<div class="card-body">
								<canvas id="pieChartOkupansi" width="100" height="100"></canvas>

							</div>
							<div class="card-footer">
								<div class="legend">
									<i class="la la-circle text-primary"></i> Completed ({{ $slotTerisi }} / {{ $totalSlot }} slot terisi)
								</div>
							</div>
						</div>	
						</div>
						<script>
    const ctx = document.getElementById('pieChartOkupansi').getContext('2d');

    const pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Terisi', 'Kosong'],
            datasets: [{
                label: 'Okupansi Gudang',
                data: [{{ $slotTerisi }}, {{ $totalSlot - $slotTerisi }}],
                backgroundColor: ['#007bff', '#e0e0e0'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            let value = context.raw || 0;
                            let total = context.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>

								</div>




	<!-- Modal -->
	<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">									
					<p>Currently the pro version of the <b>Smart Warehouse</b> Bootstrap is in progress development</p>
					<p>
						<b>We'll let you know when it's done</b></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<script src="assets/js/demo.js"></script>
</html>