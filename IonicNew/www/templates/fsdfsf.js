.directive('autoComplete', function(employeeDetails)
   {
    return  {     
            restrict: 'A',
            link: function(scope, elem, attr, ctrl)
             {
                // elem is a jquery lite object if jquery is not present,
                // but with jquery and jquery ui, it will be a full jquery object.
            elem.autocomplete({
            source: employeeDetails.getSource(), //from your service
            minLength: 2
        });
    }
};
})


controller('signoffCtrl', function($scope,employeeDetails)
 {

                    $scope.model = "";
                    $scope.clickedValueModel = "";
                    $scope.removedValueModel = "";

                    $scope.getTestemp = function (query)
                    {
                        if (query)
                       {  
                              employeeDetails.employee().then(function(data)
                              { 
                                $scope.employee = data; 

                              
                             });
                           
                        }
                       
                    };


                    $scope.empClicked = function (callback)
                    {
                        $scope.clickedValueModel = callback;
                    };
                  
 })

 <label class="item item-input">
                <span class="input-label">autocomplete</span>
                <input ion-autocomplete type="text"  class="ion-autocomplete" autocomplete="off"
                       ng-model="model"
                       item-value-key="id"
                       items-method="getTestemp(query)"
                       items-method-value-key="employee"
                       placeholder="Enter test query ..."
                       items-clicked-method="empClicked(callback)"
                       max-selected-items="1"/>
        </label>



                    $scope.model = "";
                    $scope.clickedValueModel = "";
                    $scope.removedValueModel = "";

                    $scope.getTestemp = function (query,isInitializing)
                    {
                        if(isInitializing) 
                        {
        // depends on the configuration of the `items-method-value-key` (items) and the `item-value-key` (name) and `item-view-value-key` (name)
                          return { items: [ { name: "test" } ] }
                        }
                        else
                        {
                        
                              employeeDetails.employee().then(function(data)
                              { 
                                $scope.employee = data; 

                              
                             });

                        }
                           
                        
                       
                    };


                    $scope.empClicked = function (callback)
                    {
                        $scope.clickedValueModel = callback;
                    };



                  --------------------------------
                  using directive 

                      .directive('autoComplete', function($timeout) 
    {
        return function(scope, iElement, iAttrs)
        {
                iElement.autocomplete({
                    source: scope[iAttrs.names],
                    select: function()
                    {
                        $timeout(function() {
                          iElement.trigger('input');
                        }, 0);
                    }
                });
        };
    })



        <input autoComplete ui-items="names" ng-model="selected"\>
        selected = {{selected}}


        
.controller('signoffCtrl', function($scope)
 {
         $scope.names = ["john", "bill", "charlie", "robert", "alban", "oscar", "marie", "celine", "brad", "drew", "rebecca", "michel", "francis", "jean", "paul", "pierre", "nicolas", "alfred", "gerard", "louis", "albert", "edouard", "benoit", "guillaume", "nicolas", "joseph"];
 })