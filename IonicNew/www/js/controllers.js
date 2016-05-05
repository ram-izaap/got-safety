/* global angular, document, window */
'use strict';

angular.module('starter.controllers', [])

.controller('AppCtrl', function($scope, $ionicModal, $ionicPopover, $timeout,pdfDelegate, AuthService,$state) {

      //pdf viewer
      $scope.pdfUrl = 'pdf/mypdf.pdf';
      //http://localhost:8100/got-safety/assets/images/admin/lession_attachment/English_ATV_Safety.pdf

      $scope.loadNewFile = function(url)
      {
        pdfDelegate
          .$getByHandle('my-pdf-container')
          .load(url);
      };
       

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




.controller('signoffCtrl', function($scope,employeeDetails)
{
      //list of employee and their id from service
      employeeDetails.employee().then(function(data)
      {
        $scope.items = data;

      });

      //Autosuggest of employee name
      $scope.emp   = {};
      $scope.empId = '';
      $scope.onItemSelected = function(emp)
      {
        
         $scope.empId = $scope.emp.id;
         //$scope.UserName = $scope.emp.name;     
         console.log('selected='+$scope.empId);
       window.localStorage.setItem("empid", $scope.empId);
      
          
      }

      //signature pad functions
       var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
        backgroundColor: 'rgba(255, 255, 255, 0)',
        penColor: 'rgb(0, 0, 0)'
      });
     
      var saveButton   = document.getElementById('save');
      var cancelButton = document.getElementById('clear');

      saveButton.addEventListener('click', function (event)
      {
        var sign = signaturePad.toDataURL('image/png');

        window.open(sign);
      });

      cancelButton.addEventListener('click', function (event) 
      {
        signaturePad.clear();
      });

      //submit button functionality
      $scope.save = function(data)
      {
         employeeDetails.SaveSign().then(function(result)
         {
           alert(result);

          });
      }


      
})


  


.controller('safetyLessonsCtrl', function($scope, $stateParams, $timeout,$state, ionicMaterialMotion, ionicMaterialInk, safetyLessons, $ionicPopup, $ionicLoading) {
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

    $scope.signoff = function() 
    {
      
      $state.go('app.signoff');
    };

})


.controller('LessonViewCtrl', function($scope, $stateParams,  $window, $http, safetyLessons, $ionicLoading) 
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

     $scope.signoff = function() 
     {
      
      $state.go('app.signoff');
     };

})

.controller('WebinarsViewCtrl', function($scope, $state, $stateParams, $http, WebinarService, $ionicLoading) 
{
      //single webinar view
      $ionicLoading.show({ noBackdrop:true });
      var WebinarId   = $stateParams.id;
      $scope.webinars = WebinarService.get(WebinarId);

})


