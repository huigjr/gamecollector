<?php

class QueryBuilder extends DB
{

    public function read($table, $column, $value)
    {
        $column = $this->safe($column,'');
        return $this->getRow("SELECT * FROM ".$this->safe($table)." WHERE $column = :$column", [$column => $value]);
    }

    public function write($table, $array)
    {
        foreach($array as $key => $value) $into[] = $this->safe($key,"");
        return $this->insert("INSERT INTO ".$this->safe($table)." (`".implode('`,`',$into).'`) VALUES (:'.implode(',:',$into).')', $array);
    }

    public function update($table, $array, $column)
    {
        foreach($array as $key => $value) if($key !== $column) $set[] = $this->safe($key).' = :'.$this->safe($key,"");
        return $this->insert("UPDATE ".$this->safe($table)." SET ".implode(', ',$set)." WHERE ".$this->safe($column).' = :'.$this->safe($column,""), $array);
    }

    public function remove($table, $column, $value)
    {
        return $this->insert("DELETE FROM ".$this->safe($table)." WHERE ".$this->safe($column)." = '".$this->safe($value,'')."'");
    }
    
    public function toggle($table, $switch, $column, $value)
    {
        return $this->insert("UPDATE ".$this->safe($table)." SET ".$this->safe($switch)." = 1 - ".$this->safe($switch)." WHERE ".$this->safe($column)." = :".$this->safe($key,""), [$key => $value]);
    }

    private function safe($string,$quote="`")
    {
        return $quote.preg_replace('/[^a-zA-Z0-9-_]/u','',trim($string)).$quote;
    }
}