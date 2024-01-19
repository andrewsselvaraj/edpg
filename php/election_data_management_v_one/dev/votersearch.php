<?php 

session_start();
if($_SESSION['login_election_user_name'])
{


include('election_db_connect/election_db_connect.php'); 

$query = "SELECT * FROM thiruvananthapuram";
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

    <title>Election Data | Voter Search</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>


<!--Navbar start -->
<?php include('includes/navbar.php'); ?>
<!-- Navbar end -->

<style>
/*
.badge {
  --bs-bg-opacity: 1;
  background-color: #2EC4B6;
}
*/
</style>
<style>
  /*  .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
    */
</style>

<body>
<!--div ng-show="loading" class="loader">
    <i class="fa fa-spinner fa-spin"></i> Loading...
</div-->

    <div class = "container">
    
    <div ng-app="myApp" ng-controller="myCtrl">
        <h2>Voter Search:</h2>
        <p>Logged in user: <b><font color="#D81159"><?php echo $_SESSION['login_election_user_name']; ?> </font></b> </p>
        <hr>
        <input type="text" ng-model="globalSearch" placeholder="Global Search" class="form-control">
        <p>Search Results: <span class="badge bg-primary"> {{ filteredUsers.length }}/{{ users.length }} </span></p>


        <!--
        <input type="text" ng-model="search.id_card_no" placeholder="Search ID">
        <input type="text" ng-model="search.name_english" placeholder="Search Name">
        <input type="text" ng-model="search.status" placeholder="Search status">
-->

       <a href="thiruvananthapuram_chart.php" class="btn btn-primary">Show Pie Chart</a> 
       <a href="thiruvananthapuram_bar_chart.php" class="btn btn-primary">Show Bar Chart</a>


        <div style="overflow-x:auto;">
        <table class="table table-hover">
            <thead>
            <tr>
                  <td><input type="text" ng-model="search.id_card_no" placeholder="Search ID"></td>
                  <td><input type="text" ng-model="search.name_english" placeholder="Search Name"></td>
                  <td><input type="text" ng-model="search.name_malayalam" placeholder="Search Name"></td>
                  <td><input type="text" ng-model="search.status" placeholder="Search Status"></td>
                  <td><input type="text" ng-model="search.age" placeholder="Search Age"></td>
                  <td><input type="text" ng-model="search.house_no_english" placeholder="Search House No."></td>
                  <td><input type="text" ng-model="search.house_no_malayalam" placeholder="Search House No."></td>
                  <td><input type="text" ng-model="search.serial_no" placeholder="Search Serial No."></td>
                  <td><input type="text" ng-model="search.assembly" placeholder="Search Assembly"></td>
                  <td><input type="text" ng-model="search.booth_in_malayalam" placeholder="Search Booth"></td>
                  <td><input type="text" ng-model="search.guardians_name_in_malayalam" placeholder="Search Guardian Name"></td>
                  <td><input type="text" ng-model="search.constituency_id" placeholder="Search Constituency ID"></td>
                  <td><input type="text" ng-model="search.booth_id" placeholder="Search Booth ID"></td>
                  <td><input type="text" ng-model="search.s_id" placeholder="Search S ID"></td>
                </tr>
                <tr>
                  <th>Id Card Number</th>
                  <th>Name in English</th>
                  <th>Name in Malayalam</th>
                  <th>Status</th>
                  <th>Age</th>
                  <th>House Number in English</th>
                  <th>House Number in Malayalam</th>
                  <th>Serial Number</th>
                  <th>Assembly</th>
                  <th>Booth in Malayalam</th>
                  <th>Guardians name in Malayalam</th>
                  <th>Constituency ID</th>
                  <th>Booth ID</th>
                  <th>S ID</th>
                  <th>Vote status</th>
                 
                </tr>
            </thead>
            <tbody>

            


            <tr ng-repeat="thiruvananthapuram in filteredUsers = (users | filter: globalSearch | filter: {id_card_no: search.id_card_no, name_english: search.name_english, name_malayalam: search.name_malayalam, status: search.status, age: search.age, house_no_english: search.house_no_english, house_no_malayalam: search.house_no_malayalam, serial_no: search.serial_no, assembly: search.assembly, booth_in_malayalam: search.booth_in_malayalam, guardians_name_in_malayalam: search.guardians_name_in_malayalam, constituency_id: search.constituency_id, booth_id: search.booth_id, s_id: search.s_id}) | startFrom:(currentPage-1)*pageSize | limitTo:pageSize">                  
                    <td>{{ thiruvananthapuram.election_id }} {{ thiruvananthapuram.id_card_no }}</td>
                    <td>{{ thiruvananthapuram.name_english }}</td>
                    <td>{{ thiruvananthapuram.name_malayalam }}</td>
                    <td>{{ thiruvananthapuram.status }}</td>
                    <td>{{ thiruvananthapuram.age }}</td>
                    <td>{{ thiruvananthapuram.house_no_english }}</td>
                    <td>{{ thiruvananthapuram.house_no_malayalam }}</td>
                    <td>{{ thiruvananthapuram.serial_no }}</td>
                    <td>{{ thiruvananthapuram.assembly }}</td>
                    <td>{{ thiruvananthapuram.booth_in_malayalam }}</td>
                    <td>{{ thiruvananthapuram.guardians_name_in_malayalam }}</td>
                    <td>{{ thiruvananthapuram.constituency_id }}</td>
                    <td>{{ thiruvananthapuram.booth_id }}</td>
                    <td>{{ thiruvananthapuram.s_id }}</td>
                    
                    <td>
                    <span ng-show="thiruvananthapuram.voted_status">{{ thiruvananthapuram.voted_status }}</span>
                    <select ng-show="!thiruvananthapuram.voted_status" ng-model="thiruvananthapuram.newVoteStatus" class="form-control">
                        <option value="Voted">Voted</option>
                        <option value="Not Voted">Not Voted</option>
                    </select>
                    <button ng-show="!thiruvananthapuram.voted_status" ng-click="updateVoteStatus(thiruvananthapuram)" class="btn btn-primary">Submit</button>
                </td>
                    


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

        app.controller('myCtrl', function($scope, $http) {
            //$scope.loading = false;
            $scope.currentPage = 1;
            $scope.pageSize = 10;
            $scope.users = <?php echo json_encode($data); ?>;
            $scope.loading = false;

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


/*
$scope.submitOption = function(user) {

                if (user.selectedOption) {
                    // Check if the user has already submitted
                    if (!user.submitted) {
                        // Store the selected option in the user object
                        user.submitted = true;

                        // Send an HTTP POST request to update the database
                        $http({
                            method: 'POST',
                            url: 'thiruvananthapuram_update.php',
                            data: { election_id: thiruvananthapuram.election_id, selectedOption: thiruvananthapuram.selectedOption }
                        }).then(function(response) {
                            console.log(response.data);
                        }, function(error) {
                            console.error(error);
                        });
                    }
                }
            };
*/

            $scope.updateVoteStatus = function(thiruvananthapuram) {
        console.log("entry before update:", thiruvananthapuram);
        var data = { election_id: thiruvananthapuram.election_id, voted_status: thiruvananthapuram.newVoteStatus };
        console.log("data before POST request:", data);

        $http.post('updateVoteStatus.php', data).then(function(response) {
            if (response.data === "Status updated successfully") {
                thiruvananthapuram.voted_status = thiruvananthapuram.newVoteStatus;
            } else {
                alert("Error updating status: " + response.data);
            }
        }).catch(function(error) {
            alert("Error updating status: " + error.data);
        });
    };

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