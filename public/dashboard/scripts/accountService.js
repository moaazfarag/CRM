/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('accountService', [])

    .factory('Account', function($http) {

        return {
            get : function() {
                return $http.get('/admin/AccountsBalances/Add-Accounts-Balances-data');
            },
            show : function(id) {
                return $http.get('api/comments/' + id);
            },
            save : function(addedAccounts) {
                console.log(addedAccounts);
                return $http({
                    method: 'POST',
                    url: '/admin/Transaction/test',
                    headers: { 'Content-Type' : 'application/json' },
                    data: JSON.stringify(addedAccounts)

                });
            },
            destroy : function(id) {
                return $http.delete('/admin/testdelete/' + id);

            }
        }

    });