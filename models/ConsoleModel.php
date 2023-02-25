<?php

class ConsoleModel extends BaseModel
{
    protected $id = 'consoleid';
    protected $table = 'consoles';

    const CONSOLES = [
        'ps5' => 'Playstation 5',
        'sxs' => 'Xbox Series X/S',
        'xbo' => 'Xbox One',
    ];
}