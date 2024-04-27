<?php
declare(strict_types = 1);

class Item {
    public int $id;
    public string $itemName;
    public string $itemBrand;
    public int $itemPrice; // This should be of type float or int based on your SQL schema
    public int $itemOwner; // Changed from string to int

    public function __construct(int $id, string $itemName, string $itemBrand, int $itemOwner, int $itemPrice)
    {
        $this->id = $id;
        $this->itemName = $itemName;
        $this->itemBrand = $itemBrand;
        $this->itemOwner = $itemOwner;
        $this->itemPrice = $itemPrice;
    }

    static function getItems(PDO $db, int $count): array {
        $stmt = $db->prepare('SELECT ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner FROM Item LIMIT ?');
        $stmt->execute(array($count));
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                $item['ItemId'],
                $item['ItemName'],
                $item['ItemBrand'],
                $item['ItemOwner'],
                $item['ItemPrice']
            );
        }
    
        return $items;
    }
    
    static function searchItems(PDO $db, string $search, int $count) : array {
        $stmt = $db->prepare('SELECT ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner FROM Item WHERE ItemName LIKE ? LIMIT ?');
        $stmt->execute(array($search . '%', $count));
    
        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                $item['ItemId'],
                $item['ItemName'],
                $item['ItemBrand'],
                $item['ItemOwner'],
                $item['ItemPrice']
            );
        }
    
        return $items;
    }

    static function getItem(PDO $db, int $id) : Item {
        $stmt = $db->prepare('SELECT ItemId, ItemBrand, ItemName, ItemPrice, ItemOwner FROM Item WHERE ItemId = ?');
        $stmt->execute(array($id));
    
        $item = $stmt->fetch();
    
        return new Item(
            $item['ItemId'],
            $item['ItemName'],
            $item['ItemBrand'],
            $item['ItemOwner'],
            $item['ItemPrice']
        );
    }
}
?>
