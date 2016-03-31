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

    .state('app.activity', {
        url: '/activity',
        views: {
            'menuContent': {
                templateUrl: 'templates/activity.html',
                controller: 'ActivityCtrl'
            },
            'fabContent': {
                template: '<button id="fab-activity" class="button button-fab button-fab-top-right expanded button-energized-900 flap"><i class="icon ion-paper-airplane"></i></button>',
                controller: function ($timeout) {
                    $timeout(function () {
                        document.getElementById('fab-activity').classList.toggle('on');
                    }, 200);
                }
            }
        }
    })

    .state('app.friends', {
        url: '/friends',
        views: {
            'menuContent': {
                templateUrl: 'templates/friends.html',
                controller: 'FriendsCtrl'
            },
            'fabContent': {
                template: '<button id="fab-friends" class="button button-fab button-fab-top-left expanded button-energized-900 spin"><i class="icon ion-chatbubbles"></i></button>',
                controller: function ($timeout) {
                    $timeout(function () {
                        document.getElementById('fab-friends').classList.toggle('on');
                    }, 900);
                }
            }
        }
    })

    .state('app.gallery', {
        url: '/gallery',
        views: {
            'menuContent': {
                templateUrl: 'templates/gallery.html',
                controller: 'GalleryCtrl'
            },
            'fabContent': {
                template: '<button id="fab-gallery" class="button button-fab button-fab-top-right expanded button-energized-900 drop"><i class="icon ion-heart"></i></button>',
                controller: function ($timeout) {
                    $timeout(function () {
                        document.getElementById('fab-gallery').classList.toggle('on');
                    }, 600);
                }
            }
        }
    })

    .state('app.login', {
        url: '/login',
        views: {
            'menuContent': {
                templateUrl: 'templates/login.html',
                controller: 'LoginCtrl'
            },
            'fabContent': {
                template: ''
            }
        }
    })

    .state('app.lessons', {
        url: '/lessons',
        views: {
            'menuContent': {
                templateUrl: 'templates/lessons.html',
                controller: 'LessonsCtrl'
            }
            /*'fabContent': {
                template: '<button id="fab-gallery" class="button button-fab button-fab-top-right expanded button-energized-900 drop"><i class="icon ion-heart"></i></button>',
                controller: function ($timeout) {
                    $timeout(function () {
                        document.getElementById('fab-gallery').classList.toggle('on');
                    }, 800);
                }
            }*/
        }
    })
    



    .state('app.lessons-view', {
        url: '/lessons-view',
        views: {
            'menuContent': {
                templateUrl: 'templates/lessons-view.html',
                controller: 'LessonsCtrl'
            }
        }
    })

    .state('app.webinars', {
        url: '/webinars',
        views: {
            'menuContent': {
                templateUrl: 'templates/webinars.html',
                controller: 'LessonsCtrl'
            }
        }
    })

    .state('app.webinars-view', {
        url: '/webinars-view',
        views: {
            'menuContent': {
                templateUrl: 'templates/webinars-view.html',
                controller: 'LessonsCtrl'
            }
        }
    })

    .state('app.forms', {
        url: '/forms',
        views: {
            'menuContent': {
                templateUrl: 'templates/forms.html',
                controller: 'LessonsCtrl'
            }
        }
    })
    
    .state('app.documentation', {
        url: '/documentation',
        views: {
            'menuContent': {
                templateUrl: 'templates/documentation.html',
                controller: 'LessonsCtrl'
            }
        }
    })
    ;





    // if none of the above states are matched, use this as the fallback
    $urlRouterProvider.otherwise('/app/login');
});
