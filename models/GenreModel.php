<?php

class GenreModel extends BaseModel
{

    const GENRES = [
        'Open World' => 1,
        'Action' => 2,
        'Adventure' => 4,
        'Platform' => 8,
        'Turn Based Strategy' => 16,
        'Realtime Strategy' => 32,
        'Action RPG' => 64,
        'Turn Based RPG' => 128, // byte 1
        'MMORPG' => 256,
        'Hack And Slash' => 512,
        'First Person Shooter' => 1024,
        'Third Person Shooter' => 2048,
        'Side Scrolling Shooter' => 4096,
        'Top Down Shooter' => 8192,
        'Fighting' => 16384,
        'Beat \'em up' => 32768, // byte 2
        'Survival Horror' => 65536,
        'Reverse Horror' => 131072,
        'Sports' => 262144,
        'Puzzle' => 524288,
        'Simulation' => 1048576,
        'Board Game' => 2097152,
        'Card Game' => 4194304,
        'Visual Novel' => 8388608, // byte 3
        'Story' => 16777216,
        'Party' => 33554432,
    ];
    
    public function getGenres($bits)
    {
        foreach(self::GENRES as $name => $bit){
            if($bit & $bits) $output[] = $name;
        }
        return $output ?? [];
    }
    
    public function getCheckedGenres($bits = 0)
    {
        foreach(self::GENRES as $name => $bit){
            $output[] = [
                'name' => $name,
                'value' => $bit,
                'checked' => ($bit & $bits) ? 'checked' : '',
            ];
        }
        return $output;
    }
}