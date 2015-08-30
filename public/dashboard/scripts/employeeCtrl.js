/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('employeeCtrl', [])
    .controller('employeeController', function($scope, $http, Employee) {

        $scope.getAllDedDis = function(id){//return all data
        Employee.getAll(id).success(function(data){
            $scope.dudDiss = data.deduction;
            $scope.embDudDiss = data.empDeduction;
        })
    } ;
        $scope.storeEmpDud = function(empId){//return all data
        Employee.save(empId).success(function(data){

            Employee.getAll($scope.dudDis.empId).success(function(data){
                $scope.dudDiss = data.deduction;
                $scope.embDudDiss = data.empDeduction;
            })
            $scope.dudDis.val = "";
            $scope.dudDis.ds_id = "";
        })
    }


    });