<?php 

session_start();
if($_SESSION['login_election_user_name'])
{

include('election_db_connect/election_db_connect.php'); 


//$query = "SELECT * FROM cbe_mp_consituency_result_2019";
//$query = "SELECT cbe1.Election, cbe1.Constituency, cbe1.MP_AC, cbe1.State_AC, cbe1.Polling_Station_No, cbe1.Candidate_Name, cbe1.Party_Name, cbe1.No_of_Votes, cbe1.state_name, cbe1.MP_Constituency, cbe2.Polling_areas FROM cbe_mp_consituency_result_2019 cbe1 JOIN coimbatore_polling_areas cbe2 ON cbe1.Polling_Station_No = cbe2.Polling_Station_No LIMIT 40000";

$query = "SELECT cbe1.Election, cbe1.state_name, cbe1.MP_Constituency, cbe1.Constituency, cbe1.MP_AC, cbe1.State_AC, cbe1.Polling_Station_No, cbe1.Candidate_Name, cbe1.Party_Name, cbe1.No_of_Votes, cbe2.Polling_areas, cbe2.Election, cbe2.state_name, cbe2.MP_Constituency, cbe2.Constituency, cbe2.MP_AC, cbe2.State_AC, cbe2.Polling_Station_No, cbe1.Candidate_Name, cbe1.Party_Name, cbe1.No_of_Votes FROM cbe_mp_consituency_result_2019 cbe1 , coimbatore_polling_areas cbe2 where cbe1.Election = cbe2.Election AND cbe1.state_code = cbe2.state_code AND cbe1.MP_AC=cbe2.MP_AC AND cbe1.State_AC=cbe2.State_AC AND cbe1.state_name = cbe2.state_name AND cbe1.MP_Constituency = cbe2.MP_Constituency AND cbe1.Polling_Station_No = cbe2.Polling_Station_No ORDER BY cbe1.Constituency, cbe1.Polling_Station_No";

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

    <title>Election Data | Coimbatore</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap-tpls.min.js"></script>



    <style>
    div.card {

        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
    }


    div.container {
        padding: 10px;
    }

    .hidden-th {
        display: none;
    }
    </style>

</head>

<!--Navbar start -->
<?php include('includes/navbar.php'); ?>
<!-- Navbar end -->


<body>

    <div class="container">
        <div ng-app="myApp" ng-controller="myCtrl">
            <h2>Coimbatore:</h2>
            <p>Logged in user: <b>
                    <font color="#D81159"><?php echo $_SESSION['login_election_user_name']; ?> </font>
                </b> </p>

            <hr>

            <input type="text" ng-model="searchText" placeholder="Search" class="form-control">
            <p>Results: <span class="badge bg-primary"> {{ filteredUsers.length }}/{{ users.length }} </span></p>


            <a href="cbe_piechart.php" class="btn btn-primary">Show Pie Chart</a>
            <a href="#" class="btn btn-primary">Show Bar Chart</a>

            <br><br><br>
            <center>
                <div class="card">



                    <div class="container">
                        <div style="overflow-x:auto;">


                            <div class="row">
                                <div class="col-4">
                                    <input type="text" ng-model="search.Election" placeholder="Search Election"
                                        uib-typeahead="election for election in getUniqueValues('Election', $viewValue)"
                                        class="form-control">
                                </div>
                                <div class="col-4">

                                    <input type="text" ng-model="search.state_name" placeholder="Search State Name"
                                        uib-typeahead="election for election in getUniqueValues('state_name', $viewValue)"
                                        class="form-control">
                                </div>
                                <div class="col-4">
                                    <input type="text" ng-model="search.MP_Constituency"
                                        placeholder="Search MP Constituency"
                                        uib-typeahead="election for election in preloadedMPConstituencies | filter: $viewValue"
                                        class="form-control">
                                </div>
                            </div>
                            <br><br>

                            <div class="row">
                                <div class="col-4">


                                    <input type="text" ng-model="search.Constituency" placeholder="Search Constituency"
                                        uib-typeahead="election for election in preloadedConstituencies"
                                        ng-focus="loadUniqueValues('Constituency')" class="form-control">


                                </div>
                                <div class="col-4">

                                    <input type="text" ng-model="search.Polling_Station_No"
                                        placeholder="Search Polling Station No."
                                        uib-typeahead="election for election in getUniqueValues('Polling_Station_No', $viewValue)"
                                        class="form-control"><br><br>

                                </div>
                                <div class="col-4">
                                    <input type="text" ng-model="search.Polling_areas"
                                        placeholder="Search Polling areas"
                                        uib-typeahead="election for election in getUniqueValues('Polling_areas', $viewValue)"
                                        class="form-control"><br><br>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" ng-model="search.Candidate_Name"
                                        placeholder="Search Candidate Name"
                                        uib-typeahead="election for election in loadedElections"
                                        ng-focus="loadedElections = loadUniqueValues('Candidate_Name')"
                                        class="form-control"><br><br>

                                </div>
                                <div class="col-4">

                                    <input type="text" ng-model="search.Party_Name" placeholder="Search Party Name"
                                        uib-typeahead="election for election in getUniqueValues('Party_Name', $viewValue)"
                                        class="form-control">

                                </div>
                                <div class="col-4">

                                    <input type="text" ng-model="search.No_of_Votes" placeholder="Search No. of Votes"
                                        class="form-control"></br></br>

                                </div>
                            </div>
                            <!--div class="row">
    <div class="col-4">
                 <input type="text" ng-model="search.Election" placeholder="Search Election" class="form-control"> </br></br>
                
                 
    </div>
    <div class="col-4">
                 
                 <input type="text" ng-model="search.State_AC" placeholder="Search State_AC" class="form-control"></br></br>
                 
                 
    </div>
    <div class="col-4">
                
                 <input type="text" ng-model="search.MP_AC" placeholder="Search MP_AC" class="form-control"></br></br>
                 
    </div>
  </div-->


                        </div>
                    </div>
                </div>
            </center>

            <br><br><br>


            <div style="overflow-x:auto;">
                <table class="table table-hover">
                    <thead>
                        <!--tr>
                  <td><input type="text" ng-model="search.Election" placeholder="Search Election"></td>
                  <td><input type="text" ng-model="search.Constituency" placeholder="Search Constituency"></td>
                  <td><input type="text" ng-model="search.MP_AC" placeholder="Search MP_AC"></td>
                  <td><input type="text" ng-model="search.State_AC" placeholder="Search State_AC"></td>
                  <td><input type="text" ng-model="search.Polling_Station_No" placeholder="Search Polling_Station_No"></td>
                  <td><input type="text" ng-model="search.Polling_areas" placeholder="Search Polling_areas"></td>
                  <td><input type="text" ng-model="search.Candidate_Name" placeholder="Search Candidate_Name"></td>
                  <td><input type="text" ng-model="search.Party_Name" placeholder="Search Party_Name"></td>
                  <td><input type="text" ng-model="search.No_of_Votes" placeholder="Search No_of_Votes"></td>
                </tr-->
                        <tr>
                            <th>Election</th>
                            <th>State</th>
                            <th>MP Constituency</th>
                            <th>Constituency</th>
                            <!--th>MP AC</th>
                  <th>State AC</th-->
                            <th>Polling Station Number</th>
                            <th>Polling Areas</th>
                            <th>Candidate Name</th>
                            <th>Party Name</th>
                            <th>Number of votes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--tr ng-repeat="coimbatore in filteredUsers = (users | filter: searchText) | startFrom:(currentPage-1)*pageSize | limitTo:pageSize"-->
                        <tr
                            ng-repeat="coimbatore in filteredUsers = (users | filter: globalSearch | filter: {Election: search.Election, state_name: search.state_name, MP_Constituency: search.MP_Constituency, Constituency: search.Constituency, MP_AC: search.MP_AC, State_AC: search.State_AC, Polling_Station_No: search.Polling_Station_No, Polling_areas: search.Polling_areas, Candidate_Name: search.Candidate_Name, Party_Name: search.Party_Name, No_of_Votes: search.No_of_Votes}) | startFrom:(currentPage-1)*pageSize | limitTo:pageSize">

                            <td>{{ coimbatore.Election }}</td>
                            <td> {{ coimbatore.state_name }} </td>
                            <td>{{ coimbatore.MP_Constituency }} </td>
                            <td>{{ coimbatore.Constituency }}</td>
                            <!--td>{{ coimbatore.MP_AC }}</td>
                    <td>{{ coimbatore.State_AC }}</td-->
                            <td>{{ coimbatore.Polling_Station_No }}</td>
                            <td>{{ coimbatore.Polling_areas }}</td>
                            <td>{{ coimbatore.Candidate_Name }}</td>
                            <td>{{ coimbatore.Party_Name }}</td>
                            <td>{{ coimbatore.No_of_Votes }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <button ng-disabled="currentPage == 1" ng-click="prevPage()" class="btn btn-primary">Previous</button>
                <span>Page {{currentPage}} of {{ numberOfPages() }}</span>
                <button ng-disabled="currentPage >= numberOfPages()" ng-click="nextPage()"
                    class="btn btn-primary">Next</button>
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






    <script>
    var app = angular.module('myApp', ['ui.bootstrap']);
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
        $scope.preloadedConstituencies = [
            "Coimbatore (North)",
            "Coimbatore (South)",
            "Kavundampalayam",
            "Sulur",
            "Palladam",
            "Singanallur"
        ]

        console.log('users', $scope.users);

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

        $scope.getUniqueValues = function(propertyName, val) {
            let uniqueValues = new Set();
            $scope.users.forEach(user => {
                if (user[propertyName] && user[propertyName].toLowerCase().includes(val
                        .toLowerCase())) {
                    uniqueValues.add(user[propertyName]);
                }
            });
            return Array.from(uniqueValues);
        };

        $scope.loadUniqueValues = function(propertyName) {
            let uniqueValues = new Set();
            $scope.users.forEach(user => {
                if (user[propertyName]) {
                    uniqueValues.add(user[propertyName]);
                }
            });
            return Array.from(uniqueValues);
        };
        // Preload data for typeahead
        // $scope.preloadedElections = $scope.loadUniqueValues('Election');
        // $scope.preloadedStateNames = $scope.loadUniqueValues('state_name');
        $scope.preloadedMPConstituencies = $scope.loadUniqueValues('MP_Constituency');
        $scope.preloadedConstituencies = [
            "Coimbatore (North)",
            "Coimbatore (South)",
            "Kavundampalayam",
            "Sulur",
            "Palladam",
            "Singanallur"
        ]
        console.log($scope.preloadedConstituencies)
        // ... other preloads


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