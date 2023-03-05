<?php

class ConsoleModel extends BaseModel
{
    protected $id = 'consoleid';
    protected $table = 'consoles';

    const CONSOLES = [
        'ps5' => 'Playstation 5',
        'ps4' => 'Playstation 4',
        'sxs' => 'Xbox Series X/S',
        'xbo' => 'Xbox One',
    ];
    
    public function getAllConsoles()
    {
        return $this->db->getAll("SELECT * FROM `consoles` ORDER BY `consoles`.`releasedate` DESC");
    }
}