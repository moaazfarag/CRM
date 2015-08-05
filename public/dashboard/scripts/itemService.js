/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('itemService', [])

    .factory('Item', function($http) {

        return {
            get : function() {
                console.log($http.get('/admin/test'));
                return $http.get('/admin/test');
            },
            show : function(id) {
                return $http.get('api/comments/' + id);
            },
            save : function(invoiceItems) {
                return $http({
                    method: 'POST',
                    url: '/admin/Transaction/transJson',
                    dataType: 'JSON',
                    headers: { 'Content-Type' : 'application/json' },
                    data: $.param(invoiceItems)
                });
            },
            destroy : function(id) {
                return $http.delete('/admin/testdelete/' + id);

            }
        }

    });