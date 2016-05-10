angular.module('starter.services', [])

//service for authentication
.service('AuthService', function($q, $http, apiUrl) {

    var isAuthenticated = true;
    var LOCAL_TOKEN_KEY = 'user_credentials';


    function loadUserCredentials() {
        var uc = window.localStorage.getItem(LOCAL_TOKEN_KEY);
        if (uc) {
            useCredentials(uc);

        }
    }


    function storeUserCredentials(uc) {
        window.localStorage.setItem(LOCAL_TOKEN_KEY, uc);
        useCredentials(uc);
    }

    function useCredentials(uc) {
        isAuthenticated = true;
        console.log(uc);


        // Set the uc as header for your requests!
        $http.defaults.headers.common.uid = uc.uid;
        $http.defaults.headers.common.authorizationToken = uc.authorizationToken;
    }

    function destroyUserCredentials() {
        isAuthenticated = false;
        $http.defaults.headers.common.uid = undefined;
        $http.defaults.headers.common.authorizationToken = undefined;
        window.localStorage.removeItem(LOCAL_TOKEN_KEY);
    }

    var login = function(name, password) {

        return $q(function(resolve, reject) {

            $http.post(apiUrl + 'user/login', {
                    'name': name,
                    'password': password
                }, {
                    ignoreAuthModule: true
                })
                .then(function(response) 
                {
                    var user_data = response.data;
                    console.log(user_data);
                    if( user_data.status != undefined && user_data.status == 'SUCCESS' )
                    {

                      //store userid and clientid in localstorage
                      window.localStorage.setItem("user_id", user_data.id);
                      window.localStorage.setItem("client_id", user_data.created_id);

                      storeUserCredentials( user_data );

                      resolve('SUCCESS');
                    }
                    else if( user_data.message != undefined )
                    {
                      reject( user_data.message );
                    }
                    else
                    {
                      reject( 'Unknown Error.' );
                    }

                    },
                    function() 
                    {
                      reject( 'There is some connectivity issue .Please try again later.' );
                    }
                );


        });

    };

    var logout = function() {
        destroyUserCredentials();
    };

    loadUserCredentials();

    return {
        login: login,
        logout: logout,
        isAuthenticated: function() {
            return isAuthenticated;
        }
    };

})

.factory('AuthInterceptor', function($rootScope, $q, AUTH_EVENTS) {
    return {
        responseError: function(response) {
            $rootScope.$broadcast({
                401: AUTH_EVENTS.notAuthenticated
            }[response.status], response);
            return $q.reject(response);

        }
    };
})

.config(function($httpProvider) {
    $httpProvider.interceptors.push('AuthInterceptor');
})




//service for safety lessons
.factory('safetyLessons', function($http, apiUrl) {

    var lessons = [];
    var Attachment = [];
   



    return {

        all: function() {
            var client_id = window.localStorage.getItem("client_id");

            return $http.get(apiUrl + 'lesson/list?client_id=' + client_id).then(function(response) {
                var data = response.data;

                if( data.lessons != undefined )
                {
                    lessons = data.lessons;
                }

                return lessons;

            });

        },

       getLessonId: function(LessonId) {

            for (var i = 0; i < lessons.length; i++) {
                if (lessons[i].id == LessonId) {
                    return lessons[i];

                }

           };
           // window.localStorage.setItem("lessonid", LessonId);
       }, 

        getAttachment: function( lesson_id ) {
            

            return $http.get(apiUrl + 'lesson/attachment?lesson_id=' + lesson_id ).then(function(response) {
                var data = response.data;

                if( data.attachments == undefined )
                {
                  return [];
                }

                return data.attachments;

            });

        }
    };

})



//service for webinars
.factory('WebinarService', function($http, apiUrl) {



    return {

        all: function() {
            var client_id = window.localStorage.getItem("client_id");

            return $http.get(apiUrl + 'webinars/list?client_id=' + client_id).then(function(response) {
                var data =response.data;
               // alert(data);

                if( data.webinars != undefined )
                {
                    webinars = data.webinars;
                }

                return webinars;

            });

        },

       getwebinarId: function(webinarId) {

            for (var i = 0; i < webinars.length; i++) {
                if (webinars[i].id == webinarId) {
                    return webinars[i];

                }

           };
           // window.localStorage.setItem("lessonid", LessonId);
       }
    };

})





//service for documentation
.factory('DocumentationService', function($http, apiUrl) {

    var Documentations = [];

    return {
        //list of documentation
        all: function() {
            var C_id = window.localStorage.getItem("Createdid");
            var U_id = window.localStorage.getItem("Userid");

            return $http.get('http://localhost/got-safety/api/get_user_menu_list?created_id=' + C_id + '&user_id=' + U_id + '&type=document').then(function(response) {

                var doc_arr = response.data;
                var usr = doc_arr.user;
                // alert(usr.length);

                if (usr.length > 0) {
                    for (var j = 0; j < usr.length; j++) {
                        // alert(usr[0].id);                               
                        Documentations[j] = usr[j];
                    }
                }

                return Documentations;


            });

        },



        //documentation content
        content: function() {

            return $http.get('http://localhost/got-safety/api/get_content?type=5').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;


                return content;


            });

        },

    };

})


