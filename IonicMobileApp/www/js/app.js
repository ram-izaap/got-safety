// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js


angular.module('starter.constants',[])  
  .constant('apiUrl', 'http://localhost/got-safety/api');

angular.module('starter', ['ionic', 'ngResource','starter.controllers', 'starter.services', 'starter.constants', 'starter.filters'])

//.constant('apiUrl', 'http://safetypickle.com/api/v1')

.constant('AUTH_EVENTS', {  notAuthenticated: 'auth-not-authenticated' })

.directive("navigateTo", function($ionicGesture, broadcast){
    return{
        restrict: 'A',
        link: function($scope, $element, $attr){
          var tapHandler = function(e){

            if (ionic.Platform.isAndroid() && $attr.navigateTo.indexOf("youtube.com") != -1) {
              var inAppBrowser = window.open(encodeURI($attr.navigateTo),'_system','location=yes');
            } else {
              var inAppBrowser = window.open(encodeURI($attr.navigateTo),'_blank','location=yes');
            }
            
            inAppBrowser.addEventListener('exit', function(event) { inAppBrowser.close(); });

          };

          var tapGesture = $ionicGesture.on('tap', tapHandler, $element);

          $scope.$on(broadcast.events.onPause, function (event) {
              inAppBrowser.close();
          });

          $scope.$on('$destroy', function(){
            $ionicGesture.off(tapGesture, 'tap', tapHandler);
          });
        }
    };
})

.run(function($ionicPlatform,$http,$rootScope, $state, AuthService, AUTH_EVENTS) {
  
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleLightContent();
    }

    //$rootScope.$on('$stateChangeStart', function (event,next, nextParams, fromState) {
      
      //alert(AuthService.isAuthenticated());
      //if (!AuthService.isAuthenticated()) 
      //{
        //if (next.name !== 'login') 
        //{
          //event.preventDefault();
          //$state.go('login');
        //}
      //}
      

    //});

  });
})



.config(function($stateProvider, $urlRouterProvider, $ionicConfigProvider,$sceDelegateProvider) {
     //youtube vedio access
    $sceDelegateProvider.resourceUrlWhitelist(['self', new RegExp('^(http[s]?):\/\/(w{3}.)?youtube\.com/.+$')]);
 
  $stateProvider

  .state('login', {
      url: '/login',
      templateUrl: 'templates/login.html',
      controller: 'LoginCtrl'      
    })

  .state('tab', {
      url: '/tab',
      abstract: true,
      templateUrl: 'templates/menu.html'
    })


  .state('tab.webinars', {
    url: '/webinars',
    views: {
      'menuContent': {
        templateUrl: 'templates/webinars.html',
        controller: 'WebinarsCtrl'
      }
    }
  })

  .state('tab.webinarView', {
    url: '/webinarView/:id',
    views: {
      'menuContent': {
                templateUrl: 'templates/webinarView.html',
                controller: 'WebinarsViewCtrl'
              }
            }
  })


  .state('tab.safetyLessons', {
    url: '/safetyLessons',
    views: {
      'menuContent': {
        templateUrl: 'templates/safetyLessons.html',
        controller: 'safetyLessonsCtrl'
      }
    }
  })

  .state('tab.lessonView', 
  {
    url: '/lessonView/:id',  
    views: {
      'menuContent': {
      templateUrl: 'templates/lessonView.html',
      controller: 'LessonViewCtrl'
      }
     } 

  })


  .state('tab.Documentation', {
    url: '/Documentation',
    views: {
      'menuContent': {
        templateUrl: 'templates/Documentation.html',
        controller: 'safetyLessonsCtrl'
      }
    }
  })


  .state('tab.Forms', {
    url: '/Forms',
    views: {
      'menuContent': {
        templateUrl: 'templates/Forms.html',
        controller: 'FormsCtrl'
      }
    }
  })


  .state('tab.SafetyStickers', {
    url: '/SafetyStickers',
    views: {
      'menuContent': {
        templateUrl: 'templates/SafetyStickers.html',
        controller: 'SafetyStickersCtrl'
      }
    }
  })


   .state('tab.Blog', {
    url: '/Blog',
    views: {
      'menuContent': {
        templateUrl: 'templates/Blog.html',
        controller: 'BlogCtrl'
      }
    }
  })

    .state('tab.Logout', {
    url: '/Logout',
    views: {
      'menuContent': {
        templateUrl: 'templates/Logout.html',
        controller: 'LogoutCtrl'
      }
    }
  })

  .state('tab.weekly-pickle', {
    url: '/weekly-pickle',
    views: {
      'tab-weekly-pickle': {
        templateUrl: 'templates/tab-weekly-pickle.html',
		    controller: 'WeeklyPickleCtrl'
      }
    }
  })

  /*.state('tab.safetylesson', {
    url: '/safetylesson',
    views: {
      'tab-safetylesson': {
        templateUrl: 'templates/tab-safetylesson.html',
		    controller: 'SafetyLession'
      }
    }
  })

  .state('tab.news', {	
    url: '/news',
    views: {
      'tab-news': {
        templateUrl: 'templates/tab-news.html',
		    controller: 'NewsCtrl'
      }
    }
  })*/

  .state('tab.subcategory', {
    url: '/subcategory/:newsId/:itemsShown',
    views: {
      'tab-news': {
        templateUrl: 'templates/tab-subcategory.html',
		    controller: 'NewsDetailCtrl'
      }
    }
  })

  
  // if none of the above states are matched, use this as the fallback
  //$urlRouterProvider.otherwise('/tab/weekly-pickle'); 
  $urlRouterProvider.otherwise('/login');

  //$ionicConfigProvider.backButton.text('Go Back').icon('ion-chevron-left');
  $ionicConfigProvider.tabs.position("bottom"); //Places them at the bottom for all OS
  $ionicConfigProvider.navBar.alignTitle("center");
  $ionicConfigProvider.tabs.style("standard");

});