.controller('DocumentationCtrl', function($scope, $stateParams,$state,$ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion,DocumentationService) {
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

     $scope.signoff = function() 
    {
      
      $state.go('app.signoff');
    };

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


.controller('InspectionReportCtrl', function($scope, $stateParams,$ionicLoading,$state, $timeout, ionicMaterialInk, ionicMaterialMotion,InspectionReportService) {
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

     $scope.signoff = function() 
    {
      
      $state.go('app.signoff');
    };

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



.controller('300LogsCtrl', function($scope, $stateParams,$ionicLoading,$state, $timeout, ionicMaterialInk, ionicMaterialMotion,LogService) {
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

     $scope.signoff = function() 
    {
      
      $state.go('app.signoff');
    };

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


.controller('TrainingRecordCtrl', function($scope, $stateParams,$state,$ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion,TrainingRecordService) {
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
    $scope.signoff = function() 
    {
      
      $state.go('app.signoff');
    };

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




.controller('FormsCtrl', function($scope, $stateParams,$state,$ionicLoading, $timeout, ionicMaterialInk, ionicMaterialMotion, FormService) {
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

    $scope.signoff = function() 
    {
      
      $state.go('app.signoff');
    };

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



.controller('SafetyPostersCtrl', function($scope, $stateParams,$state, $timeout, ionicMaterialMotion, ionicMaterialInk, SafetyPosters, $ionicPopup, $ionicLoading) {
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

    $scope.signoff = function() 
    {
      
      $state.go('app.signoff');
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

.controller('PdfCtrl', [
    '$scope',
    '$element',
    '$attrs',
    'pdfDelegate',
    '$log',
    '$q',
  function($scope, $element, $attrs, pdfDelegate, $log, $q) {

    // Register the instance!
    var deregisterInstance = pdfDelegate._registerInstance(this, $attrs.delegateHandle);
    // De-Register on destory!
    $scope.$on('$destroy', deregisterInstance);

    var self = this;

    var url = $scope.$eval($attrs.url);
    var headers = $scope.$eval($attrs.headers);
    var pdfDoc;
    $scope.pageCount = 0;
    var currentPage = 1;
    var angle = 0;
    var scale = $attrs.scale ? $attrs.scale : 1;
    var canvas = $element.find('canvas')[0];
    var ctx = canvas.getContext('2d');

    var renderPage = function(num) {
      if (!angular.isNumber(num))
        num = parseInt(num);
      pdfDoc
        .getPage(num)
        .then(function(page) {
          var viewport = page.getViewport(scale);
          canvas.height = viewport.height;
          canvas.width = viewport.width;

          var renderContext = {
            canvasContext: ctx,
            viewport: viewport
          };

          page.render(renderContext);
        });
    };

    var transform = function() {
      canvas.style.webkitTransform = 'rotate('+ angle + 'deg)';
      canvas.style.MozTransform = 'rotate('+ angle + 'deg)';
      canvas.style.msTransform = 'rotate('+ angle + 'deg)';
      canvas.style.OTransform = 'rotate('+ angle + 'deg)';
      canvas.style.transform = 'rotate('+ angle + 'deg)';
    };

    self.prev = function() {
      if (currentPage <= 1)
        return;
      currentPage = parseInt(currentPage, 10) - 1;
      renderPage(currentPage);
    };

    self.next = function() {
      if (currentPage >= pdfDoc.numPages)
        return;
      currentPage = parseInt(currentPage, 10) + 1;
      renderPage(currentPage);
    };

    self.zoomIn = function(amount) {
      amount = amount || 0.2;
      scale = parseFloat(scale) + amount;
      renderPage(currentPage);
      return scale;
    };

    self.zoomOut = function(amount) {
      amount = amount || 0.2;
      scale = parseFloat(scale) - amount;
      scale = (scale > 0) ? scale : 0.1;
      renderPage(currentPage);
      return scale;
    };

    self.zoomTo = function(zoomToScale) {
      zoomToScale = (zoomToScale) ? zoomToScale : 1.0;
      scale = parseFloat(zoomToScale);
      renderPage(currentPage);
      return scale;
    };

    self.rotate = function() {
      if (angle === 0) {
        angle = 90;
      } else if (angle === 90) {
        angle = 180;
      } else if (angle === 180) {
        angle = 270;
      } else {
        angle = 0
      }
      transform();
    };

    self.getPageCount = function() {
      return $scope.pageCount;
    };

    self.getCurrentPage = function () {
      return currentPage;
    };

    self.goToPage = function(newVal) {
      if (pdfDoc !== null) {
        currentPage = newVal;
        renderPage(newVal);
      }
    };

    self.load = function(_url) {
      if (_url) {
        url = _url;
      }

      var docInitParams = {};

      if (typeof url === 'string') {
        docInitParams.url = url;
      } else {
        // use Uint8Array or request like `{data: new Uint8Array()}`.  See pdf.js for more details.
        docInitParams.data = url;
      }

      if (headers) {
        docInitParams.httpHeaders = headers;
      }

      return PDFJS
        .getDocument(docInitParams)
        .then(function (_pdfDoc) {

          pdfDoc = _pdfDoc;
          renderPage(1);
          $scope.$apply(function() {
            $scope.pageCount = _pdfDoc.numPages;
          });

        }, function(error) {
            $log.error(error);
            return $q.reject(error);
        })
    };

    if(url) self.load();
}]);

