<title>Dashboard</title>
<?php
	$admin 	= select("SELECT * FROM tb_admin");
	$ad 	= mysqli_num_rows($admin);
	$guru 	= select("SELECT * FROM tb_guru");
	$gr 	= mysqli_num_rows($guru);
	$siswa 	= select("SELECT * FROM tb_siswa");
	$sw 	= mysqli_num_rows($siswa);
?>
<div id="bgdash">
    <div id="bodash" class="clearfix">
        <div class="dashbox">
            <div class="dashimg">
                <i class="fa fa-user-plus"></i>
            </div>
            <div class="dashnum">
                <h2><?= $ad; ?></h2>
            </div>
            <div class="dashtit">
                <h3>Admin</h3>  
            </div>
        </div>
        <div class="dashbox">
            <div class="dashimg2">
                <i class="fa fa-user-tie"></i>
            </div>
            <div class="dashnum">
                <h2><?= $gr; ?></h2>
            </div>
            <div class="dashtit">
                <h3>Guru</h3>  
            </div>
        </div>
        <div class="dashbox">
            <div class="dashimg3">
            <i class="fa fa-users"></i>
            </div>
            <div class="dashnum">
                <h2><?= $sw; ?></h2>
            </div>
            <div class="dashtit">
                <h3>Siswa</h3>  
            </div>
        </div>
    </div>
</div>

<!-- chart -->
<div id="chart" class="clearfix">
    <div class="chartkiri">
        <div class="charttit">
            Penjualan
        </div>
        <div class="chartjs">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="chartkanan">
        <div class="charttit">
            Pembayaran
        </div>
        <div class="chartjs">
        <canvas id="myChart2"></canvas>
        </div>
    </div>
</div>
<script>
//deklarasi chartjs untuk membuat grafik 2d di id mychart 
var ctx = document.getElementById('myChart').getContext('2d');

var myChart = new Chart(ctx, {
 //chart akan ditampilkan sebagai bar chart
    type: 'bar',
    data: {
     //membuat label chart
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            //isi chart
            data: [12, 19, 3, 5, 2, 3],
            //membuat warna pada bar chart
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx = document.getElementById('myChart2').getContext('2d');

var myChart = new Chart(ctx, {
 //chart akan ditampilkan sebagai bar chart
    type: 'bar',
    data: {
     //membuat label chart
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            //isi chart
            data: [12, 19, 3, 5, 2, 3],
            //membuat warna pada bar chart
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>