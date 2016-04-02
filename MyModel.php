<?php
require_once('Modules/Model.php');

use Modules\Model;

class MyModel extends Model
{
    protected $attributes = array('id', 'name');
}