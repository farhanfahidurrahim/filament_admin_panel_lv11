<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class CardWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        return [
            Stat::make(
                label: 'Total posts',
                value: Product::query()
                    ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
                    ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
                    ->count(),
            ),
        ];
    }

}
