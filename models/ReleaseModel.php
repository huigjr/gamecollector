<?php

class ReleaseModel extends BaseModel
{
    protected $id = 'releaseid';
    protected $table = 'releases';
    
    public function read($value, $column = null)
    {
        $this->page->fill($this->db->read($this->table, $this->id, $value));
    }
    
    public function getById($id)
    {
        return $this->db->getRow("SELECT * FROM `releases` INNER JOIN `games` 
            ON `releases`.`gameid` = `games`.`gameid` WHERE `releases`.`gameid` = :id", ['id' => $id]);
    }
}