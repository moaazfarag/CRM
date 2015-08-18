/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('accountCtrl', [])
    .controller('accountController', function($scope, $http, Account) {

        // object to hold all the data for the new comment form
        $scope.itemData = {};
        //$scope.account = {};
        $scope.value = "";
        $scope.addedAccounts = [
        ];
        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        Account.get()
            .success(function(data) {
                $scope.accounts = data.accounts;
                //$scope.users = data.users;
                $scope.loading = false;
            });


        //function to handle submitting the form
        $scope.submitItem = function() {
            $scope.loading = true;
            console.log($scope.form);

            // save the comment. pass in comment data from the form
            Account.save($scope.addedAccounts)
                .success(function(data) {
                    console.log($scope.form);
                    $scope.itemData = {};
                    //$scope.account = {};
                    $scope.value = "";
                    $scope.addedAccounts = [
                    ];

                })
                .error(function(data) {

                });
        };
            $scope.addAccount = function () {
            $scope.addedAccounts.push($scope.account);
            // Clear input fields after push
            $scope.account = "";
            $scope.form.$setUntouched();
            document.getElementById('account_id').focus();
                //foucus into item name after add
        };

        $scope.selectItem = function(accountName,accountId){
            $scope.account.name = accountName;
            $scope.account.id   = accountId;
        };
        $scope.displayOn = function(){
            console.log();
            $scope.prefs = false;
            document.getElementById('itemsView').style.display = '';
        };
        $scope.invoice_sub_total = function() {
            var total = 0.00;
            angular.forEach($scope.invoiceItems, function(item, key){
                total += (item.quantity * item.cost);
            });
            return total;
        }
        $scope.removeAccount =  function(item){
            $scope.addedAccounts.splice($scope.addedAccounts.indexOf(item), 1)
        };
        $scope.hasBalances =  function(){
            if( $scope.addedAccounts.length>0 ){
                return false;
            }else{
                return true;
            }

        };
        $scope.hassalance =  function(item){
            if( item  > 0 && $scope.account.name.length>0 ){
                return false;
            }else{
                return true;
            }

        };
        $scope.hasBalance =  function(){
            if(($scope.form.credit.$viewValue > 0 ||$scope.form.debit.$viewValue > 0) && $scope.account.id > 0){
                return false;
            }else{
                return true;
            }

        };
/*        $scope.pushItem = function() {
            //$scope.data =  JSON.parse(localStorage["data"]);
            $scope.data = [];
            //localStorage["data"]

            //console.log($scope.data.item.push({"item_name":$scope.itemData.item_name}));
            console.log($scope.data.push({item:$scope.itemData.item_name,sada:'sadd'}));
            console.log($scope.data);
            console.log(localStorage['itemData']);

        }*/

        // function to handle deleting a comment
        $scope.deleteItem = function(id) {
            $scope.loading = true;

            Item.destroy(id)
                .success(function(data) {

                    // if successful, we'll need to refresh the comment list
                    Item.get()
                        .success(function(getData) {
                            $scope.items = getData;
                            $scope.loading = false;
                        });

                });
        };

    });