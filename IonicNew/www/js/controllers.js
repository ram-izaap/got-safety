angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $ionicPopover, $timeout, AuthService, $state) {

    $scope.isExpanded = true;
    $scope.hasHeaderFabLeft = false;
    $scope.hasHeaderFabRight = false;

    $scope.initNavMenu = function() {
      var navIcons = document.getElementsByClassName('ion-navicon-round');
      for (var i = 0; i < navIcons.length; i++) {
          navIcons[i].addEventListener('click', function() {
              this.classList.toggle('active');
          });
      }
    };
    
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

    $scope.setExpanded = function(bool) {
        $scope.isExpanded = bool;
    };

    $scope.setHeaderFab = function(location) {
        var hasHeaderFabLeft = false;
        var hasHeaderFabRight = false;

        switch (location) {
            case 'left':
                hasHeaderFabLeft = true;
                break;
            case 'right':
                hasHeaderFabRight = true;
                break;
        }

        $scope.hasHeaderFabLeft = hasHeaderFabLeft;
        $scope.hasHeaderFabRight = hasHeaderFabRight;
    };

    $scope.hasHeader = function() {
        var content = document.getElementsByTagName('ion-content');
        for (var i = 0; i < content.length; i++) {
            if (!content[i].classList.contains('has-header')) {
                content[i].classList.toggle('has-header');
            }
        }

    };

    $scope.hideHeader = function() {
        $scope.hideNavBar();
        $scope.noHeader();
    };

    $scope.showHeader = function() {
        $scope.showNavBar();
        $scope.hasHeader();
    };

    $scope.clearFabs = function() {
        var fabs = document.getElementsByClassName('button-fab');
        if (fabs.length && fabs.length > 1) {
            fabs[0].remove();
        }
    };

    //logout function
    $scope.logout = function() {
        AuthService.logout();
        $state.go('app.login');
    };



})

.controller('LoginCtrl', function($scope, $timeout, $state, $ionicPopup, AuthService, $ionicLoading, ionicMaterialInk, $ionicHistory,AppConfig) {

    alert(AppConfig.apiUrl);

    $scope.$parent.hideHeader();
    $scope.$parent.clearFabs();
    ionicMaterialInk.displayEffect();

    $scope.data = {};
    $scope.login = function(data) 
    {

        $ionicLoading.show({
            noBackdrop: true
        });

        AuthService.login($scope.data.username, $scope.data.pwd).then(function(response) {

                $ionicLoading.hide();
                $ionicHistory.currentView($ionicHistory.backView());
                $state.go('app.safetyLessons');
            },
            function(err_msg) {
                $ionicLoading.hide();
                $ionicPopup.alert({
                    title: 'Login failed!',
                    template: err_msg
                });

            });

    };


})


.controller('safetyLessonsCtrl', function($scope, $stateParams, $timeout, $state, ionicMaterialMotion, ionicMaterialInk, safetyLessons, $ionicPopup, $ionicLoading) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.$parent.setHeaderFab('left');
    $scope.isExpanded = false;
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);
    $scope.initNavMenu();

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



    $scope.showPopup = function() {
        $scope.data = {};

        // An elaborate, custom popup
        var myPopup = $ionicPopup.show({

            title: 'search safety lessons',
            subTitle: 'Are you want to download or view?',
            scope: $scope,
            buttons: [{
                text: 'download',
                type: 'button-assertive'
            }, {
                text: '<b>view</b>',
                type: 'button-positive'

            }]
        });
        $timeout(function() {
            myPopup.close(); 
        }, 3000);
    };

    // get lessons and map
    safetyLessons.all().then(function(data) {
        $scope.lessons = data;
        $ionicLoading.hide();


    });


})


.controller('LessonViewCtrl', function($scope, $stateParams, $state, $window, $http, safetyLessons, $ionicLoading,pdfUrls) {
    
    var lesson_id = $stateParams.id;
    $scope.lesson = safetyLessons.getLessonId( lesson_id );

    $scope.pdfpath = pdfUrls['lesson'];

    //console.log($scope.lesson);
    safetyLessons.getAttachment( lesson_id ).then(function(data) 
    {
        $scope.attachments = data;

    });

    $scope.signoff = function()
    {
        $state.go('app.signoff',{id:lesson_id});
    };


    $scope.toggleGroup = function(group) {
        if ($scope.isGroupShown(group)) {
          $scope.shownGroup = null;
        } else {
          $scope.shownGroup = group;
        }
    };
    $scope.isGroupShown = function(group) {
        return $scope.shownGroup === group;
    };
})