//service for InspectionReport
.factory('InspectionReportService', function($http, apiUrl) {

    var Reports = [];

    return {
        //list of reports
        all: function() {
            var C_id = window.localStorage.getItem("Createdid");
            var U_id = window.localStorage.getItem("Userid");

            return $http.get('http://localhost/got-safety/api/get_user_menu_list?created_id=' + C_id + '&user_id=' + U_id + '&type=report').then(function(response) {

                var doc_arr = response.data;
                var usr = doc_arr.user;
                // alert(usr.length);

                if (usr.length > 0) {
                    for (var j = 0; j < usr.length; j++) {
                        // alert(usr[0].id);                               
                        Reports[j] = usr[j];
                    }
                }

                return Reports;


            });

        },



        //Report content
        content: function() {

            return $http.get('http://localhost/got-safety/api/get_content?type=1').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;


                return content;


            });

        },

    };

})



//service for Training records
.factory('TrainingRecordService', function($http, apiUrl) {

    var Records = [];

    return {
        //list of records
        all: function() {
            var C_id = window.localStorage.getItem("Createdid");
            var U_id = window.localStorage.getItem("Userid");

            return $http.get('http://localhost/got-safety/api/get_user_menu_list?created_id=' + C_id + '&user_id=' + U_id + '&type=record').then(function(response) {

                var doc_arr = response.data;
                var usr = doc_arr.user;
                // alert(usr.length);

                if (usr.length > 0) {
                    for (var j = 0; j < usr.length; j++) {
                        // alert(usr[0].id);                               
                        Records[j] = usr[j];
                    }
                }

                return Records;


            });

        },



        //records content
        content: function() {

            return $http.get('http://localhost/got-safety/api/get_content?type=4').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;


                return content;


            });

        },

    };

})


//service for 300logs
.factory('LogService', function($http, apiUrl) {

    var Logs = [];

    return {
        //list of logs
        all: function() {
            var C_id = window.localStorage.getItem("Createdid");
            var U_id = window.localStorage.getItem("Userid");

            return $http.get('http://localhost/got-safety/api/get_user_menu_list?created_id=' + C_id + '&user_id=' + U_id + '&type=log').then(function(response) {

                var doc_arr = response.data;
                var usr = doc_arr.user;
                // alert(usr.length);

                if (usr.length > 0) {
                    for (var j = 0; j < usr.length; j++) {
                        // alert(usr[0].id);                               
                        Logs[j] = usr[j];
                    }
                }

                return Logs;


            });

        },


        //log content
        content: function() {

            return $http.get('http://localhost/got-safety/api/get_content?type=3').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;


                return content;


            });

        },

    };

})




.factory('FormService', function($http, apiUrl) {

    var Forms = [];

    return {
        all: function() {
            var C_id = window.localStorage.getItem("Createdid");
            var U_id = window.localStorage.getItem("Userid");

            return $http.get('http://localhost/got-safety/api/get_user_menu_list?created_id=' + C_id + '&user_id=' + U_id + '&type=forms').then(function(response) {

                var Forms_arr = response.data;
                var usr = Forms_arr.user;
                // alert(usr.length);

                if (usr.length > 0) {
                    for (var j = 0; j < usr.length; j++) {

                        // alert(usr[0].id);                               
                        Forms[j] = usr[j];
                    }
                }

                return Forms;


            });

        },



        content: function() {

            return $http.get('http://localhost/got-safety/api/get_content?type=5').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;

                return content;


            });

        },


    };

})


//service for safety posters 
.factory('safetyPosters', function($http, apiUrl) {

    var posters = [];
    var Attachment = [];
   



    return {

        all: function() {
            var client_id = window.localStorage.getItem("client_id");

            return $http.get(apiUrl + 'Poster/list?client_id=' + client_id).then(function(response) {
                var data = response.data;

                if( data.posters != undefined )
                {
                    posters = data.posters;
                }

                return posters;

            });

        },

       getPosterId: function(PosterId) {

            for (var i = 0; i < posters.length; i++) {
                if (posters[i].id == PosterId) {
                    return posters[i];

                }

           };
        
       }, 

        getAttachment: function( poster_id ) {
            

            return $http.get(apiUrl + 'Poster/attachment?poster_id=' + poster_id ).then(function(response) {
                var data = response.data;

                if( data.attachments == undefined )
                {
                  return [];
                }

                return data.attachments;

            });

        }
    };

})


.factory('employeeDetails', function($http, apiUrl) {
    var employees = [];

    return {

        getEmployees: function( client_id ) {

            return $http.get(apiUrl + 'user/employees?client_id=' + client_id).then(function(response) {
                var data = response.data;

                if( data.employees == undefined )
                {
                    employees = [];
                }

                employees = data.employees;

                return employees;
            })

        },
        trainingComplete: function( lesson_id, employee_id ) 
        {
            var Empid = window.localStorage.getItem("empid");
            var lessonTitle = window.localStorage.getItem("Title");
            var signed = {
                'employee_id': employee_id,
                'lesson_id': lesson_id
            };

            return $http.post(apiUrl + 'lesson/training', signed).then(function(response) {
                var result = response.data;
                return result;
            })

        }

    }

})

/* Repository Tree  */

.factory('RepositoryService', function($http, apiUrl)
 {

  return {
              //list of reports
              all: function() 
              {
                   

                    return $http.get(apiUrl+'Api/repository?client_name=client').then(function(response)
                    {
                      var data = response.data;
                      
                     
                        return data; 
                        

                    });
                 
              },
             
       
     }; 

});
