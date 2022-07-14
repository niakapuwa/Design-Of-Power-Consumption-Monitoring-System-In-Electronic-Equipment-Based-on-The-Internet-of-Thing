<?php
  session_start();
  require("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
  $sql = mysqli_query($connect, "SELECT * from kunci");
  $data = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>TA's Niken</title>
  <meta charset="utf-8" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <!-- <meta http-equiv="refresh" content="5"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <meta name="keywords" content="Monitoring TA Niken" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="css/font-awesome.css" rel="stylesheet"> 
  <script src="js/jquery-1.11.1.min.js"></script>
  <link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
  <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script> 
  <script type="text/javascript" src="https://code.highcharts.com/modules/series-label.js"></script> 
  <script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script> 
  <script type="text/javascript" src="https://code.highcharts.com/modules/export-data.js"></script> 
  <script type="text/javascript" src="https://code.highcharts.com/modules/accessibility.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<script>
    function ubahstatus(value)
    {
        if(value==true) value="ON";
        else value="OFF";
        document.getElementById('status').innerHTML = value;

        var xmlhtpp = new XMLHttpRequest();

        xmlhtpp.onreadystatechange = function()
        {
            if(xmlhtpp.readyState == 4 && xmlhtpp.status == 200)
            {
                document.getElementById('status').innerHTML = xmlhtpp.responseText;
            }
        }
        xmlhtpp.open("GET", "relay.php?stat=" + value, true);
        xmlhtpp.send();
        
    }

    function ubahstatus2(value)
    {
        if(value==true) value="ON";
        else value="OFF";
        document.getElementById('status2').innerHTML = value;

        var xmlhtpp = new XMLHttpRequest();

        xmlhtpp.onreadystatechange = function()
        {
            if(xmlhtpp.readyState == 4 && xmlhtpp.status == 200)
            {
                document.getElementById('status2').innerHTML = xmlhtpp.responseText;
            }
        }
        xmlhtpp.open("GET", "relay2.php?stat=" + value, true);
        xmlhtpp.send();
    }

    function ubahstatus3(value)
    {
        if(value==true) value="ON";
        else value="OFF";
        document.getElementById('status3').innerHTML = value;

        var xmlhtpp = new XMLHttpRequest();

        xmlhtpp.onreadystatechange = function()
        {
            if(xmlhtpp.readyState == 4 && xmlhtpp.status == 200)
            {
                document.getElementById('status3').innerHTML = xmlhtpp.responseText;
            }
        }
        xmlhtpp.open("GET", "relay3.php?stat=" + value, true);
        xmlhtpp.send();
    }
    
    function ubahstatus4(value)
    {
        if(value==true) value="ON";
        else value="OFF";
        document.getElementById('status4').innerHTML = value;

        var xmlhtpp = new XMLHttpRequest();

        xmlhtpp.onreadystatechange = function()
        {
            if(xmlhtpp.readyState == 4 && xmlhtpp.status == 200)
            {
                document.getElementById('status4').innerHTML = xmlhtpp.responseText;
            }
        }
        xmlhtpp.open("GET", "relay4.php?stat=" + value, true);
        xmlhtpp.send();
    } 
    </script>
</head>
<body>
    <style>
        .navigation {
          background: #ece88e;
        }
        #wntable {
          border-collapse: collapse;
          width: 50%;
        }

        #wntable td, #wntable th {
          border: 1px solid #ddd;
          padding: 8px;
        }
        #wntable tr:nth-child(even){background-color: #f2f2f2;}
        #wntable tr:hover {background-color: #ddd;}
        #wntable th {
          padding-top: 12px;
          padding-bottom: 12px;
          text-align: left;
          background-color: #00A8A9;
          color: white;
        }
        ul {
          list-style-type: none;  
          margin: 0;  
          padding: 0;  
          overflow: hidden; 
        }
        li a {
          display: inline-block;
          padding: 10px 20px;
        }
        .kanan > li > a {
          font-size: 18px;
          color: #00A8A9;
          float: left;
          margin-left: 8px;
        }
        li a:hover {
          background: #00A8A9;
          color: #ece88e;
          transition: 0.5s ease-in-out;
        }
        .bawah {
          background: #ece88e;
          padding: 15px 0;
          text-align: center;
          color: #00A8A9;
          bottom: 0;
          width: 100%;
          position: fixed;
        }
        #chart-container {
          width: 640px;
          height: auto;
        }
      </style>
<!-- navigation -->
<div class="navigation">
		<div class="container">
			<nav>
					<ul class="kanan">
						<li class="active"><a href="index.php" class="act">Home</a></li>
						<li><a href="control.php">Control</a></li>
						<li><a href="index.php">Tabel</a></li>
						<li><a href="index.php">Grafik</a></li>
						<li><a href="index.php">Biaya</a></li>
                    </ul>
    		</nav>
		</div>
</div>
<!-- control -->
<center>
  <br>
  <h1> Control </h1>
  <br>
<div class="container">
  <div class="card text-black col-3" style="max-width: 18 rem;">
    <div class="card-header" style="font-size:25px; text-align:center; background-color:#00A8A9; color:white;">Control 1</div>
    <div class="form-check form-switch" style="font-size: 30px;">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus(this.checked)" autocomplete="off">
    <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status">OFF</span></label>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="card text-black col-3" style="max-width: 18 rem;">
    <div class="card-header" style="font-size:25px; text-align:center; background-color:#00A8A9; color:white;">Control 2</div>
    <div class="form-check form-switch" style="font-size: 30px;">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus2(this.checked)" autocomplete="off">
    <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status2">OFF</span></label>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="card text-black col-3" style="max-width: 18 rem;">
    <div class="card-header" style="font-size:25px; text-align:center; background-color:#00A8A9; color:white;">Control 3</div>
    <div class="form-check form-switch" style="font-size: 30px;">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus3(this.checked)" autocomplete="off">
    <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status3">OFF</span></label>
    </div>
  </div>
</div>
<br>
<div class="container">
  <div class="card text-black col-3" style="max-width: 18 rem;">
    <div class="card-header" style="font-size:25px; text-align:center; background-color:#00A8A9; color:white;">Control 4</div>
    <div class="form-check form-switch" style="font-size: 30px;">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onchange="ubahstatus4(this.checked)" autocomplete="off">
    <label class="form-check-label" for="flexSwitchCheckDefault"> <span id="status4">OFF</span></label>
    </div>
  </div>
</div>
</center>
<br><br>
</body>
<footer class="bawah">
  <p>© 2022 Niken Wardhana. All rights reserved</p>
  </footer>
  </body>
</html>