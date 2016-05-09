/* global angular, document, window */
'use strict';

angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $ionicPopover, $timeout, AuthService,$state) {
    
    $scope.isExpanded        = false;
    $scope.hasHeaderFabLeft  = false;
    $scope.hasHeaderFabRight = false;

    var navIcons = document.getElementsByClassName('ion-navicon');
    for (var i = 0; i < navIcons.length; i++) {
        navIcons.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    }

    ////////////////////////////////////////
    // Layout Methods
    ////////////////////////////////////////

    $scope.hideNavBar = function() {
        document.getElementsByTagName('ion-nav-bar')[0].style.display = 'none';
    };

    $scope.showNavBar = function() {
        document.getElementsByTagName('ion-nav-bar')[0].style.display = 'block';
    };

    $scope.noHeader = function() {
        var content = document.getElementsByTagName('ion-content');
        for (var i = 0; i < content.length; i++) {
            if (content[i].classList.contains('has-header')) {
                content[i].classList.toggle('has-header');
            }
        }
    };

    $scope.setExpanded = function(bool) 
    {
        $scope.isExpanded = bool;
    };

    $scope.setHeaderFab = function(location) 
    {
        var hasHeaderFabLeft  = false;
        var hasHeaderFabRight = false;

        switch (location) {
            case 'left':
                hasHeaderFabLeft = true;
                break;
            case 'right':
                hasHeaderFabRight = true;
                break;
        }

        $scope.hasHeaderFabLeft  = hasHeaderFabLeft;
        $scope.hasHeaderFabRight = hasHeaderFabRight;
    };

    $scope.hasHeader = function() 
    {
        var content = document.getElementsByTagName('ion-content');
        for (var i = 0; i < content.length; i++) 
        {
            if (!content[i].classList.contains('has-header'))
             {
                content[i].classList.toggle('has-header');
             }
        }

    };

    $scope.hideHeader = function() 
    {
        $scope.hideNavBar();
        $scope.noHeader();
    };

    $scope.showHeader = function() 
    {
        $scope.showNavBar();
        $scope.hasHeader();
    };

    $scope.clearFabs = function() 
    {
        var fabs = document.getElementsByClassName('button-fab');
        if (fabs.length && fabs.length > 1) 
        {
            fabs[0].remove();
        }
    };


    //logout function
    $scope.logout = function() 
    {
    AuthService.logout();
    $state.go('app.login');
    };



})

.controller('LoginCtrl', function($scope, $timeout, $state, $ionicPopup, AuthService, $ionicLoading, ionicMaterialInk,$ionicHistory) {
    

    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $timeout(function() 
    {
        $scope.$parent.hideHeader();
    }, 0);
    ionicMaterialInk.displayEffect();

    //login function begins
    $scope.data = {};
    $scope.login = function(data) 
    {
      
          $ionicLoading.show({ noBackdrop:true });
          AuthService.login($scope.data.username, $scope.data.pwd).then(function(response)
          {
                  $ionicLoading.hide();   
                  $ionicHistory.currentView($ionicHistory.backView());                    
                  $state.go('app.safetyLessons');
                                       
          }, 
          function(err) 
          {
            $ionicLoading.hide();
            $ionicPopup.alert( { title: 'Login failed!', template: 'Invalid Username or Password!' } );
          
          });

    };


   
    
})



.controller('safetyLessonsCtrl', function($scope, $stateParams, $timeout, ionicMaterialMotion, ionicMaterialInk, safetyLessons, $ionicPopup, $ionicLoading) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.$parent.setHeaderFab('left');
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);

      $timeout(function() {
        ionicMaterialMotion.slideUp({
            selector: '.slide-up'
        });
    }, 300);

    $timeout(function() {
        ionicMaterialMotion.fadeSlideInRight({
            startVelocity: 3000
        });
    }, 700);


    $scope.showPopup = function() 
    {
              $scope.data = {};

              // An elaborate, custom popup
              var myPopup = $ionicPopup.show({
                
                title:      'search safety lessons',
                subTitle:   'Are you want to download or view?',
                scope:       $scope,
                buttons:    [
                              { text: 'download',
                                type: 'button-assertive' },
                              {
                                text: '<b>view</b>',
                                type: 'button-positive'
                                
                              }
                            ]
              });
  $timeout(function() {
     myPopup.close(); //close the popup after 3 seconds for some reason
  }, 3000);
 };

      // list of safety lessonss
      safetyLessons.all().then(function(data)
      { 
        $scope.Lessons = data; 
        $ionicLoading.hide();

        
     });

})


.controller('LessonViewCtrl', function($scope, $stateParams, $window, $http, safetyLessons, $ionicLoading) 
{   
    var LessonId   = $stateParams.id;
    $scope.Lessons = safetyLessons.GetLesson(LessonId);    
    
     
      safetyLessons.GetAttachment().then(function(data)
      { 
        $scope.Attachment = data; 
        $ionicLoading.hide();     
        
     });

        //open pdf in  browser
        $scope.OpenLink = function(link)
         {
       
         window.open( link, '_blank','location=yes');
        
         };   
 })