.controller('signoffCtrl', function($scope, $stateParams, $state, employeeDetails, $ionicPopup,$ionicHistory) {

    var lesson_id = $stateParams.id,
    
   
		client_id = window.localStorage.getItem('client_id'),
        user_id   = window.localStorage.getItem('user_id');
      
    //list of employee and their id from service
    employeeDetails.getEmployees( client_id ).then(function( response ) {
        $scope.employees = response;
    });

    //Autosuggest(typeahead) of employee name
    $scope.default_th_search = '';
    $scope.sel_employee = {};
    
    $scope.onItemSelected = function( emp ) {

      $scope.sel_employee = emp;

    };


    //signature pad functions
    var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)'
    });

    var cancelButton = document.getElementById('clear');

    cancelButton.addEventListener('click', function(event) {
        signaturePad.clear();
    });

    //submit button functionality
    $scope.save = function(data) 
    {  
		var sign = signaturePad.toDataURL('image/png');
		
		var error = '';
		
        if( $scope.sel_employee.id == undefined )
			error += "Please select employee.<br/>";
          
        if(signaturePad.isEmpty()) 
			error += "Please Sign!";
        
        if(error){
			$ionicPopup.alert({ title: 'Error',	template: error });
			return false; 
		}
        
        employeeDetails.trainingComplete( lesson_id, $scope.sel_employee.id , $scope.sel_employee.emp_id , client_id , sign).then(function(result) {
			
            var alertPopup = $ionicPopup.alert({ title: 'success',	template: result.message });
            
            alertPopup.then(function(res) {
				$ionicHistory.goBack();
		   });
        });
    }



})

.controller('pdfViewCtrl', function($scope,pdfDelegate, $stateParams, $timeout, ionicMaterialMotion, ionicMaterialInk, $ionicPopup, $ionicHistory,pdfUrls) {
    // Set Header
    if(!$stateParams.file_name)
        $ionicHistory.goBack();

    if($stateParams.filetype == 'repositary')
        $scope.pdfUrl = $stateParams.file_name;
    else    
        $scope.pdfUrl = pdfUrls[$stateParams.filetype] + $stateParams.file_name;

    //$scope.pdfUrl = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/149125/material-design-2.pdf';
    
    $timeout(function() {
         pdfDelegate.$getByHandle('my-pdf-container').load($scope.pdfUrl);
         pdfDelegate.$getByHandle('my-pdf-container').zoomIn(0.5);
         pdfDelegate.$getByHandle('my-pdf-container').zoomTo(5);
    }, 10000);
     
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.$parent.setHeaderFab('left');
    $scope.isExpanded = false;
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);
    $scope.initNavMenu();

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

})

.controller('WebinarsCtrl', function($scope, $state, $timeout, $http, WebinarService, $ionicLoading, ionicMaterialMotion) {

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
    $ionicLoading.show({
        noBackdrop: true
    });
    WebinarService.all().then(function(data) {
        $scope.webinars = data;
        $ionicLoading.hide();
    });


})

.controller('WebinarsViewCtrl', function($scope, $state, $stateParams, $http, WebinarService, $ionicLoading) {
    //single webinar view
    var WebinarId = $stateParams.id;
    $scope.webinar = WebinarService.getwebinarId(WebinarId);


    $scope.signoff = function() {

        $state.go('app.signoff');
    };


})


.controller('DocumentationCtrl', function($scope, $stateParams, $state, $ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion, DocumentationService) {
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
    DocumentationService.all().then(function(data) {
        $scope.documentations = data;
        $ionicLoading.hide();
    })

    //documentation content
    DocumentationService.content().then(function(data) {
        $scope.content = data;
        $ionicLoading.hide();
    });

})


.controller('InspectionReportCtrl', function($scope, $stateParams, $ionicLoading, $state, $timeout, ionicMaterialInk, ionicMaterialMotion, InspectionReportService) {
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


    $scope.signoff = function() {

        $state.go('app.signoff');
    };


    //Inspection Report list
    InspectionReportService.all().then(function(data) {
        $scope.Reports = data;
        $ionicLoading.hide();
    })

    //IspectionReport content
    InspectionReportService.content().then(function(data) {
        $scope.content = data;
        $ionicLoading.hide();
    });


})

.controller('300LogsCtrl', function($scope, $stateParams, $ionicLoading, $state, $timeout, ionicMaterialInk, ionicMaterialMotion, LogService) {
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


    $scope.signoff = function() {

        $state.go('app.signoff');
    };


    //Logs list
    LogService.all().then(function(data) {
        $scope.Logs = data;
        $ionicLoading.hide();
    })

    //Logs content
    LogService.content().then(function(data) {
        $scope.content = data;
        $ionicLoading.hide();
    });


})


