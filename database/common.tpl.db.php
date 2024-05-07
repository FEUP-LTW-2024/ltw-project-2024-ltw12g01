<?php
    declare(strict_types = 1);

    function getNumberOfItems(PDO $db): int {
        try {
            $stmt = $db->prepare("SELECT COUNT(*)
                                FROM sqlite_master
                                WHERE type='table' AND name='Item'");
            $stmt->execute();
            $result = $stmt->fetchColumn(); 
            return (int) $result; 
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return -1;
    }


?>