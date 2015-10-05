/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('itemService', [])

    .factory('Item', function($http) {

        return {
            getItems: function(brId) {//get data for using in drop menu
                return $http({
                    method:'POST',
                    url: '/admin/invoice/items-data-br',
                    headers: { 'Content-Type' : 'application/json' },
                    data:   JSON.stringify(brId)
                });
            },
            getCoItem: function(brId) {//get data for using in drop menu
                return $http({
                    method:'POST',
                    url: '/admin/invoice/items-data',
                    headers: { 'Content-Type' : 'application/json' },
                    data:   JSON.stringify(brId)
                });
            },
            getSerialItem: function(info) {//get data for using in drop menu
                return $http({
                    method:'POST',
                    url: '/admin/invoice/serial-items-data',
                    headers: { 'Content-Type' : 'application/json' },
                    data:   JSON.stringify(info)
                });
            },
            show : function(id) {
                return $http.get('api/comments/' + id);
            },
            save : function(invoiceItems) {
                return $http({
                    method: 'POST',
                    url: '/admin/Transaction/test',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(invoiceItems)
                });
            },
            getAccountsByType : function(type){
                return $http({
                    method:'POST',
                    url: '/admin/invoice/accounts-data',
                    headers: { 'Content-Type' : 'application/json' },
                    data:   JSON.stringify(type)
                });

            },
            //getInvoiceByType : function(invoiceNo){
            //    return $http({
            //        method:'POST',
            //        url: '/admin/invoice/invoice-data',
            //        headers: { 'Content-Type' : 'application/json' },
            //        data:   JSON.stringify(invoiceNo)
            //    });
            //
            //},
            getAccountInfo : function(id){
                return $http({
                    method:'POST',
                    url: '/admin/invoice/accounts-by-id',
                    headers: { 'Content-Type' : 'application/json' },
                    data:   JSON.stringify(id)
                });

            },
            getInvoiceById :function(invoice){
                return $http({
                    method: 'POST',
                    url: '/admin/invoice/returns-invoice-data',
                    headers: { 'Content-Type' :  'application/json' },
                    data:   JSON.stringify(invoice)
                });

            },


            destroy : function(id) {
                return $http.delete('/admin/testdelete/' + id);

            }
        }

    });