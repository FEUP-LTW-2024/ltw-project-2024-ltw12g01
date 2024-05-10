<?php
declare(strict_types=1);

class ShipmentUserInfo {
    public int $shipmentUserInfoId;
    public int $userId;  // Added property for UserId
    public string $shippingAddress;
    public string $shippingCity;
    public string $shippingState;
    public string $shippingZipCode;
    public string $shippingCountry;

    public function __construct(int $shipmentUserInfoId, int $userId, string $shippingAddress, string $shippingCity, string $shippingState, string $shippingZipCode, string $shippingCountry) {
        $this->shipmentUserInfoId = $shipmentUserInfoId;
        $this->userId = $userId; 
        $this->shippingAddress = $shippingAddress;
        $this->shippingCity = $shippingCity;
        $this->shippingState = $shippingState;
        $this->shippingZipCode = $shippingZipCode;
        $this->shippingCountry = $shippingCountry;
    }

    public function getShipmentUserInfoId(): int {
        return $this->shipmentUserInfoId;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getShippingAddress(): string {
        return $this->shippingAddress;
    }

    public function getShippingCity(): string {
        return $this->shippingCity;
    }

    public function getShippingState(): string {
        return $this->shippingState;
    }

    public function getShippingZipCode(): string {
        return $this->shippingZipCode;
    }

    public function getShippingCountry(): string {
        return $this->shippingCountry;
    }

    public function setShippingAddress(string $shippingAddress): void {
        $this->shippingAddress = $shippingAddress;
    }

    public function setShippingCity(string $shippingCity): void {
        $this->shippingCity = $shippingCity;
    }

    public function setShippingState(string $shippingState): void {
        $this->shippingState = $shippingState;
    }

    public function setShippingZipCode(string $shippingZipCode): void {
        $this->shippingZipCode = $shippingZipCode;
    }

    public function setShippingCountry(string $shippingCountry): void {
        $this->shippingCountry = $shippingCountry;
    }

    public static function getShipmentInfoUserID(PDO $db, int $userId): ?ShipmentUserInfo {
        $stmt = $db->prepare('SELECT * FROM ShipmentUserInfo WHERE UserId = ?');
        $stmt->bindParam(1, $userId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new ShipmentUserInfo($row['ShipmentUserInfoId'], $row['UserId'], $row['ShippingAddress'], $row['ShippingCity'], $row['ShippingState'], $row['ShippingZipCode'], $row['ShippingCountry']);
        }
        return null;
    }
}
?>
