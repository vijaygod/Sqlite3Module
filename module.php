<?php
/**
 * Created by PhpStorm.
 * User: NIHAO
 * Date: 2017/3/2
 * Time: 9:13
 * This is sqlite database operating
 */

class MyModule extends SQLite3{
    private $DBPath;
    private $Table;
    function __construct($DBPATH)
    {
        $this -> DBPath = $DBPATH;
    }

    public function setTable($TableName){
        $this -> Table = $TableName;
    }

    public function OpenDb(){
        $this -> open($this -> DBPath);
    }

    public function getRowNum(){
        $sqlGetNUm = 'SELECT count(*) FROM `Content`';
        $Num = $this ->query($sqlGetNUm) ->fetchArray();
        return $Num[0];
    }

    public function Save($data){
        $sqlKey = '';
        $sqlValue = '';
        $EndValue = end($data);
        foreach ($data as $key =>$value){
            if ($value === $EndValue){
                $sqlKey .= "'".$key."'";
                $sqlValue .= "'".$value."'";
            }else{
                $sqlKey .= "'".$key."',";
                $sqlValue .= "'".$value."',";
            }
        }
        $InsertSql = "INSERT INTO `".$this->Table."`($sqlKey) VALUES ($sqlValue)";
        $statue = $this -> query($InsertSql);
        if ($statue){
            return true;
        }else{
            return false;
        }
    }
}
