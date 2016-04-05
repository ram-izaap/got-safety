angular.module('starter.services', [])
//service for authentication
.service('AuthService', function($q, $http, apiUrl) {
  
  var isAuthenticated = true;
  var LOCAL_TOKEN_KEY = 'user_credentials';
 

  function loadUserCredentials() 
  {   
    var uc = window.localStorage.getItem(LOCAL_TOKEN_KEY);
    if (uc) 
    {
      useCredentials(uc);

    }
  }
 

  function storeUserCredentials(uc) 
  {
    window.localStorage.setItem( LOCAL_TOKEN_KEY,uc);
    useCredentials(uc);
  }

  function useCredentials(uc) 
  {
    isAuthenticated = true;
    console.log(uc);
    
  
    // Set the uc as header for your requests!
    $http.defaults.headers.common.uid = uc.uid;
    $http.defaults.headers.common.authorizationToken = uc.authorizationToken;
  }

  function destroyUserCredentials() 
  {
    isAuthenticated = false;
    $http.defaults.headers.common.uid = undefined;
    $http.defaults.headers.common.authorizationToken = undefined;
    window.localStorage.removeItem( LOCAL_TOKEN_KEY);
  }
 
  var login = function(name, password)
  {
  
    return $q(function(resolve, reject) 
    {

          $http.post(apiUrl+'/login', { 'name': name, 'password': password},{ ignoreAuthModule: true }).then(function(response)
          {
                      
                       var res       = response.data;
                       var UserId    = res.user_id;
                       var CreatedId = res.created_id;

                      //store userid and created id in localstorage
                      window.localStorage.setItem("Userid", UserId);
                      window.localStorage.setItem("Createdid", CreatedId);
                                       
                       var status = res.status;
                      
                      storeUserCredentials(response.data); 
                      
                      if(status=='success')
                        resolve('Login success.');
                      else
                        reject();    
                 
        },
        function()
        {
            reject('Login Failed.');
          
        });

      
    });
  
  };

  var logout = function() 
  {
    destroyUserCredentials();
  };

  loadUserCredentials();

  return {
    login: login,
    logout: logout,
    isAuthenticated: function() {return isAuthenticated;}
  };

})


.factory('AuthInterceptor', function ($rootScope, $q, AUTH_EVENTS) {
  return {
    responseError: function (response) {
      $rootScope.$broadcast({
        401: AUTH_EVENTS.notAuthenticated
      }[response.status], response);
      return $q.reject(response);

    }
  };
})

.config(function ($httpProvider) {
  $httpProvider.interceptors.push('AuthInterceptor');
})


  //service for safety lessons
.factory('safetyLessons', function($http, apiUrl)
 {

  var lessons           = [];
  var Attachment        = [];
  //var SpanishAttachment = [];
  //var EnglishAttachment = [];
  
 

  return {

              all: function() 
              {
                   var C_id = window.localStorage.getItem("Createdid");
                   var U_id = window.localStorage.getItem("Userid");

                    return $http.get(apiUrl+'/get_user_lesson_list?created_id='+C_id+'&user_id='+U_id+'').then(function(response)
                    {
                        var lessons_data   = response.data;
                        var lessons_array  = lessons_data.lessons;
                            
                            if(lessons_array.length > 0)
                            {
                               for(var j = 0; j < lessons_array.length; j++)
                               {                              
                                  //alert(usr[1].id);
                                  lessons[j] = lessons_array[j];
                               }
                            }
                        
                        return lessons;   
                       
                    });
                 
              },
             
              GetLesson: function( LessonId )
             {
      
                 for (var i = 0; i < lessons.length; i++) 
                  {
                        if(lessons[i].id == LessonId)
                        {
                          return lessons[i];

                        }
                  
                  };
                 window.localStorage.setItem("lessonid", LessonId);
              },


              GetAttachment: function() 
              {
                var Lessonid = window.localStorage.getItem("lessonid");
                var U_id     = window.localStorage.getItem("Userid");   
                    
                    return $http.get(apiUrl+'/get_lesson_attachment?lesson_id='+Lessonid+'&user_id='+U_id+'').then(function(response)
                    {
                        var attachment_array   = response.data;
                       
                        var usr                = attachment_array.user;
                        

                           if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {                               
                                  Attachment[j] = usr[j];
                               }
                            } 
 
                        return Attachment;  

                    });
                 
              },


           /*   GetEnglishAttachment: function() 
              {
                    
                    return $http.get(apiUrl+'/get_lesson_attachment?lesson_id=13&user_id=29&X-APP-KEY=test').then(function(response)
                    {
                        var attachment_array   = response.data;
                       
                        var usr                = attachment_array.user;
                        
                       

                           if(usr.length > 0)
                            {
                               
                                //alert(usr[0].language);
                                  EnglishAttachment[0] = usr[0];
                      
                            } 
 
                        return EnglishAttachment;  

                    });
                 
              },


               GetSpanishAttachment: function() 
              {
                    
                    return $http.get(apiUrl+'/get_lesson_attachment?lesson_id=13&user_id=29&X-APP-KEY=test').then(function(response)
                    {
                        var attachment_array   = response.data;
                       
                        var usr                = attachment_array.user;
                        
                       
                           if(usr.length > 0)
                            {
                               
                                //alert(usr[0].language);
                                  SpanishAttachment[1] = usr[1];
                      
                            } 
 
                        return SpanishAttachment;  

                    });
                 
              },*/


          }; 

})



 //service for webinars
