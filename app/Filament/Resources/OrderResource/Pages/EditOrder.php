<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Report;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $original = $this->record->getOriginal();
        // If status is being changed to 'paid' and was not 'paid' before
        if (($data['status'] ?? null) === 'paid' && ($original['status'] ?? null) !== 'paid') {
            // Prevent duplicate report for the same order
            $reportExists = Report::where('description', 'order_id:' . $this->record->id)
                ->where('status', 'paid')
                ->exists();
            if (! $reportExists) {
                $order = $this->record->fresh(['orderDetails']);
                $totalIncome = $order->orderDetails->sum('subtotal');
                $totalOrders = $order->orderDetails->sum('quantity');
                Report::create([
                    'date' => $order->order_date ? \Carbon\Carbon::parse($order->order_date)->startOfDay() : now()->startOfDay(),
                    'total_income' => $totalIncome,
                    'total_orders' => $totalOrders,
                    'status' => 'paid',
                    'description' => 'order_id:' . $order->id,
                    'user_id' => Auth::id(),
                ]);
                // Reduce product stock
                foreach ($order->orderDetails as $item) {
                    if ($item->product) {
                        $item->product->decrement('stock', $item->quantity);
                    }
                }
            }
        }
        return $data;
    }
}
