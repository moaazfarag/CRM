/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('employeeService', [])

    .factory('Employee', function($http) {

        return {
            get : function() {
                return $http.get('/admin/AccountsBalances/Add-Accounts-Balances-data');
            },
            show : function(id) {
                return $http.get('api/comments/' + id);
            },
            getAll : function(id) {//get الاستحقاقات و الاستقطاعات الثابته
                return $http({
                    method: 'POST',
                    url: '/admin/hr/employee-dep-dis-data',
                    headers: { 'Content-Type' : 'application/json' },
                    data: JSON.stringify(id)
                });
            },
            save : function(dudDis) {//get الاستحقاقات و الاستقطاعات الثابته
                return $http({
                    method: 'POST',
                    url: '/admin/hr/store-emp-des-ded-pop',
                    headers: { 'Content-Type' : 'application/json' },
                    data: JSON.stringify(dudDis)
                });
            },
            destroy : function(id) {
                return $http.delete('/admin/testdelete/' + id);

            }
        }

    });