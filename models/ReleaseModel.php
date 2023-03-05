<?php

class ReleaseModel extends BaseModel
{
    protected $id = 'releaseid';
    protected $table = 'releases';
    
    const RELEASETYPES = [
        'Standard Edition'         => 1,
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
    
    public function getAllGameReleases($gameid)
    {
        $data = $this->db->getAll("
            SELECT `consoles`.`name`, `regions`.`flag`, `releases`.`releasedate`, `releases`.`type`
            FROM `releases` LEFT JOIN `consoles` ON `releases`.`consoleid` = `consoles`.`consoleid`
            LEFT JOIN `regions` ON `releases`.`regionid` = `regions`.`regionid`
            WHERE `gameid` = :gameid ORDER BY `releases`.`consoleid` DESC, `releases`.`regionid` ASC
        ", ['gameid' => $gameid]);
        $headers = array_values(array_unique(array_column($data, 'name')));
        foreach($data as $row) $temp[$row['flag']][$row['name']] = $row['releasedate'];
        $i=0;
        $output[0] = array_merge([''],$headers);
        foreach($temp as $key => $value){
            $output[++$i]['flag'] = $key;
            foreach($headers as $header) $output[$i][$header] = $value[$header] ?? '-';
        }
        $this->page->releases = $output;
    }

    public function create($array)
    {
        parent::create($array);
        $game = $this->getById($array['gameid']);
        RedirectHelper::redirect("/admin/games/edit/{$game['url']}");
    }

    public function read($value, $column = null)
    {
        $this->page->fill($this->db->read($this->table, $this->id, $value));
        $this->page->consoles = $this->di->ConsoleModel->getAllConsoles();
        $this->page->regions = $this->di->RegionModel->getAllRegions();
    }
    
    public function update($array)
    {
        parent::update($array);
        $game = $this->getById($array['gameid']);
        RedirectHelper::redirect("/admin/games/edit/{$game['url']}");
    }
    
    public function new()
    {
        $gameid = $this->page->parentid ?? 0;
        if($previous = $this->db->getRow("SELECT * FROM `releases` WHERE `gameid` = $gameid")){
            $this->page->releasedate = $previous['releasedate'];
            $this->page->developer = $previous['developer'];
            $this->page->publisher = $previous['publisher'];
        }
        $this->page->consoleid = $this->page->regionid = 0;
        $this->page->consoles = $this->di->ConsoleModel->getAllConsoles();
        $this->page->regions = $this->di->RegionModel->getAllRegions();
    }
    
    public function list($table = null, $id = null)
    {
        $query = "SELECT `releases`.`releaseid`,`releases`.`releasedate`,
                  `consoles`.`name` as console,`regions`.`flag` as region FROM `releases`
                  INNER JOIN `consoles` ON `releases`.`consoleid` = `consoles`.`consoleid`
                  INNER JOIN `regions` ON `releases`.`regionid` = `regions`.`regionid`
                  WHERE `releases`.`gameid` = :gameid
                  ORDER BY `releases`.`releasedate` DESC";
        $this->page->partial('releases', $query, ['gameid' => $id]);
    }
    
    public function getById($id)
    {
        return $this->db->getRow("SELECT * FROM `releases` INNER JOIN `games` 
            ON `releases`.`gameid` = `games`.`gameid` WHERE `releases`.`gameid` = :id", ['id' => $id]);
    }
}