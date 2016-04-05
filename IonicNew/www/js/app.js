// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.controllers' is found in controllers.js
angular.module('starter.constants',[])  
  .constant('apiUrl', 'http://localhost/got-safety/api');

angular.module('starter', ['ionic', 'starter.controllers', 'ionic-material', 'ionMdInput', 'starter.constants', 'starter.services'])

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
        if (window.cordova && window.cordova.plugins.Keyboard) {
            cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
        }
        if (window.StatusBar) {
            // org.apache.cordova.statusbar required
            StatusBar.styleDefault();
        }
    });
})

.config(function($stateProvider, $urlRouterProvider, $ionicConfigProvider,$sceDelegateProvider) {

      //youtube vedio access
    $sceDelegateProvider.resourceUrlWhitelist(['self', new RegExp('^(http[s]?):\/\/(w{3}.)?youtube\.com/.+$')]);

    // Turn off caching for demo simplicity's sake
    $ionicConfigProvider.views.maxCache(0);

    /*
    // Turn off back button text
    $ionicConfigProvider.backButton.previousTitleText(false);
    */


    $stateProvider.state('app', {
        url: '/app',
        abstract: true,
        templateUrl: 'templates/menu.html',
        controller: 'AppCtrl'
    })

   
    .state('app.login', {
        url: '/login',
        views: {
            'menuContent': {
                templateUrl: 'templates/login.html',
                controller: 'LoginCtrl'
            }
           
        }
    })



     .state('app.safetyLessons', {
    url: '/safetyLessons',
    views: {
      'menuContent': {
        templateUrl: 'templates/safetyLessons.html',
        controller: 'safetyLessonsCtrl'
      }
    }
  })

    
  .state('app.lessonView', 
  {
    url: '/lessonView/:id',  
    views: {
      'menuContent': {
      templateUrl: 'templates/lessonView.html',
      controller: 'LessonViewCtrl'
      }
     } 

  })


  .state('app.webinars', {
    url: '/webinars',
    views: {
      'menuContent': {
        templateUrl: 'templates/webinars.html',
        controller: 'WebinarsCtrl'
      }
    }
  })

  .state('app.webinarView', {
    url: '/webinarView/:id',
    views: {
      'menuContent': {
                templateUrl: 'templates/webinarView.html',
                controller: 'WebinarsViewCtrl'
              }
            }
  })

   

    .state('app.forms', {
        url: '/forms',
        views: {
            'menuContent': {
                templateUrl: 'templates/form.html',
                controller: 'FormsCtrl'
            }
        }
    })
    
    .state('app.documentation', {
        url: '/documentation',
        views: {
            'menuContent': {
                templateUrl: 'templates/documentation.html',
                controller: 'DocumentationCtrl'
            }
        }
    })

       .state('app.report', {
        url: '/report',
        views: {
            'menuContent': {
                templateUrl: 'templates/Inspectionreport.html',
                controller: 'InspectionReportCtrl'
            }
        }
    })

       .state('app.logs', {
        url: '/logs',
        views: {
            'menuContent': {
                templateUrl: 'templates/300logs.html',
                controller: '300LogsCtrl'
            }
        }
    })

         .state('app.records', {
        url: '/records',
        views: {
            'menuContent': {
                templateUrl: 'templates/TrainingRecord.html',
                controller: 'TrainingRecordCtrl'
            }
        }
    })

       .state('app.SafetyPosters', {
    url: '/SafetyPosters',
    views: {
      'menuContent': {
        templateUrl: 'templates/SafetyPosters.html',
        controller: 'SafetyPostersCtrl'
      }
    }
  })

    
  .state('app.SafetyPosterView', 
  {
    url: '/SafetyPosterView/:id',  
    views: {
      'menuContent': {
      templateUrl: 'templates/SafetyPosterView.html',
      controller: 'SafetyPosterViewCtrl'
      }
     } 

  })





    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/app/login');

    //$ionicConfigProvider.backButton.text('Go Back').icon('ion-chevron-left');
  $ionicConfigProvider.tabs.position("bottom"); //Places them at the bottom for all OS
  $ionicConfigProvider.navBar.alignTitle("center");
  $ionicConfigProvider.tabs.style("standard");

});
