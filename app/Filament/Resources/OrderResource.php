<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('order_date')
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->label('Order Status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'shipped' => 'Shipped',
                    ])
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('Customer Name')
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->disabled(),
                Forms\Components\TextInput::make('total_amount')
                    ->disabled()
                    ->label('Total (IDR)')
                    ->numeric()
                    ->prefix('Rp ')
                    ->default(null)
                    ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') . '.000' : null),
                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->disabled()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('address')
                    ->label('Address')
                    ->disabled()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone Number')
                    ->disabled()
                    ->tel()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('payment_method')
                    ->label('Payment Method')
                    ->disabled()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('payment_proof')
                    ->label('Payment Proof (filename)')
                    ->maxLength(255)
                    ->disabled(),
                Forms\Components\ViewField::make('payment_proof_image')
                    ->label('Payment Proof Image')
                    ->view('filament.components.payment-proof-image'),
                Forms\Components\ViewField::make('order_details')
                    ->label('Order Details')
                    ->view('filament.components.order-details'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->label('Total (IDR)')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.') . '.000')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_proof')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
