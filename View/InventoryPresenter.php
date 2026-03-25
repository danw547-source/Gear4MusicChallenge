<?php

namespace App\View;

class InventoryPresenter
{
    public function toJson(array $rows, string $country, string $language, string $currency): string
    {
        $output = [
            'context' => [
                'country'  => strtoupper($country),
                'language' => $language,
                'currency' => strtoupper($currency),
            ],
            'products' => $rows,
            'total'    => count($rows),
        ];

        // Format the JSON so it's easier for people to read.
        // Keep accented characters like é as normal text
        // instead of escaped Unicode sequences.
        return json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}