.factory('WebinarService', function($http, apiUrl)
 {

  var webinars = [];
  return {
              all: function() 
              {

                   var C_id = window.localStorage.getItem("Createdid");
                   var U_id = window.localStorage.getItem("Userid");

                   return $http.get(apiUrl+'/get_user_webinars_list?created_id='+C_id+'&user_id='+U_id+'').then(function(response)
                   {
                        var webinars_array   = response.data;
                        var usr              = webinars_array.user;
                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {                                                          
                                    webinars[j] = usr[j];
                               }
                            }
                        
                        return webinars; 
                        

                  });
                 
              },
             
              get: function( WebinarId)
              {
                  for (var i = 0; i < webinars.length; i++) 
                  {
                        if(webinars[i].id == WebinarId )
                        {
                         
                           return webinars[i];

                        }
                    
                  };
                
                 
              },

        }; 

})


//service for documentation
.factory('DocumentationService', function($http, apiUrl)
 {

  var Documentations = [];
  
  return {
              //list of documentation
              all: function() 
              {
                   var C_id = window.localStorage.getItem("Createdid");
                   var U_id = window.localStorage.getItem("Userid");

                    return $http.get(apiUrl+'/get_user_menu_list?created_id='+C_id+'&user_id='+U_id+'&type=document').then(function(response)
                    {
                      
                        var doc_arr   = response.data;                      
                        var usr = doc_arr.user;
                       // alert(usr.length);
                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {                             
                                  // alert(usr[0].id);                               
                                  Documentations[j] = usr[j];
                               }
                            }
                        
                        return Documentations; 
                        

                    });
                 
              },
             
           

           //documentation content
           content: function()
           { 
                  
                 return $http.get(apiUrl+'/get_content?type=5').then(function(response)
                 {
                      
                        var content_res    = response.data;
                        var user           = content_res.user;
                        var content          = user;
                        

                        return content;
                      
                       
                 });
               
           },
         
     }; 

})


//service for InspectionReport
.factory('InspectionReportService', function($http, apiUrl)
 {

  var Reports = [];
  
  return {
              //list of reports
              all: function() 
              {
                   var C_id = window.localStorage.getItem("Createdid");
                   var U_id = window.localStorage.getItem("Userid");

                    return $http.get(apiUrl+'/get_user_menu_list?created_id='+C_id+'&user_id='+U_id+'&type=report').then(function(response)
                    {
                      
                        var doc_arr   = response.data;                      
                        var usr = doc_arr.user;
                       // alert(usr.length);
                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {
                                    // alert(usr[0].id);                               
                                    Reports[j] = usr[j];
                               }
                            }
                        
                        return Reports; 
                        

                    });
                 
              },
             
       

           //Report content
           content: function()
           { 
                  
                 return $http.get(apiUrl+'/get_content?type=1').then(function(response)
                 {
                      
                        var content_res   = response.data;
                        var user          = content_res.user;
                        var content         = user;
                        

                        return content;
                      
                       
                 });
               
           },
         
     }; 

})



