<?php

class GamesController extends BaseController
{
    protected $view = 'detail.html';

    public function init()
    {
        $game = new GameModel($this->di);
        $game->getDetail($this->slug[0]);
    }
}