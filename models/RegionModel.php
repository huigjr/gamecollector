<?php

class RegionModel extends BaseModel
{
    protected $id = 'regionid';
    protected $table = 'regions';

    public function getAllRegions()
    {
        return $this->db->getAll("SELECT * FROM `regions`");
    }
}