<?php

class PageModel extends BaseModel
{
    protected $id = 'pageid';
    protected $table = 'pages';
    
    public function create($array)
    {
        $array['url'] = StringHelper::slugify($array['title']);
        parent::create($array);
    }
}