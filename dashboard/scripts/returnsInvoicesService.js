/**
 * Created by ahmed on 9/9/2015.
 */
angular.module('invoicesService',[])
    .factory('ReturnsInvoice', function($http) {

        return {
            post: function($http) {
                return $http.get('/admin/invoice/all-invoices');
            },
            getAll: function(id) {
                return $http({
                    method : 'POST',
                    url    : '/admin/invoices/returns-invoice-data',
                    headers: { 'Content-Type' : 'application/json' },
                    data: JSON.stringify(id)
                });
            },
            save : function(returnsInvoice){
                return $http({
                   method : 'POST',
                    url   : '/admin/invoices/returns-invoice-data',
                    headers: { 'Content-Type' : 'application/json' },
                    data: JSON.stringify(returnsInvoice)

                });
            }
        }
    });