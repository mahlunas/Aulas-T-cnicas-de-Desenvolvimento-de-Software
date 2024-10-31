<?php

class CartItemRegistry {
    private static $items = [];

    public static function addItem($id, CartItem $item) {
        self::$items[$id] = $item;
    }

    public static function getItem($id) {
        if (array_key_exists($id, self::$items)) {
            return self::$items[$id];
        } else {
            return null;
        }
    }

    public static function removeItem($id) {
        if (array_key_exists($id, self::$items)) {
            unset(self::$items[$id]);
        }
    }

    public static function getAllItems() {
        return self::$items;
    }

    public static function save() {
        $_SESSION ['cartItem'] = serialize(self::$items);
    }

    public static function load() 
	{
		if (isset ($_SESSION['cartItem']))
			self::$items = unserialize ($_SESSION['cartItem']);
	}
}