.controller('WebinarsCtrl', function($scope, $state, $timeout,$http, WebinarService, $ionicLoading,ionicMaterialMotion) 
{

    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.$parent.setHeaderFab('left');
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);

      $timeout(function() {
        ionicMaterialMotion.slideUp({
            selector: '.slide-up'
        });
    }, 300);

    $timeout(function() {
        ionicMaterialMotion.fadeSlideInRight({
            startVelocity: 3000
        });
    }, 700);

      //webinars list
      $ionicLoading.show({ noBackdrop:true });
      WebinarService.all().then(function(data)
      { 
        $scope.webinars = data; 
        $ionicLoading.hide();
      });

})

.controller('WebinarsViewCtrl', function($scope, $state, $stateParams, $http, WebinarService, $ionicLoading) 
{
      //single webinar view
      $ionicLoading.show({ noBackdrop:true });
      var WebinarId   = $stateParams.id;
      $scope.webinars = WebinarService.get(WebinarId);

})


.controller('DocumentationCtrl', function($scope, $stateParams,$ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion,DocumentationService) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.$parent.setHeaderFab('left');
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);

      $timeout(function() {
        ionicMaterialMotion.slideUp({
            selector: '.slide-up'
        });
    }, 300);

    $timeout(function() {
        ionicMaterialMotion.fadeSlideInRight({
            startVelocity: 3000
        });
    }, 700);


    // Set Ink
    ionicMaterialInk.displayEffect();

    //documentations list
    DocumentationService.all().then(function(data)
      { 
        $scope.Documentations = data; 
        $ionicLoading.hide();
      })

     //documentation content
     DocumentationService.content().then(function(data)
    { 
        $scope.content = data; 
        $ionicLoading.hide();
    });

        //open pdf in browser
        $scope.OpenLink = function(link)
         {
       
         window.open( link, '_blank','location=yes');
        
         };   

})


.controller('InspectionReportCtrl', function($scope, $stateParams,$ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion,InspectionReportService) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.$parent.setHeaderFab('left');
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);

      $timeout(function() {
        ionicMaterialMotion.slideUp({
            selector: '.slide-up'
        });
    }, 300);

    $timeout(function() {
        ionicMaterialMotion.fadeSlideInRight({
            startVelocity: 3000
        });
    }, 700);


    // Set Ink
    ionicMaterialInk.displayEffect();

    //Inspection Report list
    InspectionReportService.all().then(function(data)
      { 
        $scope.Reports = data; 
        $ionicLoading.hide();
      })

     //IspectionReport content
     InspectionReportService.content().then(function(data)
    { 
        $scope.content = data; 
        $ionicLoading.hide();
    });

        //open pdf in browser
        $scope.OpenLink = function(link)
         {
       
         window.open( link, '_blank','location=yes');
        
         };   

})



.controller('300LogsCtrl', function($scope, $stateParams,$ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion,LogService) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.$parent.setHeaderFab('left');
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);

      $timeout(function() {
        ionicMaterialMotion.slideUp({
            selector: '.slide-up'
        });
    }, 300);

    $timeout(function() {
        ionicMaterialMotion.fadeSlideInRight({
            startVelocity: 3000
        });
    }, 700);


    // Set Ink
    ionicMaterialInk.displayEffect();

    //Logs list
    LogService.all().then(function(data)
      { 
        $scope.Logs = data; 
        $ionicLoading.hide();
      })

     //Logs content
     LogService.content().then(function(data)
    { 
        $scope.content = data; 
        $ionicLoading.hide();
    });

        //open pdf in browser
        $scope.OpenLink = function(link)
         {
       
         window.open( link, '_blank','location=yes');
        
         };   

})


.controller('TrainingRecordCtrl', function($scope, $stateParams,$ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion,TrainingRecordService) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.$parent.setHeaderFab('left');
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);

      $timeout(function() {
        ionicMaterialMotion.slideUp({
            selector: '.slide-up'
        });
    }, 300);

    $timeout(function() {
        ionicMaterialMotion.fadeSlideInRight({
            startVelocity: 3000
        });
    }, 700);


    // Set Ink
    ionicMaterialInk.displayEffect();

    //Logs list
    TrainingRecordService.all().then(function(data)
      { 
        $scope.Records = data; 
        $ionicLoading.hide();
      })

     //Logs content
     TrainingRecordService.content().then(function(data)
    { 
        $scope.content = data; 
        $ionicLoading.hide();
    });

        //open pdf in browser
        $scope.OpenLink = function(link)
         {
       
         window.open( link, '_blank','location=yes');
        
         };   

})




