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
        $scope.date = Date();
        $scope.header={}
        $scope.invoice={}
        $scope.seletedAccount = {};
        $scope.accounts= {};
        $scope.transType= "";
        // loading variable to show the spinning loading icon
        $scope.loading = true;
        //$scope.returnInvoiceData = function(id){
        //    Item.getInvoiceById(id).success(function(data){
        //
        //        $scope.invoiceData = data.invoices;
        //   })
        //};
        $scope.getAccountsByType = function(){
            Item.getAccountsByType($scope.account).success(function (data) {
                $scope.accounts = data.accounts;
            })
                .error(function (data) {
                });
        };
        $scope.backItem = function(){
            $scope.backItems = [];
            angular.forEach($scope.invoiceItems,function(item,key){
                if (item.return > 0) {
                    $scope.backItems.push(item) ;
                }
            });
            return $scope.backItems;

        };
        $scope.invoiceData = function(type,brId){
           $scope.invoice.invoiceType = type ;
           $scope.invoice.brId        = brId ;
            Item.getInvoiceById($scope.invoice).success(function (data) {
                $scope.invoiceItems = data.details;
                $scope.header = data.header;
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
        //Item.getItems()
        //    .success(function(data) {
        //        $scope.items = data.items;
        //        $scope.loading = false;
        //    });


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
        $scope.resetInvoiceItems = function () {
            $scope.invoiceItems = [];
        };
        $scope.discountItemHasSerial = function(quantity){
            $scope.serialError = null;
            $scope.serialInInvoiceError = null;
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
                balance : 1,
            }

            itemHasSerial.quantity = 1;

            if($scope.range == 'oneByone'){
                if($scope.inArray($scope.new.serial,$scope.serials)){
                    itemHasSerial.serial  = $scope.new.serial;
                    itemHasSerial.has_serial   = 1;
                    $scope.invoiceItems.push(itemHasSerial);
                    // Clear input fields after push
                    $scope.new.serial = "";
                    //foucus into item name after add
                    $('#serial').focus();
                    itemHasSerial = {};
                }else{
                    if($scope.inArray($scope.new.serial,$scope.serialInItemInInvoice($scope.item.id))){
                        $scope.serialInInvoiceError = "1";
                    }else{
                        $scope.serialError = "1";
                    }
                }


            }else if($scope.range == 'range'){
                $scope.unselectedSerialOfItem($scope.item.id);
                var  count = 0 ;
                for (i = $scope.new.form; i < $scope.new.to+1; i++) {
                    if($scope.inArray($scope.new.prefix+''+i,$scope.serials)){
                        count++
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
                            balance : 1,
                        }
                        itemHasSerial.quantity = 1;
                        itemHasSerial.serial  = $scope.new.prefix+''+i;
                        itemHasSerial.has_serial   = 1;
                        $scope.invoiceItems.push(itemHasSerial);
                        itemHasSerial = {};
                    }

                }
                $scope.all =  ($scope.new.to+1)- $scope.new.form ;
                $scope.added = count;
                $scope.new = "";
                $scope.finishAddItemHasSerial();
            }

        };
        $scope.addItemHasSerial = function(quantity){
            $scope.serialError = null;
            $scope.serialInInvoiceError = null;
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
                balance : 1,
                cost : $scope.item.cost,
            }

            itemHasSerial.quantity = 1;

            if($scope.range == 'oneByone'){
                console.log($scope.inArray($scope.new.serial,$scope.serials))
                if($scope.inArray($scope.new.serial,$scope.serials) || $scope.inArray($scope.new.serial,$scope.serialInItemInInvoice($scope.item.id))){
                    if($scope.inArray($scope.new.serial,$scope.serialInItemInInvoice($scope.item.id))){
                        $scope.serialInInvoiceError = "1";
                    }else{
                        $scope.serialError = "1";
                    }
                }else{
                    itemHasSerial.serial  = $scope.new.serial;
                    itemHasSerial.has_serial   = 1;
                    $scope.invoiceItems.push(itemHasSerial);
                    // Clear input fields after push
                    $scope.new.serial = "";
                    //foucus into item name after add
                    $('#serial').focus();
                    itemHasSerial = {};
                }


            }else if($scope.range == 'range'){
                $scope.unselectedSerialOfItem($scope.item.id);
                var  count = 0 ;
                console.log($scope.inArray($scope.new.serial,$scope.serials))
                for (i = $scope.new.form; i < $scope.new.to+1; i++) {
                    if(!$scope.inArray($scope.new.prefix+''+i,$scope.serials)){
                        count++
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
                            cost : $scope.item.cost,
                            balance : 1,
                        }
                        itemHasSerial.quantity = 1;
                        itemHasSerial.serial  = $scope.new.prefix+''+i;
                        itemHasSerial.has_serial   = 1;
                        $scope.invoiceItems.push(itemHasSerial);
                        itemHasSerial = {};
                    }

                }
                $scope.all =  ($scope.new.to+1)- $scope.new.form ;
                $scope.added = count;
                $scope.new = "";
                $scope.finishAddItemHasSerial();
            }

        };
            $scope.finishAddItemHasSerial=function(){
            $('#item_id').focus();
        };
        $scope.selectItem = function(item){
            usedIds = $scope.isHasItemInInvoice();
            if($scope.inArray(item.id,usedIds) && item.has_serial != 1)
            {
                document.getElementById(item.id+"div").innerHTML = "قم بزيادة العددمن هنا";
                document.getElementById(item.id).focus();
            }else{
                $scope.item         = item;
                document.getElementById('quantity').focus();
                document.getElementById('itemsView').style.display = 'none';
            }

        };
        $scope.invoiceItemBalance = function(invoiceItem){
            if(invoiceItem.balance < invoiceItem.quantity){
                return true;
            }else{
                return false;
            }
        }
        $scope.inArray = function (needle, haystack) {
            var length = haystack.length;
            for(var i = 0; i < length; i++) {
                if(haystack[i] == needle) return true;
            }
            return false;
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
            branch = {};
            branch.br_id = brId;
            Item.getItems(branch)
                .success(function(data) {
                    $scope.items = data.items;
                    $scope.loading = false;
                });
            $scope.prefs = false;
            document.getElementById('itemsView').style.display = '';
        };
        $scope.serialItem = function(brId,itemId){
            info = {};
            info.br_id = brId;
            info.item_id = itemId;
            Item.getSerialItem(info)
                .success(function(data) {
                    $scope.serialItems = data.items;
                    $scope.loading = false;
                });
            $scope.unselectedSerialOfItem();
            $scope.prefs = false;
        };
        $scope.unselectedSerialOfItem = function(){
            $scope.serials=[];
            item = $scope.item;
            angular.forEach($scope.serialItems,function(item,key){
                $scope.serials[key] = item.serial_no ;
            });
            $scope.serials = $scope.serials.filter( function ( elem ) {
                return  $scope.serialInItemInInvoice(item.id).indexOf( elem ) === -1;
            });
            return $scope.serials;
        };
        $scope.itemBalance = function(){
            if($scope.item) {
                //console.log($scope.item.balance);
                if ($scope.item.balance == undefined) {
                    return true;
                }else{
                    if($scope.item.balance <= 0 ){
                        return true ;
                    }else if (($scope.item.balance - $scope.item.quantity) <0){
                        return true ;
                    }
                }
            }

        };
        $scope.displayOnAllItem = function(){
            Item.getCoItem()
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
        };
        $scope.returnInvoiceTotal = function() {
            var total = 0.00;
            angular.forEach($scope.invoiceItems, function(item, key){
                if(item.return>0){
                    total += (item.return *  item.unit_price);
                }
            });
            return total;
        };

        $scope.cost = function(item){
            if(item.cost > 0){
                return item.cost;
            }else{
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
        $scope.isHasItemInInvoice = function(){
            ids = [];
            angular.forEach($scope.invoiceItems, function(item, key){
                ids[key] = item.id;
            });
            return ids;
        };
        $scope.serialInItemInInvoice = function(itemId){
            invoiceSerial = [];
            angular.forEach($scope.invoiceItems, function(item, key){
                if(item.id == itemId){
                    invoiceSerial[key] = item.serial ;
                }
            });
            return invoiceSerial;
        };
        $scope.hasItem =  function(){
            item = [];
            item =  $scope.item;
            if( item.quantity  > 0 && item.item_name.length>0  && item.id>0){
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
        $scope.afterDiscountReturn =  function() {

            if ($scope.header.discount ) {
                return $scope.returnInvoiceTotal() - ($scope.returnInvoiceTotal()*(Math.round( $scope.header.discount )/100));
            }else{
                return $scope.returnInvoiceTotal();
            }
        };
        $scope.clearItemForm =  function() {
            $scope.item    = "" ;
            $scope.all     = "" ;
            $scope.serials = [] ;
            $scope.added   = "" ;
        };
        $scope.returnBalance  =  function(invoiceItem) {
            //console.log(invoiceItem.has_serial)
            if(invoiceItem.has_serial){
                return 1 ;
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



    });