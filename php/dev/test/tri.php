<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>
<body ng-controller="myController">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="entry in data">
                <td>{{ entry.id }} </td>
                <td>
                    <span ng-show="entry.name">{{ entry.name }}</span>
                    <select ng-show="!entry.name" ng-model="entry.newName">
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                    <button ng-show="!entry.name" ng-click="updateName(entry)">Submit</button>
                </td>
                <td>{{ entry.email }}</td>
            </tr>
            
        </tbody>
    </table>
    <script>
        var app = angular.module("myApp", []);

        app.controller("myController", function($scope, $http) {
    $scope.data = [];

    $http.get('getData.php').then(function(response) {
        $scope.data = response.data;
    });

    $scope.updateName = function(entry) {
        console.log("entry before update:", entry);
        var data = { id: entry.id, name: entry.newName };
        console.log("data before POST request:", data);

        $http.post('updateName.php', data).then(function(response) {
            if (response.data === "Name updated successfully") {
                entry.name = entry.newName;
            } else {
                alert("Error updating name: " + response.data);
            }
        }).catch(function(error) {
            alert("Error updating name: " + error.data);
        });
    };
});


    </script>
</body>
</html>
