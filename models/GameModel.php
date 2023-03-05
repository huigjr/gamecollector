<?php

class GameModel extends BaseModel
{

    protected $id = 'gameid';
    protected $table = 'games';

    public function getHome()
    {
        $this->page->partial('games', "
            SELECT `title`,`url`,`console`,`image` FROM `games` INNER JOIN `covers` 
            ON `games`.`gameid` = `covers`.`gameid` 
            WHERE `covers`.`region` IN ('na','eu') 
            AND `image` IS NOT NULL 
            GROUP BY `covers`.`gameid` 
            ORDER BY `games`.`title`");
    }

    public function getGamesByConsole($console)
    {
        $consoles = array_flip(ConsoleModel::CONSOLES);
        if(in_array($console, array_flip(ConsoleModel::CONSOLES))){
            $this->page->partial('games', "
            SELECT * FROM `covers` INNER JOIN `games` ON `covers`.`gameid` = `games`.`gameid` 
            WHERE `console` = '{$console}' OR `second` = '{$console}'");
        } else RedirectHelper::pageNotFound();
    }

    public function getDetail($url)
    {
        parent::read($url);
        $query = "SELECT console,image FROM `covers` WHERE `gameid` = '{$this->page->gameid}'";
        list($this->page->console, $this->page->image) = array_values($this->db->getRow($query));
        $this->di->CoverModel->getAllGameCovers($this->page->gameid);
        $this->di->ReleaseModel->getAllGameReleases($this->page->gameid);
    }

    public function create($array)
    {
        $array['url'] = StringHelper::slugify($array['title']);
        $gameid = parent::create($array);
        RedirectHelper::redirect("/admin/releases/new/$gameid");
    }

    public function read($value, $column = null)
    {
        parent::read($value, $column);
        $this->page->genres = $this->di->GenreModel->getCheckedGenres($this->page->genres);
        $this->di->ReleaseModel->list(null, $this->page->gameid);
        $this->page->partial('covers', "SELECT * FROM `covers` WHERE `gameid` = {$this->page->gameid}");
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
        $where = $table ? "WHERE `consoles`.`short` = '$table'" : '';
        $query = "SELECT `releases`.`gameid`,`games`.`title`,`games`.`url`,
                  COUNT(`releases`.`gameid`) AS releases FROM `releases` 
                  LEFT JOIN `consoles` ON `releases`.`consoleid` = `consoles`.`consoleid`
                  LEFT JOIN `games` ON `releases`.`gameid` = `games`.`gameid` $where
                  GROUP BY `releases`.`gameid` ORDER BY `games`.`url`";
        $this->page->partial('list', $query);
        $this->page->partial('consoles', "SELECT DISTINCT(`console`) as console FROM `releases` ORDER BY `console`");
    }
}