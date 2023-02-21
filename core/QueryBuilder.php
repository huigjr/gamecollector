<?php

class QueryBuilder extends DB
{

    public function create($table, $array)
    {
        foreach($array as $key => $value) $into[] = $this->safe($key);
        return $this->insert("INSERT INTO {$this->safe($table)} ({$this->implode(', ',$into)}) VALUES (:{$this->implode(', :',$into)})", $this->trim($array));
    }

    public function read($table, $column, $value)
    {
        return $this->getRow("SELECT * FROM {$this->safe($table)} WHERE {$this->safe($column)} = :{$this->safe($column)}", [$column => $value]);
    }

    public function update($table, $array, $column)
    {
        foreach($array as $key => $value) if($key !== $column) $set[] = $this->safe($key).' = :'.$this->safe($key);
        return $this->insert("UPDATE {$this->safe($table)} SET {$this->implode(', ',$set)} WHERE {$this->safe($column)} = :{$this->safe($column)}", $this->trim($array));
    }

    public function delete($table, $column, $value)
    {
        return $this->insert("DELETE FROM {$this->safe($table)} WHERE {$this->safe($column)} = :{$this->safe($column)}", [$column => $value]);
    }

    public function value($table, $get, $column, $value)
    {
        return $this->getValue("SELECT {$this->safe($get)} FROM {$this->safe($table)} WHERE {$this->safe($column)} = :{$this->safe($column)}", [$column => $value]);
    }

    public function toggle($table, $switch, $column, $value)
    {
        return $this->insert("UPDATE {$this->safe($table)} SET {$this->safe($switch)} = 1 - {$this->safe($switch)} WHERE {$this->safe($column)} = :{$this->safe($key)}", [$key => $value]);
    }
    
    private function implode($glue, $array)
    {
        return implode($glue, $array);
    }

    private function safe($string)
    {
        return preg_replace('/[^a-zA-Z0-9-_]/u','',trim($string));
    }
    
    private function trim($array)
    {
        foreach($array as &$item) $item = trim($item) ?: null;
        return $array;
    }
}