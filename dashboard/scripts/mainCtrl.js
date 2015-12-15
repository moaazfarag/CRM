/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('mainCtrl', [])

    .controller('mainController', function($scope, $sce, $q ,Item) {
        // object to hold all the data for the new comment form
        $scope.itemData = {};
        //$scope.item = {};
        $scope.value = "";
        $scope.custom = true;
        $scope.invoiceItems = [
        ];
        classes = [];

        //$scope.date = Date();
        $scope.header={}
        $scope.invoice={}
        $scope.seletedAccount = {};
        $scope.accounts= {};
        $scope.transType= "";
        $scope.account = 0;
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
        $scope.dirty = {};


        function suggest_users(term) {
            var q = term.toLowerCase().trim(),
                results = [];

            for (var i = 0; i < $scope.items.length; i++) {
                var item = $scope.items[i];
                catName = item.cat_name;
//console.log( item.item_name.toLowerCase())
                if (item.item_name.toLowerCase().indexOf(q) !== -1 ||
                    item.bar_code.toString().toLowerCase().indexOf(q) !== -1 ||
                    item.cat_name.toLowerCase().indexOf(q) !== -1)
                    results.push({
                        value: item.item_name,
                        // Pass the object as well. Can be any property name.
                        obj: item,
                        label: $sce.trustAsHtml(
                            ' <div style="padding-right: 3px;" class="col-xs-5">' +
                            '  <strong>' + item.item_name + '</strong>'+
                            '  <small>' + item.cat_name + '</small>' +
                            '</div>'
                        )
                    });
            }
            return results;
        };

        $scope.ac_options_users = {
            suggest: suggest_users,
            on_select: function (selected) {
                $scope.dirty.continent = selected.obj.item_name;
                $scope.selectItem(selected.obj);
            }
        };
        $scope.onKeyEnter = function() {
           $scope.addItem();
        };
            $scope.backItem = function(discount){
            $scope.backItems = [];
            angular.forEach($scope.invoiceItems,function(item,key){
                if (item.return > 0) {
                    item.discount   = Math.round( discount );
                    item.account   = $scope.header.account;
                    item.cost       = item.unit_price - (item.unit_price*(item.discount/100));
                    $scope.backItems.push(item) ;
                }
            });
            return $scope.backItems;

        };
        $scope.multiBackItem = function(discount){
            if(!$scope.backItems){
                $scope.backItems = []
            }
            angular.forEach($scope.invoiceItems,function(item,key){
                $scope.finishReturnInvoice();
                if (item.return > 0) {
                    item.discount   = Math.round( discount );
                    item.cost       = item.unit_price - (item.unit_price*(item.discount/100));
                    $scope.backItems.push(item) ;
                }
            });
            $scope.invoiceItems = [];
            return $scope.backItems;
        };
        $scope.finishReturnInvoice = function(){
            $scope.invoiceItems = [];
            $scope.header = [];
        };
        $scope.invoiceData = function(type,brId){
            $scope.invoiceItems = [];
            $scope.invoice.invoiceType = type ;
            $scope.invoice.brId        = brId ;
            if($scope.account.id){
                $scope.invoice.invoiceNo = "";
                $scope.invoice.acc         =  $scope.account.id;
            }
            Item.getInvoiceById($scope.invoice).success(function (data) {
                $scope.invoiceItems = data.details;
                $scope.header       = data.header;
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
            if($scope.item.has_serial == 0){
                $scope.invoiceItems.push($scope.item);
                // Clear input fields after push
                $scope.item = "";
                $scope.dirty.continent = "";
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
                //document.getElementById('itemsView').style.display = 'none';
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
            if (serial == 0 || serial == null) {
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
            //document.getElementById('itemsView').style.display = '';
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
            angular.forEach($scope.backItems, function(item, key){
                if(item.return>0){
                    total += (item.return *  item.cost);
                }
            });

            return total;
        };

        $scope.cost = function(item){
            if(item.cost > 0){
                return item.cost;
            }else{
                if( $scope.seletedAccount.pricing  && $scope.transType == "sales"){
                    if($scope.seletedAccount.pricing=="sell_users"){
                        return item.sell_users;
                    }else if($scope.seletedAccount.pricing=="sell_gomla" && item.sell_gomla>0 ){
                        return item.sell_gomla;
                    }else if($scope.seletedAccount.pricing=="sell_gomla_gomla" && item.sell_gomla_gomla>0 ){
                        return item.sell_gomla_gomla;
                    }else if($scope.seletedAccount.pricing=="sell_nos_gomla" && item.sell_nos_gomla>0 ){
                        return item.sell_nos_gomla;
                    }else{
                        return $scope.priceAfterOffer(item);
                    }
                }else if($scope.transType == "buy"){
                    return item.buy;
                }else{
                    return $scope.priceAfterOffer(item);
                }
            }

        };
        $scope.priceAfterOffer =  function(item){
            var today =new Date();
            from = item.offer_from.split("-");
            from = new Date(from[0], from[1]-1 ,from[2] );
            to = item.offer_to.split("-");
            to = new Date(to[0], to[1]-1 , to[2]);
            if (today.getTime() >= from.getTime() && today.getTime()  <= to.getTime() ) {
                console.log( to);
                return item.sell_users - (item.sell_users)*(item.offer)/100;
            }
            return item.sell_users;

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
            item =  $scope.item;
            if(item){
                if( item.item_name.length>0  && item.id>0){
                    return false;
                }else{
                    return true;
                }
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
            $scope.dirty.continent = "";
            $scope.all     = "" ;
            $scope.serials = [] ;
            $scope.added   = "" ;
        };
        $scope.returnBalance  =  function(invoiceItem) {
            //console.log(invoiceItem.has_serial)
            if(invoiceItem){
                if(invoiceItem.has_serial == 1){
                    return 1 ;
                }else{
                    return false;
                }
            }

        };
        $scope.selectALl  =  function(className) {
            var select =  document.getElementsByClassName(className);
            if(!classes[className] ){
                for (var i = 0; i < select.length; i++) {
                    select[i].checked = true;
                }
                classes[className]= true ;
            }else{
                for (var i = 0; i < select.length; i++) {
                    select[i].checked = false;
                }
                classes[className]= false ;
            }

        };

        $scope.checkAllContact = function(){
            if ($scope.checkAllContact1) {
                $scope.checkAllContact1 = true;
            } else {
                $scope.checkAllContact1 = false;
            }
            angular.forEach($scope.contacts, function (item) {
                item.check = $scope.checkAllContact1;
            });
        }

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