<?php

class UserDao {
    const table = 'user';

    public function __constructor(){}

    public function list(){
        $collection = [];
        $db = Database::singleton ();

        $sql = 'SELECT * FROM ' . self::table;
        $sth = $db->prepare ($sql);
        $sth->execute();

        while($obj = $sth->fetch(PDO::FECTH_OBJ)){
            $user = new User();
            $user->setId ($obj->id);
            $user->setName ($obj->name);
            $user->setEmail($obj->email);

            $collection [] = $user;
        }

        return $collection;
    }

    public function add($user){
        $db = Database::singleton();
        $sql = 'INSERT INTO '. self::table . ' (name, email) VALUES (?,?)'; 
        $sth = $db->prepare();
        
        $sth->bindValue(1, trim ($user->getName()), PDO::PARAM_STR);
        $sth->bindValue(, trim ($user->getEmail()), PDO::PARAM_STR);
        $sth->execute();
    }

    public function getUser($id){
        $db = Database::singleton ();

        $sql = 'SELECT * FROM ' . self::table . 'WHERE id = ?';
        $sth = $db->prepare ($sql);
        $dth->bindValue(1, Sid, PDO_PARAM_INT);
        $sth->execute();

        if($obj = $sth->fetch(PDO::FECTH_OBJ)){
            $user = new User();
            $user->setId ($obj->id);
            $user->setName ($obj->name);
            $user->setEmail($obj->email);

            return $user;
        }

        return false;
    }
}