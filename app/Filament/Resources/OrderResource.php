<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Transaction Management';
    protected static ?int $navigationSort = 5;
    protected static ?string $recordTitleAttribute = 'order_number';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', Order::STATUS_PENDING)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Order Information')
                            ->schema([
                                Forms\Components\TextInput::make('order_number')
                                    ->default('ORD-' . uniqid())
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->disabled(),

                                Forms\Components\Select::make('user_id')
                                    ->relationship('user', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\TextInput::make('total_price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->disabled(),

                                Forms\Components\TextInput::make('shipping_fee')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp'),

                                Forms\Components\Select::make('status')
                                    ->options([
                                        Order::STATUS_PENDING => 'Pending',
                                        Order::STATUS_PROCESSING => 'Processing',
                                        Order::STATUS_SHIPPED => 'Shipped',
                                        Order::STATUS_DELIVERED => 'Delivered',
                                        Order::STATUS_CANCELLED => 'Cancelled',
                                    ])
                                    ->required()
                                    ->default(Order::STATUS_PENDING)
                                    ->native(false),

                                Forms\Components\Select::make('payment_status')
                                    ->options([
                                        Order::PAYMENT_UNPAID => 'Unpaid',
                                        Order::PAYMENT_PAID => 'Paid',
                                        Order::PAYMENT_REFUNDED => 'Refunded',
                                    ])
                                    ->required()
                                    ->default(Order::PAYMENT_UNPAID)
                                    ->native(false),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Shipping Information')
                            ->schema([
                                Forms\Components\TextInput::make('shipping_name')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('shipping_phone')
                                    ->required()
                                    ->tel()
                                    ->maxLength(20),

                                Forms\Components\Textarea::make('shipping_address')
                                    ->required()
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('shipping_city')
                                    ->required()
                                    ->maxLength(100),

                                Forms\Components\TextInput::make('shipping_postal_code')
                                    ->required()
                                    ->maxLength(10),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Order Items')
                            ->schema([
                                Forms\Components\Repeater::make('items')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\Select::make('product_id')
                                            ->relationship('product', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload(),
                                        Forms\Components\TextInput::make('quantity')
                                            ->required()
                                            ->numeric()
                                            ->minValue(1),
                                        Forms\Components\TextInput::make('price')
                                            ->required()
                                            ->numeric()
                                            ->prefix('Rp'),
                                    ])
                                    ->columns(3)
                            ])
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Order Summary')
                            ->schema([
                                Forms\Components\Placeholder::make('created_at')
                                    ->label('Order Date')
                                    ->content(fn ($record): string => $record?->created_at?->format('d M Y H:i') ?? '-'),

                                Forms\Components\Placeholder::make('updated_at')
                                    ->label('Last Updated')
                                    ->content(fn ($record): string => $record?->updated_at?->format('d M Y H:i') ?? '-'),

                                Forms\Components\Placeholder::make('payment_method')
                                    ->content(fn ($record): string => strtoupper($record?->payment_method ?? '-')),
                            ]),

                        Forms\Components\Section::make('Notes')
                            ->schema([
                                Forms\Components\Textarea::make('notes')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Order number copied')
                    ->copyMessageDuration(1500),

                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Order::STATUS_PENDING => 'warning',
                        Order::STATUS_PROCESSING => 'info',
                        Order::STATUS_SHIPPED => 'primary',
                        Order::STATUS_DELIVERED => 'success',
                        Order::STATUS_CANCELLED => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Order::PAYMENT_UNPAID => 'danger',
                        Order::PAYMENT_PAID => 'success',
                        Order::PAYMENT_REFUNDED => 'warning',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('shipping_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('shipping_city')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        Order::STATUS_PENDING => 'Pending',
                        Order::STATUS_PROCESSING => 'Processing',
                        Order::STATUS_SHIPPED => 'Shipped',
                        Order::STATUS_DELIVERED => 'Delivered',
                        Order::STATUS_CANCELLED => 'Cancelled',
                    ]),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->options([
                        Order::PAYMENT_UNPAID => 'Unpaid',
                        Order::PAYMENT_PAID => 'Paid',
                        Order::PAYMENT_REFUNDED => 'Refunded',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('print')
                    ->icon('heroicon-o-printer')
                    ->url(fn (Order $record): string => route('orders.print', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
