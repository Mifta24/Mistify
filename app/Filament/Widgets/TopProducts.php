<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class TopProducts extends ChartWidget
{
    protected static ?string $heading = 'Top Selling Perfumes';
    protected static ?int $sort = 3;
    protected int $limit = 5;

    protected function getData(): array
    {
        $products = Product::withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->limit($this->limit)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Sales Count',
                    'data' => $products->pluck('order_items_count'),
                    'backgroundColor' => [
                        '#D97706', // amber
                        '#DC2626', // rose
                        '#2563EB', // blue
                        '#059669', // emerald
                        '#6B7280', // gray
                    ],
                    'borderWidth' => 0,
                    'hoverOffset' => 4,
                ]
            ],
            'labels' => $products->pluck('name'),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                    'labels' => [
                        'padding' => 20,
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                    ],
                ],
                'datalabels' => [
                    'color' => '#ffffff',
                    'formatter' => "function(value, context) {
                        return value + ' sales';
                    }",
                ],
            ],
            'cutout' => '60%',
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
