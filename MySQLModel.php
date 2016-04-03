<?php
use Core\Model;
use Core\Config;

class MySQLModel extends Model
{
    protected $attributes = array('intAccount', 'varName', 'varAddress');
    protected $table_name = 'accounts';
    protected $primary_key = 'intAccount';

    /**
     * @param int $id
     */
    public function fetchMode($id)
    {
        $config = new Config();
        $this->fetchData($config->getSource(), $id);
    }

    /**
     * @param array $sets
     * @param $id
     */
    public function insertNew(Array $sets)
    {
        $config = new Config();
        $this->insertData($config->getSource(), $sets);
    }

    public function update($id = null, $sets = null)
    {
        $config = new Config();
        $this->updateData($config->getSource(), $sets, $id);
    }
}