<?php

namespace App\Contract;

// This defines the common shape every inventory product must follow.
interface InventoryInterface
{
    public function getName(string $language = "en"): string;

    public function getPrice(string $currency = "GBP"): float;

    public function isAvailable(): bool;

    public function isVisibleIn(string $countryCode): bool;

    public function getWeight(): int;

    public function getBoxVolume(): int;

    public function getDaysToDeliver(): int;

    public function getStockLevel(): int;
}
