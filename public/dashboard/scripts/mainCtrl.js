/**
 * Created by moaaz on 7/27/2015.
 */
angular.module('mainCtrl', [])

    .controller('mainController', function($scope, $http, Item) {
        // object to hold all the data for the new comment form
        $scope.itemData = {};

        // loading variable to show the spinning loading icon
        $scope.loading = true;

        // get all the comments first and bind it to the $scope.comments object
        Item.get()
            .success(function(data) {
                $scope.items = data;
                $scope.loading = false;
            });


        // function to handle submitting the form
        $scope.submitItem = function() {
            $scope.loading = true;

            // save the comment. pass in comment data from the form
            Item.save($scope.itemData)
                .success(function(data) {
                    $scope.itemData = {};
                    // if successful, we'll need to refresh the comment list
                    Item.get()
                        .success(function(getData) {
                            $scope.items = getData;
                            $scope.loading = false;
                        });

                })
                .error(function(data) {
                    console.log(data);
                });
        };

        // function to handle deleting a comment
        $scope.deleteItem = function(id) {
            $scope.loading = true;

            Item.destroy(id)
                .success(function(data) {

                    // if successful, we'll need to refresh the comment list
                    Item.get()
                        .success(function(getData) {
                            $scope.items = getData;
                            $scope.loading = false;
                        });

                });
        };

    });