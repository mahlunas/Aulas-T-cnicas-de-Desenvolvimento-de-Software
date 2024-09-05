<?php

class UserDao
{
    const table = 'user';

    public function __construct (){}

    public function list ()
    {
        $message = Message::singleton ();

        try
        {
            $collection = [];

            $db = Database::singleton ();

            $sql = 'SELECT * FROM ' . self::table;
            //$sql = 'SELECT * FROM abc';

            $sth = $db->prepare ($sql);
            $sth->execute ();

            while ($obj = $sth->fetch(PDO::FETCH_OBJ))
            {
                $user = new User ();
                $user->setId ($obj->id);
                $user->setName ($obj->name);
                $user->setEmail ($obj->email);
                $collection [] = $user;
            }

            return $collection;
        } 
        catch (PDOException $e)
        {
            $message->addWarning ($e->getMessage ());
            $message->save ();
            return FALSE;   
        }
        catch (Exception $e)
        {
            $message->addWarning ($e->getMessage ()); 
            $message->save ();
            return FALSE;
        } 
    }

    public function add ($user)
    {
        $db = Database::singleton();

        $sql = 'INSERT INTO '. self::table .' (name, email) VALUES (?,?)';

        $sth = $db->prepare($sql);
        $sth->bindValue(1, trim ($user->getName()), PDO::PARAM_STR);
        $sth->bindValue(2, trim ($user->getEmail()), PDO::PARAM_STR);

        return $sth->execute();
    }

    public function update ($user)
    {

        $db = Database::singleton();

        $sql = 'UPDATE user SET name = ?, email = ? WHERE id = ?';

        $sth = $db->prepare($sql);
        $sth->bindValue(1, trim ($user->getName()), PDO::PARAM_STR);
        $sth->bindValue(2, trim ($user->getEmail()), PDO::PARAM_STR);
        $sth->bindValue(3, $user->getId (), PDO::PARAM_INT);

        return $sth->execute();
    }

    public function getUser ($id)
    {
        $db = Database::singleton ();

        $sql = 'SELECT * FROM ' . self::table . ' WHERE id = ?';

        $sth = $db->prepare ($sql);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        $sth->execute ();

        if ($obj = $sth->fetch(PDO::FETCH_OBJ))
        {
            $user = new User ();
            $user->setId ($obj->id);
            $user->setName ($obj->name);
            $user->setEmail ($obj->email);

            return $user;
        }
    }
}
