var app = angular.module('binekhi', ['ngRoute']);

app.config(function($routeProvider) {
    $routeProvider.when('/products', {
        controller: 'binekhiController',
        template: ' '
    }).when('/item/', {
        controller: 'binekhiController',
        templateUrl: ' '
    }).when('/item/:ID', {
        controller: 'itemCtrl',
        templateUrl: 'http://binekhi.ge/wp-content/themes/binekhi/item.html'
    });
});

app.controller('binekhiController', ['$scope', '$routeParams', '$rootScope', function($scope, $routeParams, $rootScope) {
	$rootScope.productID = null;
}]);

app.controller('itemCtrl', ['$scope', '$http', '$sce', '$location', '$routeParams', '$rootScope', function($scope, $http, $sce, $location, $routeParams, $rootScope) {
    $scope.siteUrl = $location.host();
    $scope.lang =  $("html").attr('lang');

    $scope.getProductById = function() {
        $http.get('http://'+$scope.siteUrl+'/'+$scope.lang+'/item/?id=' + $routeParams.ID, {
            cache: true
        }).success(function(res){
            if ($scope.lang == 'en') {
                $scope.lang = '';
            } else {
                $scope.lang += '/';
            }
            $rootScope.productID = res.id;
            $scope.product = res;
            $scope.product.specifications = $sce.trustAsHtml(res.specifications);
            $scope.product.awards = $sce.trustAsHtml(res.awards);
            $scope.product.mainimageurl = res.images[0].image;
            $scope.product.otherimageurl = res.images[1].image;
            $scope.product.otherimagetitle = res.images[1].type;
        });
    }

    $scope.getProductById();

}]);