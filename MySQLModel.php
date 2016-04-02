<?php
require_once('Modules/Model.php');
require_once('core/config.php');

use Modules\Model;

class MySQLModel extends Model
{
    protected $attributes = array('intAccount', 'varName', 'varAddress');

    protected $table_name = 'accounts';
    protected $primary_key = 'intAccount';

    /**
     * @param int $id
     */
    public function fetchMode($id = 1)
    {
        $config = new Config();
        $this->fetchData($config->getSource(), $id);
    }

    /**
     * @param array $sets
     * @param $id
     */
    public function insertNew(Array $sets, $id)
    {
        $config = new Config();
        $this->insertOrUpdateData($config->getSource(), $sets, $id);
    }
}