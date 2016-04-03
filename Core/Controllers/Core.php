<?php
/**
 * Created by PhpStorm.
 * User: Nerdjin
 * Date: 02.04.2016
 * Time: 14:11
 */

class Core
{
    public function index(){
        echo 'Something';
        return 'Hi';
    }

    public function go(){
        include_once ROOT_DIR . '../Examples.php';
        $ex = new Examples();
    }

    public function add(){
        $model = new MySQLModel();
        $request = $_REQUEST;
        if (empty($request))
            return exit;
        $model->pushData($request);
        $model->insertNew([]);
        return get_view($model);
    }

    public function edit($id){
        $model = new MySQLModel();
        $model->fetchMode($id[0]);
        return get_view($model);
    }
}