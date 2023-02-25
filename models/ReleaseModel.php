<?php

class ReleaseModel extends BaseModel
{
    protected $id = 'releaseid';
    protected $table = 'releases';
    
    const RELEASETYPES = [
        'Standard'                 => 1,
        "Director's Cut"           => 2,
        'Special Edition'          => 3,
        'Game Of The Year Edition' => 4,
        'Complete Edition'         => 5,
        'Ultimate Edition'         => 6,
        'Anniversary Edition'      => 7,
        'Definitive Edition'       => 8,
        'HD Edition'               => 9,
        'Other'                    => 10,
    ];

    public function create($array)
    {
        parent::create($array);
        $game = $this->getById($array['gameid']);
        RedirectHelper::redirect("/admin/games/edit/{$game['url']}");
    }

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