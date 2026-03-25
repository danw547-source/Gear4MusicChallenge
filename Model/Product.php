<?php

namespace App\Model;

use App\Contract\InventoryInterface;

class Product implements InventoryInterface
{
    // Treat this as fixed data after creation.
    public function __construct(
        private string $sku, // Unique product code, for example "G4M-001"
        private array $names, // Name translations, for example ['en' => 'Guitar', 'fr' => 'Guitare']
        private float $priceGBP, // Base price is stored in GBP
        private array $visibleInCountries, // Country codes where this product can be shown, for example ['GB', 'FR']
        private int $stock,
        private int $weight, // In grams
        private int $boxVolume, // In cubic centimeters
        private int $daysToDeliver,
        private Condition $condition = Condition::New, // If not provided, condition defaults to new
    ) {}

    public function getSku(): string
    {
        return $this->sku;
    }
    public function getStockLevel(): int
    {
        return $this->stock;
    }
    public function getWeight(): int
    {
        return $this->weight;
    }
    public function getBoxVolume(): int
    {
        return $this->boxVolume;
    }
    public function getDaysToDeliver(): int
    {
        return $this->daysToDeliver;
    }
    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }

    public function isVisibleIn(string $countryCode): bool
    {
        // Match country codes case-insensitively so inputs like gb and GB both work.
        return in_array(strtoupper($countryCode), $this->visibleInCountries, true);
    }

    public function getName(string $language = 'en'): string
    {
        // Name fallback order: requested language, then English, then SKU.
        return $this->names[$language] ?? $this->names['en'] ?? $this->sku;
    }

    public function getPrice(string $currency = "GBP"): float
    {
        // Conversion happens in the service; this model only returns base GBP price.
        // Currency is accepted here to satisfy the interface contract.
        return $this->priceGBP;
    }

    // Standard products are physical by default.
    public function getType(): string
    {
        return 'physical';
    }

    public function getCondition(): Condition
    {
        return $this->condition;
    }
}