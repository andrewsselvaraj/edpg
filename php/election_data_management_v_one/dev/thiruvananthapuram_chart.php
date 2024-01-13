<?php
session_start();
if($_SESSION['login_election_user_name'])
{

?>
<!DOCTYPE html>
<html ng-app="myApp">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<!--Navbar start -->
<?php include('includes/navbar.php'); ?>
<!-- Navbar end -->
<body ng-controller="myController">
    <div class="container">
<h2>Thiruvananthapuram: </h2>
<p>Logged in user: <b><font color="#D81159"><?php echo $_SESSION['login_election_user_name']; ?> </font></b> </p>
<span class="badge bg-primary">Pie Chart</span>
<hr>
<a href="thiruvanandhapuram.php" class="btn btn-primary">Go back</a> 
<a href="thiruvananthapuram_bar_chart.php" class="btn btn-primary">Show Bar Chart</a>
        <br />
    <div class="chart-container">
        <canvas id="myPieChart" width="400" height="400"></canvas>
    </div>
</div>
    <script>
        var app = angular.module("myApp", []);

        app.controller("myController", function ($scope, $http) {
            $scope.labels = ['Voted', 'Not Voted', 'Empty']; 
            $scope.data = [0, 0, 0];  

           
            $http.get('getPieChartData.php').then(function (response) {
               
                console.log("Raw Data: ", response.data);
                response.data.forEach(function (item) {
                    if (item.voted_status === "Voted") {
                        $scope.data[0]++;
                    } else if (item.voted_status === "Not Voted") {
                        $scope.data[1]++;
                    } else if (item.voted_status === "") {
                        $scope.data[2]++;
                    }
                });

                console.log("Labels: ", $scope.labels);
                console.log("Data: ", $scope.data);

                // Create the pie chart
                var ctx = document.getElementById('myPieChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: $scope.labels,
                        datasets: [{
                            data: $scope.data,
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                            ],
                            borderColor: [
                                'rgba(75, 192, 192, 1)',
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                            ],
                        }]
                    },
                    options: {
                            responsive: true, 
                            maintainAspectRatio: false 
                        }
                });
            });
        });
    </script>

   

<style>
        .chart-container {
            width: 100%;
            max-width: 600px; /* You can adjust the maximum width as needed */
            margin: 0 auto;
        }
    </style>

</body>
</html>


<?php

//end
}
else
{
   
    echo "<h1>Redirecting...Please wait..!</h1>";
    echo "<script> alert('Please login to continue..!')</script>";
    echo "<script> location.href='index.php'</script>";
}
?>