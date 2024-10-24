<?php

class ProductDao
{
    const table = 'product';

    public function __construct(){}

    public function list()
    {
        $collection = [];

        $db = Database::singleton();

        $sql = 'SELECT * FROM ' . self::table;

        $sth = $db->prepare($sql);
        $sth->execute();

        while ($obj = $sth->fetch(PDO::FETCH_OBJ))
        {
            $product = new Product();
            $product->setId($obj->id);
            $product->setName($obj->name);
            $product->setPrice($obj->price);
            $product->setDescription($obj->description);
            $collection[] = $product;
        }

        return $collection;
    }

    public function add($product)
    {
        $db = Database::singleton();

        $sql = 'INSERT INTO '. self::table .' (name, price, description) VALUES (?, ?, ?)';

        $sth = $db->prepare($sql);
        $sth->bindValue(1, trim($product->getName()), PDO::PARAM_STR);
        $sth->bindValue(2, $product->getPrice(), PDO::PARAM_STR);
        $sth->bindValue(3, trim($product->getDescription()), PDO::PARAM_STR);
    
        return $sth->execute();
    }

    public function update($product)
    {
        $db = Database::singleton();

        $sql = 'UPDATE ' . self::table . ' SET name = ?, price = ?, description = ? WHERE id = ?';

        $sth = $db->prepare($sql);
        $sth->bindValue(1, trim($product->getName()), PDO::PARAM_STR);
        $sth->bindValue(2, $product->getPrice(), PDO::PARAM_STR);
        $sth->bindValue(3, trim($product->getDescription()), PDO::PARAM_STR);
        $sth->bindValue(4, $product->getId(), PDO::PARAM_INT);

        return $sth->execute();
    }

    public function getProductById($id)
    {
        $db = Database::singleton();

        $sql = 'SELECT * FROM ' . self::table . ' WHERE id = ?';

        $sth = $db->prepare($sql);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        $sth->execute();

        if ($obj = $sth->fetch(PDO::FETCH_OBJ))
        {
            $product = new Product();
            $product->setId($obj->id);
            $product->setName($obj->name);
            $product->setPrice($obj->price);
            $product->setDescription($obj->description);
            return $product;
        }
        return null; // Retorna null se o produto não for encontrado
    }

    public function delete($id)
    {
        $db = Database::singleton();

        $sql = 'DELETE FROM ' . self::table . ' WHERE id = ?';

        $sth = $db->prepare($sql);
        $sth->bindValue(1, $id, PDO::PARAM_INT);
        $sth->execute();

        return TRUE;
    }

}
