<?php

namespace App\Controller;

use App\Service\InventoryService;
use App\View\InventoryPresenter;

// Thin controller: takes request inputs, asks the service for data, then hands it to the presenter.
class InventoryController
{
    public function __construct(
        private InventoryService $service,
        private InventoryPresenter $presenter
    ) {}

    public function index(string $country, string $language, string $currency): string
    {
        // Resolve currency once so pricing and response context stay in sync.
        $resolvedCurrency = $this->service->resolveCurrency($currency);
        $rows = $this->service->getInventory($country, $language, $resolvedCurrency);
        return $this->presenter->toJson($rows, $country, $language, $resolvedCurrency);
    }
}