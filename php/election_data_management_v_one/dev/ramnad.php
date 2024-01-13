<?php 

session_start();
if($_SESSION['login_election_user_name'])
{

include('election_db_connect/election_db_connect.php'); 


$query = "SELECT * FROM ramanathapuram";
$result = $conn->query($query);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">

    <title>Election Data | Ramnad</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<!--Navbar start -->
<?php include('includes/navbar.php'); ?>
<!-- Navbar end -->


<body>
    
    <div class = "container">
    <div ng-app="myApp" ng-controller="myCtrl">
        <h2>Ramanad:</h2>
        <p>Logged in user: <b><font color="#D81159"><?php echo $_SESSION['login_election_user_name']; ?> </font></b> </p>
        
        <hr>
    
        <input type="text" ng-model="searchText" placeholder="Search" class="form-control">
        <p>Results: <span class="badge bg-primary"> {{ filteredUsers.length }}/{{ users.length }} </span></p>
        <div style="overflow-x:auto;">
        <table class="table table-hover">
            <thead>
                <tr>
                  <th>Election</th>
                  <th>Constituency</th>
                  <th>Polling Station Number</th>
                  <th>Candidate Name</th>
                  <th>Party Name</th>
                  <th>Number of votes</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="ramanathapuram in filteredUsers = (users | filter: searchText) | startFrom:(currentPage-1)*pageSize | limitTo:pageSize">
                  
                    <td>{{ ramanathapuram.election }}</td>
                    <td>{{ ramanathapuram.constituency }}</td>
                    <td>{{ ramanathapuram.polling_station_no }}</td>
                    <td>{{ ramanathapuram.candidate_name }}</td>
                    <td>{{ ramanathapuram.party_name }}</td>
                    <td>{{ ramanathapuram.no_of_votes }}</td>
                </tr>
            </tbody>
        </table>
</div>
        <div>
            <button ng-disabled="currentPage == 1" ng-click="prevPage()" class="btn btn-primary">Previous</button>
            <span>Page {{currentPage}} of {{ numberOfPages() }}</span>
            <button ng-disabled="currentPage >= numberOfPages()" ng-click="nextPage()" class="btn btn-primary">Next</button>
        </div>
    </div>

<!--
    <div>
    <ul class="pagination">
        <li ng-repeat="page in pages" ng-class="{ active: page === currentPage }">
            <a ng-click="setPage(page)">{{ page }}</a>
        </li>
    </ul>
</div>
-->

</div>

<!--footer start -->

<!--footer end -->

    <script>
        var app = angular.module('myApp', []);
        app.filter('startFrom', function() {
            return function(input, start) {
                start = +start;
                return input.slice(start);
            }
        });

        app.controller('myCtrl', function($scope) {
            $scope.currentPage = 1;
            $scope.pageSize = 10;
            $scope.users = <?php echo json_encode($data); ?>;

            $scope.numberOfPages = function() {
                return Math.ceil($scope.filteredUsers.length / $scope.pageSize);
            };

            $scope.prevPage = function() {
                if ($scope.currentPage > 1) {
                    $scope.currentPage--;
                }
            };

            $scope.nextPage = function() {
                if ($scope.currentPage < $scope.numberOfPages()) {
                    $scope.currentPage++;
                }
            };


/*pagination(page number)
            $scope.generatePageNumbers = function() {
        $scope.pages = [];
        for (var i = 1; i <= $scope.numberOfPages(); i++) {
            $scope.pages.push(i);
        }
    };

    $scope.setPage = function(page) {
        if (page >= 1 && page <= $scope.numberOfPages()) {
            $scope.currentPage = page;
        }
    };

    $scope.generatePageNumbers();
*/
        });
    </script>
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