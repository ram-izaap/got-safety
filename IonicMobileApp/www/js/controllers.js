angular.module('starter.controllers', [])

.controller('LoginCtrl', function($scope, $state, $ionicPopup, AuthService, $ionicLoading) {
    
    $scope.data = {};
 
    $scope.login = function(data) {

      $ionicLoading.show({ noBackdrop:true });

      AuthService.login($scope.data.username, $scope.data.password).then(function(authenticated) {
        $state.go('tab.weekly-pickle', {}, {reload: true});
        $ionicLoading.hide();
      }, 
      function(err) {
        $ionicPopup.alert( { title: 'Login failed!', template: 'Please check your credentials!' } );
        $ionicLoading.hide();
      });

    };
})


.controller('WebinarsCtrl', function($scope, $state, $http, News, $ionicLoading) 
{
  $ionicLoading.show({ noBackdrop:true });
  News.all().then(function(data){  $scope.news = data; $ionicLoading.hide(); });   
})



.controller('LessonViewCtrl', function($scope, $state, $http, News, $ionicLoading) 
{
    $ionicLoading.show({ noBackdrop:true });
  News.all().then(function(data){  $scope.news = data; $ionicLoading.hide(); });   
})



.controller('WeeklyPickleCtrl', function($scope,$http, Weeklypickle, $ionicLoading, $state, AuthService) 
{	
	$ionicLoading.show({ noBackdrop:true });
  Weeklypickle.get().then(function(data){		$scope.weekpick = data;		$ionicLoading.hide();	 }); 
      
      	$scope.GotoLink = function (url) 
        {	
          console.log(url); 
          window.open(url,'_blank','location=yes');	
        } 
	     
       $scope.logout = function() 
       {
        AuthService.logout();		$state.go('login');	 
       };

})



/*.controller('SafetyLession', function($scope,$http, Safetylessonpickle, $ionicLoading) 
{	
	$ionicLoading.show({ noBackdrop:true });
  Safetylessonpickle.get().then(function(data){ $scope.safety = data; $ionicLoading.hide();	 });
	$scope.GotoLink = function (url) 
  {	
    window.open(encodeURI(url),'_system','location=yes');
    return false;  
  }

})
*/

.controller('safetyLessonsCtrl', function($scope,$http, safetyLessons, $ionicLoading) 
{ 
  $ionicLoading.show({ noBackdrop:true });
  safetyLessons.get().then(function(data)
  { 
    $scope.safety = data; $ionicLoading.hide();
    alert(safety);
    });
})



/*.controller('NewsCtrl', function($scope, $state, $http, News, $ionicLoading) {
  
  $ionicLoading.show({ noBackdrop:true });

  News.all().then(function(data){  $scope.news = data; $ionicLoading.hide(); });   

})*/


.controller('NewsDetailCtrl', function($scope, $stateParams,$http, News, $ionicLoading, $sce)
 {
  $ionicLoading.show({ noBackdrop:true });
  News.get($stateParams.newsId, $stateParams.itemsShown).then(function(data){ $scope.newsdetail = data; $ionicLoading.hide(); });
  News.getAdSpace().then(function(data){ $scope.adspace = $sce.trustAsHtml(data); });  
  $scope.Openlink = function (url) { window.open(url,'_blank','location=yes'); } 
});
