/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('itemService', [])

    .factory('Item', function($http) {

        return {
            getItems: function() {//get data for using in drop menu
                return $http({
                    method:'POST',
                    url: '/admin/invoice/items-data',
                    headers: { 'Content-Type' : 'application/json' },
                    data:   JSON.stringify()
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
            getAccountInfo : function(id){
                return $http({
                    method:'POST',
                    url: '/admin/invoice/accounts-by-id',
                    headers: { 'Content-Type' : 'application/json' },
                    data:   JSON.stringify(id)
                });

            },

            destroy : function(id) {
                return $http.delete('/admin/testdelete/' + id);

            }
        }

    });