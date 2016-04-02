<?php
namespace Modules;

abstract class Model
{
    /**
     * Attributes of model
     * @var array
     */
    protected $attributes = array();

    /**
     * Model Data
     * @var array
     */
    private $data = array();

    /**
     * Parameters used on exit
     */
    const PAR_ARRAY = 1;
    const PAR_JSON = 2;
    const PAR_DUMP = 3;

    /**
     * Primary key
     * @var string
     */
    protected $primary_key = 'id';

    /**
     * Table name
     * @var
     */
    protected $table_name;

    /**
     * When creatingnew model? all $attributes makes keys
     * and Data includes in model
     * @param null $data
     */
    public function __construct($data = null)
    {
        $this->attributes = array_unique(array_combine($this->attributes, $this->attributes));
        if ($data) {
            $this->pushData($data);
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (method_exists($this, $name)) {
            return call_user_func($this->$name);
        }
        return $this->_getValue($name);
    }

    /**
     * @param string $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->pushData([$name => $value]);
    }

    /**
     * @param $name
     * @return mixed
     */
    private function _getValue($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function pushData(Array $data)
    {
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $this->attributes)) {
                $this->data[$key] = $value;
            }
        }
        return $this->data;
    }

    /**
     * @param int $OPTION
     * @return array|string|void
     */
    public function data($OPTION = self::PAR_ARRAY)
    {
        if ($OPTION == self::PAR_JSON) {
            return json_encode($this->data);
        }
        if ($OPTION == self::PAR_DUMP) {
            return var_dump($this->data);
        }
        return $this->data;
    }

    /**
     * @param $link
     * @param $id
     * @param array $fields
     * @param null $table_name
     * @return array|null
     */
    public function fetchData($link, $id, Array $fields = array(), $table_name = null)
    {
        if (!$link) {
            return null;
        }
        if (!$table_name) {
            $table_name = $this->table_name;
        }
        if (!empty($fields)) {
            $fields = implode(',', $fields);
        } else $fields = '*';
        $data = mysqli_fetch_assoc(mysqli_query($link, mysqli_escape_string($link,
            'SELECT ' . $fields .
            ' FROM ' . $table_name .
            ' WHERE ' . $this->primary_key . '=' . $id
        )));
        if ($data) {
            return $this->pushData($data);
        }
    }

    /**
     * @param $link
     * @param array $sets
     * @param null $id
     * @param null $table_name
     * @return bool|\mysqli_result|null
     */
    public function insertOrUpdateData($link, Array $sets = array(), $id = null, $table_name = null)
    {
        if (!$link) {
            return null;
        }
        if (!$table_name) {
            $table_name = $this->table_name;
        }
        if (empty($sets)) {
            return null;
        }
        $values = "'" . str_replace(',', "','", implode(',', array_values($sets))) . "'";
        if (!$id) {
            return mysqli_query($link,
                'INSERT INTO ' . $table_name . ' (' . implode(',', array_keys($sets)) . ')' .
                ' VALUES (' . $values . ')'
            );
        }
        $_query = array();
        foreach ($sets as $set => $value) {
            $_query[] = $set . "='" . $value . "'";
        }
        return mysqli_query($link,
            'UPDATE ' . $table_name .
            ' SET ' . implode(', ', $_query) .
            ' WHERE ' . $this->primary_key . '=' . $id
        );

    }
}