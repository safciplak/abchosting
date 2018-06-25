<?php

class BaseController
{
    public function getView($viewName = null, $dataItems)
    {
        $datas = $dataItems;
        $viewName = strtolower($viewName).'view.php';
        include "$viewName";
    }

    public function getWithBasePath($path)
    {
        return 'http://'.$_SERVER['HTTP_HOST']. $path;
    }
}