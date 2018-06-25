<?php

function extractControllerAndFunctionName()
{
	$requestUri = explode('/',$_SERVER['REQUEST_URI']);

	foreach($requestUri as $key=>$item)
	{
		if($item != null || $item != '')
		{
			if($key == 1)
			{
                include "BaseController.php";
                include "BaseModel.php";
				$name = ucfirst($item);
				$modelName = $name;
				include "$modelName.php";
				$controller = $name. 'Controller.php';
				include  "$controller";
				$controllerNameWithoutExtension = preg_replace('/\\.[^.\\s]{3,4}$/', '', $controller);
				$controllerInstance = new $controllerNameWithoutExtension();
				$_SESSION['controllerInstance'] = $controllerInstance;
			}
			else
			{
			    if(stristr($item, "?")){
			        $router = explode("?", $item);
			        $item = reset($router);
                }
				$_SESSION['controllerInstance']->$item();
			}
		}
	}
}

function getPrice($price)
{
    return number_format($price, 2);
}

function diedump($value)
{
    echo '<pre>'; print_r($value); die;
}