.controller('TrainingRecordCtrl', function($scope, $stateParams, $state, $ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion, TrainingRecordService) {
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


    //signoff button redirect
    $scope.signoff = function() {

        $state.go('app.signoff');
    };


    //Logs list
    TrainingRecordService.all().then(function(data) {
        $scope.Records = data;
        $ionicLoading.hide();
    })

    //Logs content
    TrainingRecordService.content().then(function(data) {
        $scope.content = data;
        $ionicLoading.hide();
    });


})

.controller('FormsCtrl', function($scope, $stateParams, $state, $ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion, FormService) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
   
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
    FormService.all().then(function(data) {
        $scope.Forms = data;
        $ionicLoading.hide();
    });


    $scope.signoff = function() {

        $state.go('app.signoff');
    };


    //forms content
    FormService.content().then(function(data) {
        $scope.content = data;
        $ionicLoading.hide();
    });


})


.controller('safetyPostersCtrl', function($scope, $stateParams, $state, $timeout, ionicMaterialMotion, ionicMaterialInk, safetyPosters, $ionicPopup, $ionicLoading) {
    // Set Header
    $scope.$parent.showHeader();
    $scope.$parent.clearFabs();
    $scope.isExpanded = true;
    $scope.$parent.setExpanded(false);
    $scope.$parent.setHeaderFab(false);
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

    $scope.showPopup = function() {
        $scope.data = {};

        // An elaborate, custom popup
        var myPopup = $ionicPopup.show({

            title: 'search safety lessons',
            subTitle: 'Are you want to download or view?',
            scope: $scope,
            buttons: [{
                text: 'download',
                type: 'button-assertive'
            }, {
                text: '<b>view</b>',
                type: 'button-positive'

            }]
        });
        $timeout(function() {
            myPopup.close(); //close the popup after 3 seconds for some reason
        }, 3000);
    };

    // list of safety posters
    safetyPosters.all().then(function(data) {
        $scope.posters = data;
        $ionicLoading.hide();


    });

})


.controller('safetyPosterViewCtrl', function($scope, $stateParams, $state, $window, $http, safetyPosters, $ionicLoading) {
    var poster_id =  $stateParams.id;
    $scope.poster =  safetyPosters.getPosterId( poster_id );

    safetyPosters.getAttachment( poster_id ).then(function(data) {
        $scope.attachments = data;

    });

    $scope.toggleGroup = function(group) {
        if ($scope.isGroupShown(group)) {
          $scope.shownGroup = null;
        } else {
          $scope.shownGroup = group;
        }
    };
    $scope.isGroupShown = function(group) {
        return $scope.shownGroup === group;
    };

})



.controller('OptionsTreeController', ['$scope','$ionicModal','$state','RepositoryService', function ($scope,$ionicModal,$state,RepositoryService) {
    
    $scope.client_name = window.localStorage.getItem('client_name');

    function init() {
		RepositoryService.all( $scope.client_name ).then(function(data)
		{
			$scope.treeNodes = data; 
			
		});
      
        $scope.options = { multipleSelect: true, showIcon: false };

        $scope.options1 = { showIcon: true, expandOnClick: false };

    }
    init();

    $scope.$on('selection-changed', function (e, nodes) {

        if (nodes.length > 0) {
			
            $scope.selectedNodes = nodes;
        } else {
			
            $scope.selectedNode = nodes;
            
            if($scope.selectedNode.ext != undefined && $scope.selectedNode.ext != ""){

				if($scope.selectedNode.ext == 'pdf'){
                    $state.go('app.pdfView', { file_name: $scope.selectedNode.url, filetype:'repositary'});
				}
				else if($scope.selectedNode.ext == 'mp3') {

                    window.open(encodeURI($scope.selectedNode.url),'_system','location=yes');
				}
				else if($scope.selectedNode.ext == 'mp4') {

                    window.open(encodeURI($scope.selectedNode.url),'_system','location=yes');
				}
				else 
                {
                   $scope.modal = $ionicModal.fromTemplate('<div class="image-modal transparent"><i class="imageclose icon ion-close-circled" ng-click = "closeModal()"></i><ion-pane class="transparent item-icon-right"><img ng-src="'+$scope.selectedNode.url+'" class="fullscreen-image"/></ion-pane></div>', {
                        scope: $scope,
                        animation: 'slide-in-up'
                    });

                    $scope.openModal = function() {
                      $scope.modal.show();
                    };

                    $scope.closeModal = function() {
                      $scope.modal.hide();
                      
                    };

                    //Cleanup the modal when we're done with it!
                    $scope.$on('$destroy', function() {
                      $scope.modal.remove();
                    });
                    // Execute action on hide modal
                    $scope.$on('modal.hide', function() {
                      $scope.modal.remove();
                    });
                    // Execute action on remove modal
                    $scope.$on('modal.removed', function() {
                      // Execute action
                    });      
                    $scope.openModal();

				}
								
			} 
            
        }
    });

   
}]);
