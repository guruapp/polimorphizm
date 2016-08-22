<?Php

abstract class DbC 
{
	function printC($contentType)
	{
		header($contentType);
	}
}

//echo json_encode($test);
class dbConnect extends DbC
{

	function __construct($table)
	{
		$con = mysqli_connect("localhost","root","","angular");
		if ($con->connect_errno) 
		{
    		printf("Connect failed: %s\n", $con->connect_error);
    		exit();
		}
		if($data = $con->query("SELECT * FROM ".$table))
		{
 			$i =0;
 
 			while($obj = $data->fetch_object() )
 			{

  			 $dataAll[$i] = $obj;
   				$i++;

 			}
 			$data->close();
 			echo json_encode($dataAll);
		}
		else
		{
			echo "No";
		}
	}
}



$dbClass = new dbConnect("tableangular");
$dbClass->printC("Content-Type: text/json");