//service for Training records
.factory('TrainingRecordService', function($http, apiUrl)
 {

  var Records = [];
  
  return {
              //list of records
              all: function() 
              {
                   var C_id = window.localStorage.getItem("Createdid");
                   var U_id = window.localStorage.getItem("Userid");

                    return $http.get(apiUrl+'/get_user_menu_list?created_id='+C_id+'&user_id='+U_id+'&type=record').then(function(response)
                    {
                      
                        var doc_arr   = response.data;                      
                        var usr = doc_arr.user;
                       // alert(usr.length);
                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {
                                    // alert(usr[0].id);                               
                                    Records[j] = usr[j];
                               }
                            }
                        
                        return Records; 
                        

                    });
                 
              },
             
       

           //records content
           content: function()
           { 
                  
                 return $http.get(apiUrl+'/get_content?type=4').then(function(response)
                 {
                      
                        var content_res   = response.data;
                        var user          = content_res.user;
                        var content       = user;
                        

                        return content;
                      
                       
                 });
               
           },
         
     }; 

})


//service for 300logs
.factory('LogService', function($http, apiUrl)
 {

  var Logs = [];
  
  return {
              //list of logs
              all: function() 
              {
                   var C_id = window.localStorage.getItem("Createdid");
                   var U_id = window.localStorage.getItem("Userid");

                    return $http.get(apiUrl+'/get_user_menu_list?created_id='+C_id+'&user_id='+U_id+'&type=log').then(function(response)
                    {
                      
                        var doc_arr   = response.data;                      
                        var usr = doc_arr.user;
                       // alert(usr.length);
                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {
                                  // alert(usr[0].id);                               
                                  Logs[j] = usr[j];
                               }
                            }
                        
                        return Logs; 
                        

                    });
                 
              },
             

           //log content
           content: function()
           { 
                  
                 return $http.get(apiUrl+'/get_content?type=3').then(function(response)
                 {
                      
                        var content_res   = response.data;
                        var user          = content_res.user;
                        var content        = user;
                        

                        return content;
                      
                       
                 });
               
           },
         
     }; 

})




.factory('FormService', function($http, apiUrl)
 {

  var Forms = [];
  
  return {
              all: function() 
              {
                  var C_id = window.localStorage.getItem("Createdid");
                  var U_id = window.localStorage.getItem("Userid");

                    return $http.get(apiUrl+'/get_user_menu_list?created_id='+C_id+'&user_id='+U_id+'&type=forms').then(function(response)
                    {
                      
                        var Forms_arr   = response.data;                 
                        var usr = Forms_arr.user;
                       // alert(usr.length);
                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {
                            
                                  // alert(usr[0].id);                               
                                  Forms[j] = usr[j];
                               }
                            }
                        
                        return Forms; 
                       

                    });
                 
              },
             
             

              content: function()
             { 
                  
                 return $http.get(apiUrl+'/get_content?type=5').then(function(response)
                    {
                      
                        var content_res   = response.data;
                        var user          = content_res.user;
                        var content       = user;
                        
                      return content;
                      
                       
                    });
              
              },
         

        }; 

})


  //service for safety posters 
.factory('SafetyPosters', function($http, apiUrl)
 {

  var posters           = [];
  var Attachment        = [];
 
 

  return {

              all: function() 
              {
                   var C_id = window.localStorage.getItem("Createdid");
                   var U_id = window.localStorage.getItem("Userid");

                    return $http.get(apiUrl+'/get_user_posters_list?created_id='+C_id+'&user_id='+U_id+'').then(function(response)
                    {
                        var posters_array   = response.data;
                        var usr             = posters_array.user;

                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {
                                 //alert(usr[1].id);                               
                                  posters [j] = usr[j];
                               }
                            }
                        
                        return posters;   
                       
                    });
                 
              },
             
              GetPoster: function( PosterId )
             {
      
                 for (var i = 0; i < posters.length; i++) 
                  {
                        if(posters[i].id == PosterId)
                        {
                          return posters[i];

                        }
                  
                  };
                 window.localStorage.setItem("posterid", PosterId);
              },


              GetAttachment: function() 
              {
                var Posterid = window.localStorage.getItem("posterid");

                    return $http.get(apiUrl+'/get_posters_attachment?poster_id='+Posterid).then(function(response)
                    {
                        var attachment_array   = response.data;
                       
                        var usr                = attachment_array.user;
                        

                           if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {                               
                                  Attachment[j] = usr[j];
                               }
                            } 
 
                        return Attachment;  

                    });
                 
              },



          }; 

});