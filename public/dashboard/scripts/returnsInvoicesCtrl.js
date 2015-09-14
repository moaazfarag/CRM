/**
 * Created by ahmed on 9/8/2015.
 */
angular.module("invoicesCtrl",[])
    .controller("invoicesController",function($scope,$http,ReturnsInvoice) {
        $scope.getAllinvoices = function(id){//return all data
            Employee.getAll(id).success(function(data){
                $scope.returnsInvoice = data.invoices;
            })
            };
        $scope.storeReInvoice = function(id){//return all data
            ReturnsInvoice.save(id).success(function(data){
                ReturnsInvoice.getAll($scope.returnsInvoice.id).success(function(data){
                    $scope.returnsInvoice = data.invoices;

                });
                $scope.returnsInvoice.invoice_no = "";
                $scope.returnsInvoice.qty = "";
                $scope.returnsInvoice.unit_price = "";
                $scope.returnsInvoice.serial_no = "";
            });
        };
});
