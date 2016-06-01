angular.module('starter.services', [])

//service for authentication
.service('AuthService', function($q, $http, AppConfig) {

    var isAuthenticated = true;
    var LOCAL_TOKEN_KEY = 'user_credentials';
    
    function loadUserCredentials() {
        var uc = window.localStorage.getItem(LOCAL_TOKEN_KEY);
        if (uc) {
            useCredentials(uc);

        }
    }

    function storeUserCredentials(uc) {
         window.localStorage.setItem("user_id", uc.id);
         window.localStorage.setItem("client_id", uc.created_id);
         window.localStorage.setItem("client_name", uc.client_name);

        window.localStorage.setItem(LOCAL_TOKEN_KEY, uc);
        useCredentials(uc);
    }

    function useCredentials(uc) {
        isAuthenticated = true;
        //console.log(uc);

    }

    function destroyUserCredentials() {
        isAuthenticated = false;
      
        window.localStorage.removeItem(LOCAL_TOKEN_KEY);

        window.localStorage.removeItem("user_id");
        window.localStorage.removeItem("client_id");
        window.localStorage.removeItem("client_name");
    }

    var login = function(name, password) {

        return $q(function(resolve, reject) {

            $http.post(AppConfig.apiUrl + 'user/login', {
                    'name': name,
                    'password': password
                }, {
                    ignoreAuthModule: true
                })
                .then(function(response) 
                {
                    var user_data = response.data;
                    //console.log(user_data);
                    if( user_data.status != undefined && user_data.status == 'SUCCESS' )
                    {
                     
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

.factory('safetyLessons', function($http, AppConfig) {

    var lessons    = [];
    var Attachment = [];
   

    return {

        all: function() {
            var client_id = window.localStorage.getItem("client_id");

            return $http.get(AppConfig.apiUrl + 'lesson/list?client_id=' + client_id).then(function(response) {
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
       }, 

        getAttachment: function( lesson_id ) {
            

            return $http.get(AppConfig.apiUrl + 'lesson/attachment?lesson_id=' + lesson_id ).then(function(response) {
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
.factory('WebinarService', function($http, AppConfig) {

    var webinars = [];

    return {

        all: function() {
            var client_id = window.localStorage.getItem("client_id");

            return $http.get(AppConfig.apiUrl + 'webinars/list?client_id=' + client_id).then(function(response) {
                var data = response.data;
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
       }
    };

})


.factory('DocumentationService', function($http, AppConfig) {
  
  var documents = [];
    return {

            all: function()
            {
                var client_id = window.localStorage.getItem("client_id");

                return $http.get(AppConfig.apiUrl + 'user/docs?client_id=' + client_id + '&type=document' ).then(function(response) {
                    var data = response.data;
                    
                     if( data.docs != undefined )
                     {
                        documents = data.docs;
                     }

                    return documents;
                   
                });

            },

        content: function() {

            return $http.get(AppConfig.apiUrl + 'api/get_content?type=2').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;


                return content;


            });

        },
			

        };
    
})


//service for InspectionReport
.factory('InspectionReportService', function($http, AppConfig) {

    var Reports = [];

    return {
        //list of reports
        all: function() {
             var client_id = window.localStorage.getItem("client_id");
            //var U_id = window.localStorage.getItem("Userid");

            return $http.get(AppConfig.apiUrl + 'user/docs?client_id=' + client_id + '&type=report').then(function(response) {

                var doc_arr = response.data;
                var usr = doc_arr.docs;
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

            return $http.get(AppConfig.apiUrl + 'api/get_content?type=1').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;


                return content;


            });

        },

    };

})


//service for Training records
.factory('TrainingRecordService', function($http, AppConfig) {

    var Records = [];

    return {
        //list of records
        all: function() {
             var client_id = window.localStorage.getItem("client_id");
            //var U_id = window.localStorage.getItem("Userid");

            return $http.get(AppConfig.apiUrl + 'user/docs?client_id=' + client_id + '&type=record').then(function(response) {

                var doc_arr = response.data;
                var usr = doc_arr.docs;
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

            return $http.get(AppConfig.apiUrl + 'api/get_content?type=4').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;


                return content;


            });

        },

    };

})


//service for 300logs
.factory('LogService', function($http, AppConfig) {

    var Logs = [];

    return {
        //list of logs
        all: function() {
            var client_id = window.localStorage.getItem("client_id");

            return $http.get(AppConfig.apiUrl + 'user/docs?client_id=' + client_id + '&type=log' ).then(function(response) {

                var doc_arr = response.data;
                
                var usr = doc_arr.docs;
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

            return $http.get(AppConfig.apiUrl + 'api/get_content?type=3').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;


                return content;


            });

        },

    };

})


.factory('FormService', function($http, AppConfig) {

    var Forms = [];

    return {
        all: function() {
            var client_id = window.localStorage.getItem("client_id");
            //var U_id = window.localStorage.getItem("Userid");

            return $http.get(AppConfig.apiUrl + 'user/docs?client_id=' + client_id + '&type=forms').then(function(response) {

                var Forms_arr = response.data;
                var usr = Forms_arr.docs;
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

            return $http.get(AppConfig.apiUrl + 'api/get_content?type=5').then(function(response) {

                var content_res = response.data;
                var user = content_res.user;
                var content = user;
				
                return content;


            });

        },


    };

})

//service for safety posters 
.factory('safetyPosters', function($http, AppConfig) {

    var posters = [];
    var Attachment = [];
   
    return {

        all: function() {
            var client_id = window.localStorage.getItem("client_id");

            return $http.get(AppConfig.apiUrl + 'Poster/list?client_id=' + client_id).then(function(response) {
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
            

            return $http.get(AppConfig.apiUrl + 'Poster/attachment?poster_id=' + poster_id ).then(function(response) {
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


.factory('employeeDetails', function($http, AppConfig) {
    var employees = [];

    return {

        getEmployees: function( client_id ) {

            return $http.get(AppConfig.apiUrl + 'user/employees?client_id=' + client_id).then(function(response) {
                var data = response.data;

                if( data.employees == undefined )
                {
                    employees = [];
                }

                employees = data.employees;

                return employees;
            })

        },
        trainingComplete: function( lesson_id, employee_id , emp_id , client_id ,sign) 
        {
            
            var signed = {
                'employee_id': employee_id,
                'emp_id'     : emp_id,
                'lesson_id'  : lesson_id,
                'client_id'  : client_id,
                'sign'  : sign,
                
                
            };

            return $http.post(AppConfig.apiUrl + 'lesson/training', signed).then(function(response) {
                var result = response.data;
                return result;
            })

        }

    }

})

.factory('RepositoryService', function($http, AppConfig)
 {

    return {
              //list of reports
        all: function(client_name) 
        {
               
            return $http.get(AppConfig.apiUrl+'repository/repository?client_name='+client_name).then(function(response)
            {
              var data = response.data;
              
                return data; 

            });
             
        },
             
     }; 

});
