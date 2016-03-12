angular.module('starter.services', [])

.service('AuthService', function($q, $http, apiUrl) {
  var LOCAL_TOKEN_KEY = 'user_credentials';
  var isAuthenticated = true;

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
    window.localStorage.setItem(LOCAL_TOKEN_KEY, uc);
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
    window.localStorage.removeItem(LOCAL_TOKEN_KEY);
  }

  var login = function(name, pw) {

    return $q(function(resolve, reject) {

      $http.post(apiUrl+'/auth', { username:name, password:pw },{ ignoreAuthModule: true }).then(function(response){
        storeUserCredentials(response.data);
        resolve('Login success.');
      },
      function(){
        reject('Login Failed.');
      });

      
    });
  };

  var logout = function() {
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



.factory('safetyLessons', function($http, apiUrl)
 {

  var lessons = [];
  return {
              all: function() 
              {
                    return $http.get(apiUrl+'/get_user_lesson_list?created_id=8&user_id=29&X-APP-KEY=test').then(function(response)
                    {
                        var l   = response.data;
                        var usr = l.user;
                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {
                                  if(j>1)
                                  break;
                                 //alert(usr[1].id);
                                  //safety.push(usr[j]);
                                  lessons[j] = usr[j];
                               }
                            }
                        
                        return lessons;   

                    });
                 
              },
             
              get: function( LessonId )
             {
      
                 for (var i = 0; i < lessons.length; i++) 
                  {
                        if(lessons[i].id == LessonId)
                        {
                          return lessons[i];

                        }
                  
                  };
                
              },

             
             



          }; 

})




.factory('WebinarService', function($http, apiUrl)
 {

  var webinars = [];
  return {
              all: function() 
              {
                    return $http.get(apiUrl+'/get_user_webinars_list?created_id=8&user_id=29&X-APP-KEY=test').then(function(response)
                    {
                        var l   = response.data;
                        var usr = l.user;
                            
                            if(usr.length > 0)
                            {
                               for(var j = 0; j < usr.length; j++)
                               {
                                if(j>1)
                                break;
                               //alert(usr[1].id);                               
                             // webinars.push(usr[j]);
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





.factory('broadcast', function ($rootScope, $document) {
    var _events = {
        onPause: 'onPause',
        onResume: 'onResume'
    };
    $document.bind('resume', function () {
        _publish(_events.onResume, null);
    });
    $document.bind('pause', function () {
        _publish(_events.onPause, null);
    });

    function _publish(eventName, data) {
        $rootScope.$broadcast(eventName, data)
    }
    return {
        events: _events
    }
});
/*.factory('safetyLessons', function($http, apiUrl) {

  var safety = [];
  return {
    get: function() {

        return $http.post(apiUrl+'/get_user_lesson_list',{ 'user_id':'38', 'created_id':'29', 'X-APP-KEY': 'test'}).then(function(response)
        {
          
           safety = response.data.result;
          
        });
       
    },JSON.stringify
  };
})

.factory('News', function($http, apiUrl) {

  var news = [];

  return {
    all: function() {

          return $http.get(apiUrl+'/categories').then(function(response){
            news = JSON.parse(response.data.result);
            news.splice(0, 2);

            var lic = window.localStorage.getItem("cats_last_item_count");
                lic = Array.isArray(lic)?lic:[];

            for(var i=0;i<news.length;i++)
            {
                var last_count = news[i].ItemCount;
                for(var j=0;j<lic.length;j++)
                {
                  if(news[i].ID == lic[j].ID)
                  {
                    last_count = lic[j].ItemCount;
                    break;
                  }
                }

                var new_items = news[i].ItemCount - last_count;
                news[i].NewItems = (new_items >= 0)?new_items:0;

            }   

            window.localStorage.setItem("cats_last_item_count", news);

            return news;
          });
    },

    get: function( newsId, itemsShown ) {
      return $http.get(apiUrl+'/categories/'+newsId+'/'+itemsShown).then(function(response){
        news = JSON.parse(response.data.result);
        return news;
      });

    },

    getAdSpace:function(){
      return $http.get(apiUrl+'/adspace').then(function(response){
        var source = '',
            tmp = JSON.parse(response.data.result);
        if( Array.isArray(tmp) && tmp.length )
        {
           if ( tmp[0].Source != undefined )
            source = tmp[0].Source;
            source = source.replace('<img', '<img class="img-responsive"');
        }
        return source;
      });
    }

  };

})


.factory('Weeklypickle', function($http, apiUrl) {

  var wpickle = [];
  return {
    get: function() {

    return $http.get(apiUrl+'/categories/1').then(function(response){
      wpickle = JSON.parse(response.data.result);
      
      return wpickle;
    });
       
    },
  };
})

.factory('Safetylessonpickle', function($http, apiUrl) {

  var safety = [];
  return {
    get: function() {

        return $http.get(apiUrl+'/categories/2').then(function(response){
          var tmp = JSON.parse(response.data.result);
          
          if(tmp.length > 0){
            for(var j = 0; j < tmp.length; j++){
              if(j>1)
                break;
              
              safety.push(tmp[j]);
            }
          } 
          return safety;
        });
       
    },
  };
})
*/