/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('employeeService', [])

    .factory('Employee', function($http) {
        var url = "/admin";
        return {
            get : function() {
                return $http.get(url+'/AccountsBalances/Add-Accounts-Balances-data');
            },
            getAll : function(id) {//get الاستحقاقات و الاستقطاعات الثابته
                return $http({
                    method: 'POST',
                    url: url+'/hr/employee-dep-dis-data',
                    headers: { 'Content-Type' : 'application/json' },
                    data: JSON.stringify(id)
                });
            },
            save : function(dudDis) {//get الاستحقاقات و الاستقطاعات الثابته
                return $http({
                    method: 'POST',
                    url: url+'/hr/store-emp-des-ded-pop',
                    headers: { 'Content-Type' : 'application/json' },
                    data: JSON.stringify(dudDis)
                });
            },
            destroy : function(id) {
                return $http.delete(url+'/hr/delete-emp-des-ded-pop/' + id);
            }
        }

    });