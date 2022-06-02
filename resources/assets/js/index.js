angular.module('sqlModule', ['ngSanitize']).constant('API_URL', '/api');
angular.module('sqlModule').controller('SqlController', function($scope, $http, API_URL) {
    $scope.rdbmss = [];
    $scope.sql = null;
    $scope.log = null;
    $scope.loading = false;
    $scope.execute = function() {
        if ($scope.rdbmss.length && $scope.sql) {
            $scope.loading = true;
            $('html, body').animate({
                scrollTop: $("#log").offset().top
            }, 1000);
            $http({
                method: 'POST',
                url: API_URL + '/execute',
                data: {
                    rdbmss: $scope.rdbmss,
                    sql: $scope.sql
                }
            }).then(function(response) {
                $scope.loading = false;
                if (response.data.status == 'failed') {
                    $scope.log = `<p class='error-message'>Error in database "${response.data.error_in_database}" with message "${response.data.error_message}"</p>`;
                } else if (response.data.data) {
                    var tableBlock = '';
                    // foreach databases
                    for (const [database, data] of Object.entries(response.data.data)) {
                        tableBlock += `<div><b>${database}</b></div><table class="table table-sm table-bordered">`;
                        var thead = '<thead><tr>';
                        var theadCheck = true;
                        var tbody = `<tbody>`;
                        // foreach columns
                        data.forEach(function(item) {
                            tbody += '<tr>';
                            // foreach rows
                            for (const [row, value] of Object.entries(item)) {
                                if (theadCheck) {
                                    thead += `<th scope="col">${row}</th>`;
                                }
                                tbody += `<td>${value}</td>`; 
                            }
                            theadCheck = false;
                            tbody += '</tr>';
                        });
                        thead += '</tr></thead>';
                        tbody += '</tbody>';
                        tableBlock += thead + tbody + '</table>';
                    }
                    $scope.log = tableBlock;
                } else {
                    $scope.log = `Execute successfully!`
                }
            }, function(error) {
                $scope.loading = false;
                console.log(error);
            });
        }
    }
});
