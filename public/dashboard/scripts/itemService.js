/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('itemService', [])

    .factory('Item', function($http) {

        return {
            get : function() {
                return $http.get('/admin/test');
            },
            show : function(id) {
                return $http.get('api/comments/' + id);
            },
            save : function(itemData) {
                return $http({
                    method: 'POST',
                    url: '/admin/addtest',
                    headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
                    data: $.param(itemData)
                });
            },
            destroy : function(id) {
                return $http.delete('/admin/testdelete'/id);
            }
        }

    });