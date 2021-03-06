
angular.module('starter', ['ionic', 'starter.controllers','starter.services','ionic-material', 'ionMdInput', 'starter.constants', 'pdf','TreeWidget'])

    .constant('AUTH_EVENTS', {  notAuthenticated: 'auth-not-authenticated' })

    .directive("navigateTo", function($ionicGesture, $rootScope){
        return{
            restrict: 'A',
            link: function($scope, $element, $attr){
              var tapHandler = function(e){

              var inAppBrowser = window.open(encodeURI($attr.navigateTo),'_system','location=yes');
                /*
                if (ionic.Platform.isAndroid() && $attr.navigateTo.indexOf("youtube.com") != -1) {
                  var inAppBrowser = window.open(encodeURI($attr.navigateTo),'_system','location=yes');
                } else {
                  var inAppBrowser = window.open(encodeURI($attr.navigateTo),'_blank','location=yes');
                }
                */
                inAppBrowser.addEventListener('exit', function(event) { inAppBrowser.close(); });

              };

              var tapGesture = $ionicGesture.on('tap', tapHandler, $element);

              $rootScope.$broadcast("onPause", function (event) {
                  inAppBrowser.close();
              });

              $scope.$on('$destroy', function(){
                $ionicGesture.off(tapGesture, 'tap', tapHandler);
              });
            }
        };
    })

.directive('typeahead', function($timeout) {
   return {
        restrict: 'AEC',
        scope: {
            items: '=',
            prompt: '@',
            title: '@',
            subtitle: '@',
            model: '=',
            onSelect: '&',
            details: '='
        },

        link: function(scope, elem, attrs) {
            scope.handleSelection = function(selectedItem) {
                scope.model = selectedItem.employee_name;
                scope.details = selectedItem;
                scope.current = 0;
                scope.selected = true;
                $timeout(function() {
                    scope.onSelect( );
                }, 200);
            };
            scope.current = 0;
            scope.selected = true;
            scope.isCurrent = function(index) {
                return scope.current == index;
            };
            scope.setCurrent = function(index) {
                scope.current = index;
            };

        },
        templateUrl: 'templates/typeahead_template.html'
   
  }
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

        $rootScope.$on('$stateChangeStart', function (event,next, nextParams, fromState) {
          
          if (!AuthService.isAuthenticated()) 
          {
              if (next.name !== 'app.login') 
              {
                event.preventDefault();
                $state.go('app.login');
              }
          }
          

        });

    });
})

.config(function($stateProvider, $urlRouterProvider, $ionicConfigProvider,$sceDelegateProvider,AppConfig,pdfUrls) {

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



    .state('app.signoff', {
        url: '/signoff:id',
        views: {
            'menuContent': {
                templateUrl: 'templates/signoff.html',
                controller: 'signoffCtrl'
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

  .state('app.pdfView', 
  {
    url: '/pdfView/:file_name/:filetype',  
    views: {
      'menuContent': {
      templateUrl: 'templates/pdfView.html',
      controller: 'pdfViewCtrl'
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

       .state('app.safetyPosters', {
    url: '/SafetyPosters',
    views: {
      'menuContent': {
        templateUrl: 'templates/SafetyPosters.html',
        controller: 'safetyPostersCtrl'
      }
    }
  })

    
  .state('app.safetyPosterView', 
  {
    url: '/SafetyPosterView/:id',  
    views: {
      'menuContent': {
      templateUrl: 'templates/SafetyPosterView.html',
      controller: 'safetyPosterViewCtrl'
      }
     } 

  })
  
  
   .state('app.repositorytree', 
  {
    url: '/repositorytree',  
    views: {
      'menuContent': {
      templateUrl: 'templates/repository_tree.html',
      controller: 'OptionsTreeController'
      }
     } 

  })


    var user_id = window.localStorage.getItem("user_id");

    if( user_id )
    {
        $urlRouterProvider.otherwise('/app/safetyLessons');
    }
    else
    {
        $urlRouterProvider.otherwise('/app/login');
    }
    

    //$ionicConfigProvider.backButton.text('Go Back').icon('ion-chevron-left');
    $ionicConfigProvider.tabs.position("bottom"); //Places them at the bottom for all OS
    $ionicConfigProvider.navBar.alignTitle("center");
    $ionicConfigProvider.tabs.style("standard");

});











