<?php $name = "Weather forecast"?>
<?php require_once("includes/core.inc.php");?>
<?php require_once("includes/header.php");?>
<?php
	$default_city = "nairobi";
	$default_country = "KE";
	$api_key = "80913c0dfc9f65044d08ba80dd508834";
	$api = "&APPID=" . $api_key;
	$city = $default_city;
	$country = $default_country;
	$url = "http://api.openweathermap.org/data/2.5/weather?q=" . $city . ",". $country . "&units=metric" . $api . "";
	if($weather_data = @file_get_contents($url)){
		$json = json_decode($weather_data, TRUE);
		if(isset($json)){
			if(!isset($json['main'])){
				echo "Location not found";
				require_once("includes/plain-footer.php");
				exit;
			}
			else{
				$name = $json['name'];
				$temp = $json['main']['temp'];
				$temp_min = $json['main']['temp_min'];
				$temp_max = $json['main']['temp_max'];
				$humidity = $json['main']['humidity'];
				$condition = $json['weather']['0']['description'];
				$wind_speed = $json['wind']['speed'];
				$wind_direction = $json['wind']['deg'];
				$icon = $json['weather'][0]['icon']; 
			}
		}
	}
	else{
		echo '<h2 class = "text-danger" style = "text-align:center">Failed to establish connection, please ensure you are online before checking the weather</h2>';
		require_once("includes/plain-footer.php");
		exit;
	}
	
	if(isset($_GET['search'])){
		if(isset($_GET['city']) && !empty($_GET['city'])){
			if(isset($_GET['country']) && !empty($_GET['country'])){
				$city = htmlentities($_GET['city']);
				$country = strtoupper(htmlentities($_GET['country']));
				$url = "http://api.openweathermap.org/data/2.5/weather?q=".$city."," . $country . "&units=metric" . $api . "";
				if($weather_data = @file_get_contents($url)){
					$json = json_decode($weather_data, TRUE);
					if(isset($json)){
						if(!isset($json['main'])){
							$msg =  "City <strong>$city, $country</strong> not found, loading reference city, <strong>$default_city, $default_country</strong>";
							$city = $default_city;
							$country = $default_country;
						}
						else{
							$name = $json['name'];
							$temp = $json['main']['temp'];
							$temp_min = $json['main']['temp_min'];
							$temp_max = $json['main']['temp_max'];
							$humidity = $json['main']['humidity'];
							$condition = $json['weather']['0']['description'];
							$wind_speed = $json['wind']['speed'];
							$wind_direction = $json['wind']['deg'];
							$icon = $json['weather'][0]['icon']; 
						}
					}
				}
				else{
					die("Failed to establish connection, please ensure you are online before using this feature");
				}
			}
			else{
				$msg =  "Please fill in the country before submitting";
			}
		}
		else{
			$msg =  "Please fill in the city before submitting";
		}
	}
	
?>
<div class = "container-fluid">
	<div class = "row" style = "">
		<img src = "images/cloudy.jpg" alt = "" class = "img-responsive" title = ""  style = "position:relative;margin-top:-60px;z-index:-20;" data-stellar-ratio = "0.10" />
	</div>
</div>
<div class = "container-fluid">
	<div class = "row px20top" style = "background-color:#fff;">
		<div class = "col-lg-12 center">
			<h1>GET THE WEATHER FORECAST RIGHT HERE</h1>
			<h4>ANALYZE THE WEATHER PATTERNS TO KNOW THE RIGHT TIMING FOR YOUR CROPS</h4>
			<div style = "width:50%; margin:0 auto;">
				<form class = "" action = "weather_forecast.php" method = "get">
					<input type = "text" class = "form-control" style = "width:80%;float:left;" value = "<?php echo $city;?>" name = "city" required placeholder = "city\town name"/>
					<input type = "text" class = "form-control" style = "width:18%;float:right;" value = "<?php echo $country;?>" name = "country" required placeholder = "country code"/>
					<button style = "margin-top:30px;" type = "submit" class = "btn btn-info" name = "search">Search</button>
				</form>
				
			</div>
			<?php if(isset($msg) && !empty($msg)){echo "<div style = \"width:100%;text-align:center;color:#fff;padding:30px;font-size:1.4em;margin:20px 0;\" class = \"bg-warning\">" .$msg . "</div>";}?>
		</div>
	</div>
</div>
<div class = "container-fluid" style = "background-color:#fff;">
	<div class = "container">
		<div class = "row px20top dark-light radius">
			<div style = "width:90%; margin:0 5%;">
				<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class = "space">
						<div class = "row">
							<h1 style = "width:85%;">Weather today, <strong><?php echo $name .", ". $country;?> </strong> <img style = "width:12%;float:right;padding:0px 1.5%;" class = "img-responsive" src = "http://openweathermap.org/img/w/<?php echo $icon . ".png";?>" /></h1>
							<h4>
								<table class = "table">
									<tr>
										<th>Weather condition</th>
										<td><?php echo $condition;?></td>
									</tr>
									<tr>
										<th>Feels like</th>
										<td><?php echo $temp;?> &deg; C</td>
									</tr>
									<tr>
										<th>High</th>
										<td><?php echo $temp_max;?> &deg; C</td>
									</tr>
									<tr>
										<th>Low</th>
										<td><?php echo $temp_min;?> &deg; C</td>
									</tr>
									<tr>
										<th>Humidity</th>
										<td><?php echo $humidity;?>%</td>
									</tr>
									<tr>
										<th>Wind speed</th>
										<td><?php echo $wind_speed;?> m/s</td>
									</tr>
									<tr>
										<th>Wind direction</th>
										<td><?php echo $wind_direction;?> degrees</td>
									</tr>
								</table>
							</h4>
						</div>
					</div>
					<div class = "space">
						<div class = "row">
							<h1>5 day forecast</h1>
							<div style = "color:#000;text-shadow:none;">
								<table class="display dataTable" cellspacing="0" width="100%" id = "weather">
									<thead>
										<tr>
											<th></th>
											<th>Date and time</th>
											<th>Condition</th>
											<th>Current</th>
											<th>High</th>
											<th>Low</th>
											<th>humidity</th>
											<th>Wind speed</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th></th>
											<th>Date and time</th>
											<th>Condition</th>
											<th>Current</th>
											<th>High</th>
											<th>Low</th>
											<th>humidity</th>
											<th>Wind speed</th>
										</tr>
									</tfoot>
									<tbody>
										<?php 
											$url = "http://api.openweathermap.org/data/2.5/forecast?q=". $city . "," . $country ."&mode=json&cnt=30&units=metric" . $api . "";
											if($data = @file_get_contents($url)){
												$json = json_decode($data, TRUE);
												
												foreach($json['list'] as $weather){
													echo "<tr>";
														echo "<td><img class = \"img-responsive\" src = \"http://openweathermap.org/img/w/". $weather['weather'][0]['icon'] .".png\" /></td>";
														echo "<td>".  check_date($weather['dt_txt']) . ", " . check_time($weather['dt_txt']) ."</td>";
														echo "<td>".$weather['weather'][0]['description'] ."</td>";
														echo "<td>".$weather['main']['temp'] ." &deg; C</td>";
														echo "<td>".$weather['main']['temp_max'] ." &deg; C</td>";
														echo "<td>".$weather['main']['temp_min'] ."&deg; C</td>";
														echo "<td>".$weather['main']['humidity'] ."%</td>";
														echo "<td class = \"hidden-xs\">".$weather['wind']['speed'] ." m/s</td>";
														
													echo "</tr>";
												}
										
											}
											else{
												echo "<tr>Connection failed</tr>";
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/footer.php");?>