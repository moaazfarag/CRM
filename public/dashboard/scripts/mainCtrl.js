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
        $scope.seletedAccount = {};
        $scope.accounts= {};
        // loading variable to show the spinning loading icon
        $scope.loading = true;
        $scope.returnInvoiceData = function(id){
            console.log('dsds');
            Item.getInvoiceById(id).success(function(data){

                $scope.invoiceData = data.invoices;
           })
        };
        $scope.getAccountsByType = function(){
            Item.getAccountsByType($scope.account).success(function (data) {
                $scope.accounts = data.accounts;
            })
                .error(function (data) {

                });

        };
        $scope.getAccountInfo = function(){
            Item.getAccountInfo($scope.account).success(function (data) {
                $scope.seletedAccount = data.selectedAccount;
            })
                .error(function (data) {

                });

        };
        // get all the comments first and bind it to the $scope.comments object
        Item.getItems()
            .success(function(data) {
                $scope.items = data.items;
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
            itemHasSerial =
            {
                id : $scope.item.id,
                item_name : $scope.item.item_name,
                unit : $scope.item.unit,
                supplier_id : $scope.item.supplier_id,
                buy : $scope.item.buy,
                sell_users : $scope.item.sell_users,
                sell_nos_gomla : $scope.item.sell_nos_gomla,
                sell_gomla : $scope.item.sell_gomla,
                sell_gomla_gomla : $scope.item.sell_gomla_gomla,
                limit : $scope.item.limit,
                avg_cost : $scope.item.avg_cost,
                has_serial : $scope.item.has_serial,
            }

            itemHasSerial.quantity = 1;

            if($scope.range == 'oneByone'){

                itemHasSerial.serial  = $scope.new.serial;
                itemHasSerial.has_serial   = 1;
                $scope.invoiceItems.push(itemHasSerial);
                // Clear input fields after push
                $scope.new.serial = "";
                //foucus into item name after add
                $('#serial').focus();
                itemHasSerial = {};

            }else if($scope.range == 'range'){

                for (i = $scope.new.form; i < $scope.new.to+1; i++) {
                    itemHasSerial =
                    {
                        id : $scope.item.id,
                        item_name : $scope.item.item_name,
                        unit : $scope.item.unit,
                        supplier_id : $scope.item.supplier_id,
                        buy : $scope.item.buy,
                        sell_users : $scope.item.sell_users,
                        sell_nos_gomla : $scope.item.sell_nos_gomla,
                        sell_gomla : $scope.item.sell_gomla,
                        sell_gomla_gomla : $scope.item.sell_gomla_gomla,
                        limit : $scope.item.limit,
                        avg_cost : $scope.item.avg_cost,
                        has_serial : $scope.item.has_serial,
                    }
                    itemHasSerial.quantity = 1;
                    itemHasSerial.serial  = $scope.new.prefix+''+i;
                    itemHasSerial.has_serial   = 1;
                    $scope.invoiceItems.push(itemHasSerial);
                    //itemHasSerial.id      = $scope.item.id;
                    //itemHasSerial.sell_users    = $scope.item.sell_users;
                    itemHasSerial = {};

                }
                $scope.new = "";
                $scope.finishAddItemHasSerial();
            }

        };
            $scope.finishAddItemHasSerial=function(){
            $('#item_id').focus();
        };
        $scope.selectItem = function(item){
            $scope.item         = item;
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
        $scope.hasSerialInvoiceItem = function(serial){
            if (serial == 0) {
                return true;
            }  else{
                return false;
            }
        };
        $scope.isRequired = function(serial){
            if (serial == 0) {
                return false;
            }  else{
                return true;
            }
        };
        $scope.displayOn = function(brId){
            console.log(brId);
            Item.getItems(brId)
                .success(function(data) {
                    $scope.items = data.items;
                    $scope.loading = false;
                });
            $scope.prefs = false;
            document.getElementById('itemsView').style.display = '';
        };
        $scope.invoice_sub_total = function() {
            var total = 0.00;
            angular.forEach($scope.invoiceItems, function(item, key){
                total += (item.quantity *  $scope.cost(item));
            });
            return total;
        }
        $scope.cost = function(item){
        if( $scope.seletedAccount.pricing ){
            if($scope.seletedAccount.pricing=="sell_users"){
                return item.sell_users;
            }else if($scope.seletedAccount.pricing=="sell_gomla" && item.sell_gomla>0 ){
                return item.sell_gomla;
            }else if($scope.seletedAccount.pricing=="sell_gomla_gomla" && item.sell_gomla_gomla>0 ){
                return item.sell_gomla_gomla;
            }else if($scope.seletedAccount.pricing=="sell_nos_gomla" && item.sell_nos_gomla>0 ){
                return item.sell_nos_gomla;
            }else{
                return item.sell_users;
            }
        }else{
            return item.sell_users;
        }
        };
        $scope.removeItem =  function(item){
            $scope.invoiceItems.splice($scope.invoiceItems.indexOf(item), 1)
        };
        $scope.hasInvoiceItems =  function(){
            if( $scope.invoiceItems.length>0  ){
                return false;
            }else{
                return true;
            }

        };
        $scope.hasItem =  function(item){
            if( item  > 0 && $scope.item.item_name.length>0 ){
                return false;
            }else{
                return true;
            }

        };
        $scope.hasItemBalance =  function(item){
            if( item  > 0 && $scope.item.item_name.length > 0){
                return false;
            }else{
                return true;
            }

        };
        $scope.isLimit =  function() {
            if ($scope.invoice_sub_total() > $scope.seletedAccount.acc_limit) {
                return " هذا العميل قد تخطى الحد المسموح به ";
            }else{
                return null;
            }
        };
        $scope.afterDiscount =  function() {

            if ($scope.discount) {
                return $scope.invoice_sub_total() - ($scope.invoice_sub_total()*($scope.discount/100));
            }else{
                return $scope.invoice_sub_total();
            }
        };
        $scope.clearItemForm =  function() {
            $scope.item = "";
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



    });