/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('itemService', [])

    .factory('Item', function($http) {

        return {
            get : function() {//get data for using in drop menu
                return $http.get('/admin/Transaction/Add-Trans-Header-data');
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
            destroy : function(id) {
                return $http.delete('/admin/testdelete/' + id);

            }
        }

    });