.controller('FormsCtrl', function($scope, $stateParams,$ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion, FormService) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
   // $scope.$parent.setHeaderFab('left');
   //$scope.$parent.setExpanded(false);
    //$scope.$parent.setHeaderFab(false);

      $timeout(function() {
        ionicMaterialMotion.slideUp({
            selector: '.slide-up'
        });
    }, 300);

    $timeout(function() {
        ionicMaterialMotion.fadeSlideInRight({
            startVelocity: 3000
        });
    }, 700);

    // Set Ink
    ionicMaterialInk.displayEffect();

    //forms list
    FormService.all().then(function(data)
    { 
        $scope.Forms = data; 
        $ionicLoading.hide();
    });


    //forms content
    FormService.content().then(function(data)
    { 
        $scope.content = data; 
        $ionicLoading.hide();
    });


        //open pdf in content
        $scope.OpenLink = function(link)
        {
       
          window.open( link, '_blank','location=yes');
        
        };   

})



.controller('SafetyPostersCtrl', function($scope, $stateParams, $timeout, ionicMaterialMotion, ionicMaterialInk, SafetyPosters, $ionicPopup, $ionicLoading) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.isExpanded = true;
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);
    //$scope.$parent.hideHeader();
    // Set Motion
    $timeout(function() {
        ionicMaterialMotion.slideUp({
            selector: '.slide-up'
        });
    }, 300);

    $timeout(function() {
        ionicMaterialMotion.fadeSlideInRight({
            startVelocity: 3000
        });
    }, 700);

      // Set Ink
    ionicMaterialInk.displayEffect();



    $scope.showPopup = function() 
    {
              $scope.data = {};

              // An elaborate, custom popup
              var myPopup = $ionicPopup.show({
                
                title:      'search safety lessons',
                subTitle:   'Are you want to download or view?',
                scope:       $scope,
                buttons:    [
                              { text: 'download',
                                type: 'button-assertive' },
                              {
                                text: '<b>view</b>',
                                type: 'button-positive'
                                
                              }
                            ]
              });
  $timeout(function() {
     myPopup.close(); //close the popup after 3 seconds for some reason
  }, 3000);
 };

      // list of safety posters
      SafetyPosters.all().then(function(data)
      { 
        $scope.Posters = data; 
        $ionicLoading.hide();

        
     });

})


.controller('SafetyPosterViewCtrl', function($scope, $stateParams, $window, $http, SafetyPosters, $ionicLoading) 
{   
    var PosterId   = $stateParams.id;
    $scope.Posters = SafetyPosters.GetPoster(PosterId);    
    
     //safety poster attachment
      SafetyPosters.GetAttachment().then(function(data)
      { 
        $scope.Attachment = data; 
        $ionicLoading.hide();     
        
     });

        //open pdf in  browser
         $scope.OpenLink = function(link)
         {
       
         window.open( link, '_blank','location=yes');
        
         };   
 })
 
 
 
 
 
.controller('OptionsTreeController', ['$scope','RepositoryService', function ($scope,RepositoryService) {
    function init() {
		RepositoryService.all().then(function(data)
		{
			$scope.treeNodes = data; 
			
			  
			
		});
        /*$scope.treeNodes = [
    {
        "name": "dummy.pdf",
        "ext": "pdf",
        "url": "admin/views/repository/files/client/dummy.pdf"
    },
    {
        "name": "page1.png",
        "ext": "png",
        "url": "admin/views/repository/files/client/page1.png"
    },
    {
        "name": "page2.png",
        "ext": "png",
        "url": "admin/views/repository/files/client/page2.png"
    },
    {
        "name": "test",
        "children": [
            {
                "name": "AllergyBeGone-WorkProgressReport.xlsx",
                "ext": "xlsx",
                "url": "admin/views/repository/files/client/test/AllergyBeGone-WorkProgressReport.xlsx"
            },
            {
                "name": "SampleAudio_0.4mb.mp3",
                "ext": "mp3",
                "url": "admin/views/repository/files/client/test/SampleAudio_0.4mb.mp3"
            },
            {
                "name": "dummy.pdf",
                "ext": "pdf",
                "url": "admin/views/repository/files/client/test/dummy.pdf"
            },
            {
                "name": "page1.png",
                "ext": "png",
                "url": "admin/views/repository/files/client/test/page1.png"
            },
            {
                "name": "test1.1",
                "children": [
                    {
                        "name": "dummy.pdf",
                        "ext": "pdf",
                        "url": "admin/views/repository/files/client/test/test1.1/dummy.pdf"
                    }
                ]
            }
        ]
    },
    {
        "name": "test2",
        "children": [
            {
                "name": "dummy.pdf",
                "ext": "pdf",
                "url": "admin/views/repository/files/client/test2/dummy.pdf"
            },
            {
                "name": "page1.png",
                "ext": "png",
                "url": "admin/views/repository/files/client/test2/page1.png"
            }
        ]
    }
]; */

        $scope.options = { multipleSelect: true, showIcon: false };

        $scope.options1 = { showIcon: true, expandOnClick: true };

    }
    init();

    $scope.$on('selection-changed', function (e, nodes) {
        if (nodes.length > 0) {
            $scope.selectedNodes = nodes;
        } else {
            $scope.selectedNode = nodes;
        }
    });

    $scope.$on('expanded-state-changed', function (e, node) {
        // node - the node on which the expanded state changed
        // to see the current state check the expanded property
        $scope.exapndedNode = node;
        //console.log(node.expanded);
    });
}]);

