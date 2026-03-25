<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\InventoryController;
use App\Repository\InMemoryProductRepository;
use App\Service\InventoryService;
use App\View\InventoryPresenter;

// Wire up dependencies.
$repository = new InMemoryProductRepository();
$service    = new InventoryService($repository);
$presenter  = new InventoryPresenter();
$controller = new InventoryController($service, $presenter);

// Example A: UK customer in English and GBP.
echo "=== Example A: GB / English / GBP ===" . PHP_EOL;
echo $controller->index('GB', 'en', 'GBP') . PHP_EOL;

echo PHP_EOL;

// Example B: French customer in French and EUR.
echo "=== Example B: FR / French / EUR ===" . PHP_EOL;
echo $controller->index('FR', 'fr', 'EUR') . PHP_EOL;