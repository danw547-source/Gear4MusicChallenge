<?php

namespace App\Service;

use App\Repository\InMemoryProductRepository;

class InventoryService
{
    // Demo exchange rates based on GBP.
    // In a real app, these would come from a configurable or external source.
    private const RATES = [
        'GBP' => 1.00,
        'EUR' => 1.17,
        'USD' => 1.27,
    ];

    // Inject repository so the service can read product data.
    public function __construct(private InMemoryProductRepository $repository)
    {
    }

    public function getInventory(string $country, string $language, string $currency): array
    {
        $currency = $this->resolveCurrency($currency);
        $rate = self::RATES[$currency];

        // Build plain rows for the presenter/controller layer.
        $results = [];

        foreach ($this->repository->getAll() as $product) {
            // Skip anything that is not visible in this country or not available.
            if (!$product->isVisibleIn($country) || !$product->isAvailable()) {
                continue;
            }
            // Keep prices at two decimal places for display.
            $convertedPrice = round($product->getPrice() * $rate, 2);

            // Keep output keys explicit and stable.
            $results[] = [
                'sku'             => $product->getSku(),
                'type'            => $product->getType(),
                'name'            => $product->getName($language),
                'price'           => $convertedPrice,
                'currency'        => $currency,
                'stock'           => $product->getStockLevel(),
                'weight_g'        => $product->getWeight(),
                'box_volume_cm3'  => $product->getBoxVolume(),
                'days_to_deliver' => $product->getDaysToDeliver(),
                'condition'       => $product->getCondition()->value,
            ];
        }

        // Return only products that passed filtering.
        return $results;
    }

    public function resolveCurrency(string $currency): string
    {
        // Normalize input and fall back to GBP for unknown currency codes.
        $currency = strtoupper($currency);
        return isset(self::RATES[$currency]) ? $currency : 'GBP';
    }
}