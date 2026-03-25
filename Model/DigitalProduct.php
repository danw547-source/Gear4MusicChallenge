<?php

namespace App\Model;

class DigitalProduct extends Product
{
    public function __construct(
        string $sku,
        array $names,
        float $priceGBP,
        private string $downloadFormat,
    ) {
        parent::__construct(
            sku: $sku,
            names: $names,
            priceGBP: $priceGBP,
            visibleInCountries: [],
            stock: PHP_INT_MAX,
            weight: 0,
            boxVolume: 0,
            daysToDeliver: 0,
            // Digital products do not have wear and tear, so condition is always new.
            condition: Condition::New,
        );
    }

    public function isVisibleIn(string $countryCode): bool
    {
        return true;
    }

    public function isAvailable(): bool
    {
        return true;
    }

    public function getDownloadFormat(): string
    {
        return $this->downloadFormat;
    }

    public function getType(): string
    {
        return 'digital';
    }
}