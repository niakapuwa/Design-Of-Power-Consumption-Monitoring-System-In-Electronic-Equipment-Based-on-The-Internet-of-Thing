<?php
  session_start();
  require("koneksi.php"); // memanggil file koneksi.php untuk koneksi ke database
  // $sql = mysqli_query($connect, "SELECT * from kunci");
  // $data = mysqli_fetch_array($sql);
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
  <script type="text/javascript" src="js/graph.js"></script>
  
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
          position: fixed;
          width: 100%;
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
									<li><a href="#tabel">Tabel</a></li>
									<li><a href="#grafik">Grafik</a></li>
									<li><a href="#biaya">Biaya</a></li>
                </ul>
							</nav>
			</div>
		</div>
  <br> <br>
  <div id="tabel" class="cards" align="center">
    <h1> Data Sensor</h1>
    <div id="link_wrapper">
    </div>
  </div>
  <br> <br>
  <!-- grafik energi-->
    <div id="grafik" style="width: auto; height: auto">
        <canvas id="grafikChart"></canvas>
    </div>
    <br> <br>
    <!-- biaya-->
    <!-- <div id="garis" style="min-width: 10px; height:20px; margin: 0 auto;"></div>-->
    <div id="biaya">
      <center>
        <br> <br>
        <h4>BIAYA KWH/BULAN</h4></center>
        <br>
      <div id="tabel" class="cards" align="center">
        <table id="wntable">
         <tr>
           <th>Total Pemakaian</th>
           <th>Harga/KWH</th>
           <th>Total Biaya</th>
         </tr>
        <?php
          $sql = mysqli_query($connect, "SELECT * FROM datapzem ORDER BY id DESC LIMIT 1");
          $biaya = 1350;
          $total = 0;
          $total_bayar = 0;
           while($row = mysqli_fetch_assoc($sql)){ // fetch query yang sesuai ke dalam array
            $total = $biaya * $row['energy'];
            $total_bayar += $total;
            echo '
            <tr>
              <td>'.$row['energy'].'</td>
              <td>'.$biaya.'</td>
              <td>'.$total_bayar.'</td>
            </tr>
            ';
           }
        ?>
        </table>
        <br> <br>
    </div>
    </div>
    <br>
    <!-- grafik energi-->
    <script type="text/javascript"> 
        $(document).ready(function () {
                        showGraph();
                    });

                    function showGraph()
                    {
                        {
                            $.post("data.php",
                            function (data)
                            {
                                console.log(data);
                                var energy = [];
                                var time = [];

                                for (var i in data) {
                                    time.push(data[i].time);
                                    energy.push(data[i].energy);
                                }

                                var chartdata = {
                                    labels: time,
                                    datasets: [
                                    {
                                        label: 'Grafik Pemakaian Listrik (kWh)',
                                        borderColor: '#eda81f',
                                        backgroundColor: '#edd577',
                                        hoverBorderColor: '#666666',
                                        hoverBackgroundColor: '#CCCCCC',
                                        data: energy
                                    }
                                    ]
                                };

                                var graphTarget = $("#grafikChart");

                                var barGraph = new Chart(graphTarget, {
                                    type: 'line',
                                    data: chartdata,
                                    options: {
                                        scales: {
                                            y: {
                                                ticks: {
                                                  callback: function(value, index, values){
                                                        return 'Rp' + value;
                                                    } 
                                                }
                                            }
                                        }
                                    }
                                });
                            });
                        }
                        setInterval(function(){
                          showGraph();
                        }, 2000)
                    } 
    </script>
  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function loadXMLDoc(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       document.getElementById("link_wrapper").innerHTML = xhttp.responseText;
        }
      };
    xhttp.open("GET", "server.php", true);
    xhttp.send();
    }
    setInterval(function(){
      loadXMLDoc();
    }, 2000)
    window.onload = loadXMLDoc;
  </script>
  <footer class="bawah">
  <p>© 2022 Niken Wardhana. All rights reserved</p>
  </footer>
  </body>
</html>