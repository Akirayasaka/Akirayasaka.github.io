<?php
    $dsn="mysql:host=localhost;charset=utf8;dbname=s1080110";
    localhost:http://220.128.133.15/s1080110/;
    $pdo=new PDO($dsn,"s1080110","s1080110");

    session_start();

    if(empty($_SESSION['total'])){
        $tot=find("total",1);
        $tot['total']++;
        save("total",$tot);
        $_SESSION['total']=$tot['total'];
    }

    function nums($table,$def){
        global $pdo;
        if(is_array($def)){
            foreach($def as $k=>$v){
                $str[]=sprintf("%s='%s'",$k,$v);
            }
            $sql="select count(*) from $table where ". implode(" && ",$str) ."";
        }else{
            $sql="select count(*) from $table";
        }
        return $pdo->query($sql)->fetchColumn();
    }

    function all($table,$def){
        global $pdo;
        if(is_array($def)){
            foreach($def as $k=>$v){
                $str[]=sprintf("%s='%s'",$k,$v);
            }
            $sql="select * from $table where ". implode(" && ",$str) ."";
        }else{
            $sql="select * from $table";
        }
        return $pdo->query($sql)->fetchAll();
    }

    function q($str){
        global $pdo;
        return $pdo->query($str)->fetchAll();
    }

    function find($table,$def){
        global $pdo;
        if(is_array($def)){
            foreach($def as $k=>$v){
                $str[]=sprintf("%s='%s'",$k,$v);
            }
            $sql="select * from $table where ". implode(" && ",$str) ."";
        }else{
            $sql="select * from $table where id='". $def ."'";
        }
        return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function del($table,$def){
        global $pdo;
        if(is_array($def)){
            foreach($def as $k=>$v){
                $str[]=sprintf("%s='%s'",$k,$v);
            }
            $sql="delete from $table where ". implode(" && ",$str) ."";
        }else{
            $sql="delete from $table where id='". $def ."'";
        }
        return $pdo->exec($sql);
    }

    function save($table,$def){
        global $pdo;
        if(!empty($def['id'])){
            foreach($def as $k=>$v){
                if($k != 'id'){
                    $str[]=sprintf("%s='%s'",$k,$v);
                }
            }
            $sql="update $table set ". implode(",",$str) ." where id='". $def['id'] ."'";
        }else{
            $sql="insert into $table(`". implode("`,`",array_keys($def)) ."`) values('". implode("','",$def) ."')";
        }
        return $pdo->exec($sql);
    }

    function to($str){
        header("location:$str");
    }

    function jsm($url){
        exit('<script Language="JavaScript"><!--
        location.replace("'.$url.'");
        // --></script>');
    }


?>