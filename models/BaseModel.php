<?php

abstract class BaseModel
{

    protected $di;
    protected $db;
    protected $page;
    protected $session;

    public function __construct($di)
    {
        $this->di = $di;
        $this->session = $di->Session;
        $this->db = $this->di->factory('QueryBuilder', 'DB', [DB_HOST, DB_NAME, DB_USER, DB_PASS]);
        $this->page = $di->Page;
		$this->init();
    }

	protected function init(){}

    public function create($array)
    {
        return $this->db->create($this->table, $array);
    }

    public function read($value, $column = null)
    {
        $this->page->fill($this->db->read($this->table, ($column ?: $this->id), $value));
    }

    public function update($array)
    {
        return $this->db->update($this->table, $array, $this->id);
    }

    public function delete($value, $column = null)
    {
        $this->db->delete($this->table, ($column ?: $this->id), $value);
    }

    public function new(){}

    public function toggle($switch, $value, $column = null)
    {
        $this->db->toggle($this->table, $switch, ($column ?: $this->id), $value);
    }

    public function list($table = null, $id = null)
    {
        $where = $id ? " WHERE {$this->id} = '$id'" : '';
        $this->page->partial(($table ?: 'list'), "SELECT * FROM " . ($table ?: $this->table) . $where);
    }
}