<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Atomic time</title>
	<script src="jquery-3.4.1.min.js"></script>
	<style>
		#wrapper {
			width: 50%;
			margin: 0 auto;
			border: 1px solid black;
			text-align: center;
		}
		#UTCtime, #Atomictime {
			font-size: 50px;
		}
		h2 {
			color: red;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<h2>Coordinated Universal Time (UTC)</h2>
		<p id="UTCtime"></p>
		<h2>International Atomic Time (TAI)</h2>
		<span>Currently 37 seconds ahead of UTC</span>
		<p id="Atomictime"></p>
	</div>
	

	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(UTCtime, 1000);
			setInterval(Atomictime, 100);
		});
		function addZero(i) {
			if (i < 10) {
				return "0" + i;
			}
			return i;
		}
		function UTCtime() {
			$.ajax({
				url: 'http://localhost/-Challenge-Web-GetAtomicTimeFromInternetClock-/UTCtime.php',
				success: function(data) {
					$('#UTCtime').html(data);
				},
			});
		}
		function Atomictime() {
			$.ajax({
				url: 'http://localhost/-Challenge-Web-GetAtomicTimeFromInternetClock-/index.php',
				success: function(){
					
					var time = $('#UTCtime').text();
					var iSODate = time.split(" ");
					var d = new Date(time);
					var myDate = new Date(iSODate);
					var month = myDate.getMonth();
					var day = myDate.getDate();
					var year = myDate.getFullYear();
					var h = d.getHours();
					var m = d.getMinutes();
					var s = d.getSeconds();
					var s_copy = s + 37;
					if (s >= 23) {
						s_copy = 37 - (60 - s);
						m++;
						if (m > 59) {
							h++;
							m=0;
						}
					}
					
					$('#Atomictime').html(addZero(month+1) + "-" + addZero(day) +"-"+year+ " "+addZero(h) +":"+ addZero(m) +":"+ addZero(s_copy));
				},
			});
		}
	</script>
</body>
</html>





