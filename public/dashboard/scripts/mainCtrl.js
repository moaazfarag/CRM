/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('mainCtrl', [])

    .controller('mainController', function($scope, $http, Item) {
        // object to hold all the data for the new comment form
        $scope.itemData = {};
        $scope.invoiceItems = [];
        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        Item.get()
            .success(function(data) {
                $scope.items = data.items;
                $scope.users = data.users;
                console.log(data.users);
                $scope.loading = false;
            });


         //function to handle submitting the form
        $scope.submitItem = function() {
            $scope.loading = true;

            // save the comment. pass in comment data from the form
            Item.save($scope.invoiceItems)
                //console.log($scope.invoiceItems)
                .success(function(data) {
                    $scope.invoiceItems = {};
                    // if successful, we'll need to refresh the comment list
                    Item.get()
                        .success(function(getData) {
                            $scope.invoiceItems = getData;
                            $scope.loading = false;
                        });

                })
                .error(function(data) {

                });
        };
        $scope.addItem = function () {

            $scope.invoiceItems.push($scope.item);
            // Clear input fields after push
            $scope.item = "";
            //foucus into item name after add
            document.getElementById('item_id').focus();
        };
        $scope.invoice_sub_total = function() {
            var total = 0.00;
            angular.forEach($scope.invoiceItems, function(item, key){
                total += (item.quantity * item.cost);
            });
            return total;
        }
        $scope.removeItem =  function(item){
            $scope.invoiceItems.splice($scope.invoiceItems.indexOf(item), 1)
        };
        $scope.pushItem = function() {
            //$scope.data =  JSON.parse(localStorage["data"]);
            $scope.data = [];
            //localStorage["data"]

            //console.log($scope.data.item.push({"item_name":$scope.itemData.item_name}));
            console.log($scope.data.push({item:$scope.itemData.item_name,sada:'sadd'}));
            console.log($scope.data);
            console.log(localStorage['itemData']);

        }

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