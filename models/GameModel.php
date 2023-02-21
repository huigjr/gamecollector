<?php

class GameModel extends BaseModel
{

    protected $id = 'gameid';
    protected $table = 'games';

    public function getHome()
    {
        $this->page->partial('games', "
            SELECT `title`,`url`,`console`,`image` FROM `games` INNER JOIN `releases` 
            ON `games`.`gameid` = `releases`.`gameid` 
            WHERE `releases`.`region` IN ('na','eu') 
            AND `image` IS NOT NULL 
            GROUP BY `releases`.`gameid` 
            ORDER BY `releases`.`releasedate` DESC");
    }

    public function getDetail($url)
    {
        $this->page->fill($this->db->getRow("SELECT `games`.*, `image` FROM `games` INNER JOIN `releases` 
                                             ON `games`.`gameid` = `releases`.`gameid` 
                                             WHERE `url` = :url AND `image` IS NOT NULL 
                                             GROUP BY `releases`.`gameid`", ['url' => $url]));
        
        //$this->page->tags = $this->di->GenreModel->getGenres($this->page->genres);
        $this->page->releases = $releases = $this->db->getAll("
            SELECT * FROM `releases` WHERE `gameid` = '".$this->page->gameid."'");
        $this->page->image = $releases[0]['image'];
        $this->page->console = $releases[0]['console'];
    }

    public function create($array)
    {
        $array['url'] = StringHelper::slugify($array['title']);
        return parent::create($array);
    }

    public function read($value, $column = null)
    {
        parent::read($value, $column);
        $this->page->genres = $this->di->GenreModel->getCheckedGenres($this->page->genres);
        $this->page->partial('releases', "SELECT * FROM `releases` WHERE `gameid` = {$this->page->gameid}");
    }

    public function update($array)
    {
        $array['genres'] = empty($array['genres']) ? 0 : array_sum($array['genres']);
        return parent::update($array);
    }

    public function new()
    {
        $this->page->genres = $this->di->GenreModel->getCheckedGenres();
    }
    
    public function list($table = null, $id = null)
    {
        $where = $table ? "HAVING `releases`.`console` = '$table'" : '';
        $query = "SELECT `games`.`gameid`,`games`.`title`,`games`.`url`,`releases`.`console`, 
                  COUNT(`games`.`gameid`) AS releases 
                  FROM `releases` INNER JOIN `games` ON `releases`.`gameid` = `games`.`gameid`  
                  GROUP BY `releases`.`gameid` $where ORDER BY `games`.`title`";
        $this->page->partial('list', $query);
        $this->page->partial('consoles', "SELECT DISTINCT(`console`) as console FROM `releases` ORDER BY `console`");
    }
}