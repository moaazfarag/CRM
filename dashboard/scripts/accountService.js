/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('accountService', [])

    .factory('Account', function($http) {
        var url = "/admin";

        return {
            get : function() {
                return $http.get(url+'/AccountsBalances/Add-Accounts-Balances-data');
            },

            save : function(addedAccounts) {
                //console.log(addedAccounts);
                return $http({
                    method: 'POST',
                    url: url+'/Transaction/test',
                    headers: { 'Content-Type' : 'application/json' },
                    data: JSON.stringify(addedAccounts)

                });
            },

        }

    });