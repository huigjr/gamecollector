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
            GROUP BY `releases`.`gameid` 
            ORDER BY `releases`.`releasedate` DESC");
    }

    public function getDetail($slug)
    {
        parent::read($slug, 'url');
        $this->page->tags = $this->di->GenreModel->getGenres($this->page->genres);
        $this->page->releases = $releases = $this->db->getAll("
            SELECT * FROM `releases` WHERE `gameid` = '".$this->page->gameid."'");
        $this->page->image = $releases[0]['image'];
        $this->page->console = $releases[0]['console'];
    }

    public function create($array)
    {
        $array['url'] = StringHelper::slugify($array['title']);
        parent::create($array);
    }

    public function read($value, $column = null)
    {
        parent::read($value, $column);
        $this->page->genres = $this->di->GenreModel->getCheckedGenres($this->page->genres);
    }

    public function update($array)
    {
        $array['genres'] = empty($array['genres']) ? 0 : array_sum($array['genres']);
        parent::update($array);
    }

    public function new()
    {
        $this->page->genres = $this->di->GenreModel->getCheckedGenres();
    }
}