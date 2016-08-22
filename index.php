<?Php


include("dbcon.inc");
?>
<DOCTYPE html>
<html ng-app="root">
<head>
	<style type="text/css">
 .arrow-up
 {
 	width: 0px;
 	height: 0px;
 	border-left: 5px solid transparent;
 	border-right: 5px solid transparent;
 	border-bottom: 10px solid black;
 	display: inline-block;

 }
  .arrow-down
 {
 	width: 0px;
 	height: 0px;
 	border-left: 5px solid transparent;
 	border-right: 5px solid transparent;
 	border-top: 10px solid black;
 	display: inline-block;
 	
 }
  
	</style>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.js"></script>
	<script type="text/javascript">
 angular.module("root",[]).controller("sohen", function ($scope, $http){

 callBackSuccess = function (response){
 	console.log(response.data);
 	$scope.employees = response.data;
 }	

 $http({
 	method: "post",
 	url:"http://localhost/sohnim/array.php"
 })
 .then(callBackSuccess)	
 
 $scope.url = "index.php";
 $scope.myValue = 1;
 $scope.submit = function (){
    
               $http.post($scope.url, {"name": $scope.name, "email": $scope.email, "username": $scope.username}).
                        success(function(data, status) {
                            console.log(data); // success
                            $scope.status = status;
                            $scope.data = data;
                            $scope.result = data; 
                            $scope.myValue = 0;
                        })

        }
 /* $scope.employees = [
  {name:"Vadim", salary:1450, date: new Date(), city:"Tel aviv"},
  {name:"Mark", salary:2450, date: new Date(), city:"New york"},
  {name:"Babushka", salary:3450, date: new Date(), city:"Ashdod"},
  {name:"Nir", salary:5450, date: new Date(), city:"San francisko"},
  {name:"Jon", salary:6450, date: new Date(), city:"Bufalo"}
  ]
  */

  $scope.raw = 5;
  $scope.sortColumn = "name";
  $scope.reverseSort = false;

  $scope.sortData = function (column)
  {
     //$scope.reverseSort = ($scope.sortColumn == column) ? !$scope.reverseSort : false;
     if(!$scope.reverseSort && $scope.sortColumn == column)
     {
       $scope.reverseSort = true;
     }
     else
     {
     	$scope.reverseSort = false;
     }
     $scope.sortColumn = column;
  }
  $scope.getClass = function (column)
  {
  	if ($scope.sortColumn == column) 
  		{
          return $scope.reverseSort ? "arrow-down" : "arrow-up";
  		}
  		else
  		{
  		  return " ";
  		}
  }
  $scope.searchBy = function (term)
  {
  	if ($scope.search == undefined) 
  	{
       return true;
  	}
  	else	
  	{
  	if (term.Name.toLowerCase().indexOf($scope.search.toLowerCase()) != -1) 
  		{
           return true;
  		};
  	}
  	return false;
  }

  
 });
	</script>
<title>Sohnim</title>
</head>
<body>

<div ng-controller="sohen">
	Search by name and gender <input type="text" ng-model="search" placeholder="Search">
	<input type="number" min=0 max=5 ng-model="raw">
	<table>
    <thead>
       <tr>
         <th ng-click="sortData('name')">
          Name <div ng-class="getClass('name')"></div>
         </th>
          <th ng-click="sortData('salary')">
          Salary <div ng-class="getClass('salary')"></div>
         </th>
         <th>
          Date
         </th>
         <th>
          City
         </th>
       </tr>
    </thead>
    <tbody>
     <tr ng-repeat="employe in employees | limitTo:raw | orderBy:sortColumn:reverseSort | filter:searchBy">
      <td>{{employe.Name}}</td>
      <td>{{employe.Salary}}</td>
      <td>{{employe.date | date:'yyyy-MM-dd'}}</td>
      <td>{{employe.city}}</td>
     </tr>
    </tbody>
	</table>
	<br><br><br>
<form  ng-submit="submit()" ng-show="myValue">

name: <input type="text" name="name" ng-model="name">
<br>email:<input type="text" name="email" ng-model="email">
<br>username:<input type="text" name="username" ng-model="username">
<input type="submit" id="submit" value="submit">
</form>
</div>
</body>
</html>