<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class StatsOverview extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'الأطباء لكل مستشفى',
                    'data' => [10, 25, 15, 30], // هنا سنضع استعلام من قاعدة البيانات لاحقاً
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                    'borderWidth' => 1,
                    'borderRadius' => 5,
                    'barPercentage' => 0.5,
                    
                ],
            ],
            'labels' => ['مستشفى الشفاء', 'مستشفى القدس', 'المستشفى الأهلي'], // أسماء المستشفيات
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
