<?php

include_once('MyModel.php');
include_once('MySQLModel.php');

$model = new MyModel();
$model->id = 1;
$model->name = 'Sav4ik';
$model->wings = 3;
echo $model->data(2);

$model->pushData([
    'id' => 2,
    'name' => 'Yurka',
    'g' => '444'
]);
$model->data(3);


$model = new MySQLModel();
$model->fetchMode(4);
echo $model->varName;

var_dump($model->insertNew(['varName'=>'Muska','varAddress'=>'MurMuska'],10));