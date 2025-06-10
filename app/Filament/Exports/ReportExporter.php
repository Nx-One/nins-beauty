<?php

namespace App\Filament\Exports;

use App\Models\Report;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ReportExporter extends Exporter
{
    protected static ?string $model = Report::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('date')
                ->label('Date'),
            ExportColumn::make('total_income')
                ->label('Total Income (IDR)')
                ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.') . '.000'),
            ExportColumn::make('total_orders')
                ->label('Total Orders'),
            ExportColumn::make('status')
                ->label('Status'),
            ExportColumn::make('description')
                ->label('Description'),
            ExportColumn::make('user.name')
                ->label('Verified By'),
            ExportColumn::make('created_at')
                ->label('Created At'),
            ExportColumn::make('updated_at')
                ->label('Updated At'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your report export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
