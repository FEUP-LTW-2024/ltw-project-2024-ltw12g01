<?php
declare(strict_types = 1);

class Item {
    public int $id;
    public string $itemName;
    public string $itemBrand;
    public string $itemDescription;
    public int $itemPrice;
    public string $itemOwner;
    public string $itemCategory;
    public string $ItemImage;
    public string $itemSize;
    public string $itemCondition;

    public function __construct(int $id, string $itemName, string $itemBrand, string $itemDescription, int $itemPrice, string $itemOwner, string $itemCategory, string $ItemImage,string $itemSize, string $itemCondition)
    {
        $this->id = $id;
        $this->itemName = $itemName;
        $this->itemBrand = $itemBrand;
        $this->itemDescription = $itemDescription;
        $this->itemPrice = $itemPrice;
        $this->itemOwner = $itemOwner;
        $this->itemCategory = $itemCategory;
        $this->ItemImage = $ItemImage ?? ''; 
        $this->itemSize = $itemSize;
        $this->itemCondition = $itemCondition;
    }

    static function getItems(PDO $db, int $count): array {
        $stmt = $db->prepare('SELECT ItemId, ItemName, ItemBrand, ItemDescription, ItemPrice, ItemOwner, ItemCategory, ItemImage, ItemSize, ItemCondition FROM Item LIMIT ?');
        $stmt->execute(array($count));
    
        $items = array();
        while ($item = $stmt->fetchObject()) {
            $items[] = new Item(
                $item->ItemId,
                $item->ItemName,
                $item->ItemBrand,
                $item->ItemDescription,
                $item->ItemPrice,
                $item->ItemOwner,
                $item->ItemCategory,
                $item->ItemImage ?? '', // Use the null coalescing operator to provide an empty string if ItemImage is null
                $item->ItemSize,
                $item->ItemCondition
            );
        }
    
        return $items;
    }

    static public function getAllItemsFromDatabase(PDO $db): array {
        $stmt = $db->prepare('SELECT ItemId, ItemName, ItemBrand, ItemDescription, ItemPrice, ItemOwner, ItemCategory, ItemImage, ItemSize, ItemCondition FROM Item');
        $stmt->execute();
    
        $items = array();
        while ($item = $stmt->fetchObject()) {
            $items[] = new Item(
                $item->ItemId,
                $item->ItemName,
                $item->ItemBrand,
                $item->ItemDescription,
                $item->ItemPrice,
                $item->ItemOwner,
                $item->ItemCategory,
                $item->ItemImage ?? '', // Use the null coalescing operator to provide an empty string if ItemImage is null
                $item->ItemSize,
                $item->ItemCondition
            );
        }
    
        return $items;
    }

    static function getItemsStartingOn(PDO $db, int $startingID, int $count): array {
        $stmt = $db->prepare('SELECT ItemId, ItemName, ItemBrand, ItemDescription, ItemPrice, ItemOwner, ItemCategory, ItemImage, ItemSize, ItemCondition FROM Item WHERE ItemId >= ? LIMIT ?');
        $stmt->execute(array($startingID, $count));
    
        $items = array();
        while ($item = $stmt->fetchObject()) {
            $items[] = new Item(
                $item->ItemId,
                $item->ItemName,
                $item->ItemBrand,
                $item->ItemDescription,
                $item->ItemPrice,
                $item->ItemOwner,
                $item->ItemCategory,
                $item->ItemImage ?? '', // Use the null coalescing operator to provide an empty string if ItemImage is null
                $item->ItemSize,
                $item->ItemCondition
            );
        }
    
        return $items;
    }

    static function searchItems(PDO $db, string $search, int $count) : array {
        $stmt = $db->prepare('SELECT ItemId, ItemName, ItemBrand, ItemDescription, ItemPrice, ItemOwner, ItemCategory, ItemImage, ItemSize, ItemCondition FROM Item WHERE ItemName LIKE ? LIMIT ?');
        $stmt->execute(array($search . '%', $count));

        $items = array();
        while ($item = $stmt->fetch()) {
            $items[] = new Item(
                $item['ItemId'],
                $item['ItemName'],
                $item['ItemBrand'],
                $item['ItemDescription'],
                $item['ItemPrice'],
                $item['ItemOwner'],
                $item['ItemCategory'],
                $item['ItemImage'],
                $item['ItemSize'],
                $item['ItemCondition']
            );
        }

        return $items;
    }

    static function getItem(PDO $db, int $id) : Item {
        $stmt = $db->prepare('SELECT ItemId, ItemName, ItemBrand, ItemDescription, ItemPrice, ItemOwner, ItemCategory, ItemImage, ItemSize, ItemCondition FROM Item WHERE ItemId = ?');
        $stmt->execute(array($id));
        
        $item = $stmt->fetch();
        
        return new Item(
            $item['ItemId'],
            $item['ItemName'],
            $item['ItemBrand'],
            $item['ItemDescription'],
            $item['ItemPrice'],
            $item['ItemOwner'],
            $item['ItemCategory'],
            is_null($item['ItemImage']) ? '' : $item['ItemImage'],
            $item['ItemSize'],
            $item['ItemCondition']
        );
    }

    static public function deleteItemById(PDO $db, int $id) : bool {
        $stmt = $db->prepare('DELETE FROM Item WHERE ItemId = ?');
        return $stmt->execute(array($id));
    }

    public function getImageUrl() {
        return $this->ItemImage;
    }

    static public function updateItem(PDO $db, int $itemId, string $itemName, string $itemBrand, string $itemOwner, string $itemDescription, string $itemCategory, int $itemPrice, string $itemCondition, string $itemSize) : bool {
        $stmt = $db->prepare('UPDATE Item SET ItemName = ?, ItemBrand = ?, ItemOwner = ?, ItemDescription = ?, ItemCategory = ?, ItemPrice = ?, ItemCondition = ?, ItemSize = ? WHERE ItemId = ?');
        return $stmt->execute(array($itemName, $itemBrand, $itemOwner, $itemDescription, $itemCategory, $itemPrice, $itemCondition, $itemSize, $itemId));
    }

}

?>