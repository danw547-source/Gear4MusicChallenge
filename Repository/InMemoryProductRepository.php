<?php

namespace App\Repository;

use App\Model\Condition;
use App\Model\DigitalProduct;
use App\Model\Product;

class InMemoryProductRepository
{
    // Returns sample products for demo and testing without needing a database.
    public function getAll(): array
    {
        return [
            new Product(
                sku: 'G4M-001',
                names: ['en' => 'Acoustic Guitar', 'fr' => 'Guitare Acoustique', 'de' => 'Akustikgitarre'],
                priceGBP: 99.99,
                visibleInCountries: ['GB', 'FR', 'DE'],
                stock: 15,
                weight: 2500,
                boxVolume: 18000,
                daysToDeliver: 2,
                condition: Condition::Used,
            ),
            new Product(
                sku: 'G4M-002',
                names: ['en' => 'Digital Piano', 'fr' => 'Piano Numérique'],
                priceGBP: 499.00,
                visibleInCountries: ['GB', 'FR'],
                stock: 4,
                weight: 12000,
                boxVolume: 85000,
                daysToDeliver: 4,
                condition: Condition::Refurbished,
            ),
            new Product(
                sku: 'G4M-003',
                names: ['en' => 'Drum Kit'],
                priceGBP: 299.00,
                // Keep this product UK-only so country filtering is easy to demonstrate.
                visibleInCountries: ['GB'],  // Not shown in France
                stock: 8,
                weight: 18000,
                boxVolume: 120000,
                daysToDeliver: 6,
            ),
            new DigitalProduct(
                sku: 'G4M-D001',
                names: ['en' => 'Guitar Chord Book (PDF)', 'fr' => 'Livre d\'Accords Guitare (PDF)'],
                priceGBP: 9.99,
                downloadFormat: 'PDF',
            ),
            new DigitalProduct(
                sku: 'G4M-D002',
                names: ['en' => 'Synth Preset Pack', 'fr' => 'Pack de Presets Synthe'],
                priceGBP: 14.99,
                downloadFormat: 'ZIP',
            ),
        ];
    }
}