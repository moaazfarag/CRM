/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('mainCtrl', [])

    .controller('mainController', function($scope, $http, Item) {
        // object to hold all the data for the new comment form
        $scope.itemData = {};
        //$scope.item = {};
        $scope.value = "";
        $scope.invoiceItems = [
        ];
        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        Item.get()
            .success(function(data) {
                $scope.items = data.items;
                $scope.users = data.users;
                $scope.loading = false;
            });


         //function to handle submitting the form
        //$scope.submitItem = function() {
        //    $scope.loading = true;
        //    console.log($scope.invoiceItems);
        //
        //    // save the comment. pass in comment data from the form
        //    Item.save($scope.invoiceItems)
        //        .success(function(data) {
        //            console.log($scope.invoiceItems);
        //
        //            $scope.invoiceItems = {};
        //             //if successful, we'll need to refresh the comment list
        //            Item.get()
        //                .success(function(getData) {
        //                    $scope.invoiceItems = getData;
        //                    $scope.loading = false;
        //                });
        //
        //        })
        //        .error(function(data) {
        //
        //        });
        //};
        $scope.addItem = function () {
            if($scope.item.has_serial){
            }else{
                $scope.invoiceItems.push($scope.item);
                // Clear input fields after push
                $scope.item = "";
                $scope.form.$setUntouched();
                //foucus into item name after add
                document.getElementById('item_id').focus();
            }
        };
        $scope.addItemHasSerial = function(quantity){
            itemHasSerial = {};
            itemHasSerial.quantity = 1;
            itemHasSerial.name = $scope.item.name;
            itemHasSerial.id   = $scope.item.id;
            itemHasSerial.serial  = $scope.new.serial;
            $scope.invoiceItems.push(itemHasSerial);
            // Clear input fields after push
            $scope.new.serial = "";
            //foucus into item name after add
            $('#serial').focus();
        };
            $scope.finishAddItemHasSerial=function(){
            $scope.item =  "";

        };
        $scope.selectItem = function(itemName,itemId,hasSerial){
            $scope.item.name         = itemName;
            $scope.item.id           = itemId;
            $scope.item.has_serial   = hasSerial;
            document.getElementById('quantity').focus();
            document.getElementById('itemsView').style.display = 'none';
        };
        $scope.hasSerial = function(serial){
            if (serial) {
                return false;
            }  else{
                return true
            }
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
        $scope.removeItem =  function(item){
            $scope.invoiceItems.splice($scope.invoiceItems.indexOf(item), 1)
        };
        $scope.hasInvoiceItems =  function(){
            if( $scope.invoiceItems.length>0 ){
                return false;
            }else{
                return true;
            }

        };
        $scope.hasItem =  function(item){
            if( item  > 0 && $scope.item.name.length>0 ){
                return false;
            }else{
                return true;
            }

        };
        $scope.hasItemBalance =  function(item){
            if( item  > 0 && $scope.item.name.length > 0){
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