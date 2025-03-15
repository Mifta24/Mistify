<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Transaction Management';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Payment Information')
                            ->schema([
                                Forms\Components\Select::make('order_id')
                                    ->relationship('order', 'order_number')
                                    ->required()
                                    ->searchable()
                                    ->preload(),

                                Forms\Components\TextInput::make('payment_number')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->default('PAY-' . uniqid()),

                                Forms\Components\TextInput::make('amount')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->maxValue(999999999),

                                Forms\Components\Select::make('payment_method')
                                    ->options([
                                        Payment::METHOD_BANK_TRANSFER => 'Bank Transfer',
                                        Payment::METHOD_E_WALLET => 'E-Wallet',
                                        Payment::METHOD_CREDIT_CARD => 'Credit Card',
                                        Payment::METHOD_COD => 'Cash on Delivery',
                                    ])
                                    ->required(),

                                Forms\Components\Select::make('status')
                                    ->options([
                                        Payment::STATUS_PENDING => 'Pending',
                                        Payment::STATUS_PROCESSING => 'Processing',
                                        Payment::STATUS_COMPLETED => 'Completed',
                                        Payment::STATUS_FAILED => 'Failed',
                                        Payment::STATUS_REFUNDED => 'Refunded',
                                    ])
                                    ->default(Payment::STATUS_PENDING)
                                    ->required(),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Bank Information')
                            ->schema([
                                Forms\Components\TextInput::make('bank_name')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('account_number')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('account_name')
                                    ->maxLength(255),
                            ])
                            ->columns(3)
                            ->visible(fn (Forms\Get $get) =>
                                $get('payment_method') === Payment::METHOD_BANK_TRANSFER),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Payment Proof')
                            ->schema([
                                Forms\Components\FileUpload::make('payment_proof')
                                    ->image()
                                    ->disk('public')
                                    ->directory('payment-proofs')
                                    ->columnSpanFull(),

                                Forms\Components\Textarea::make('notes')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),

                                Forms\Components\DateTimePicker::make('paid_at')
                                    ->native(false),
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
                Tables\Columns\TextColumn::make('payment_number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order.order_number')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Payment::METHOD_BANK_TRANSFER => 'info',
                        Payment::METHOD_E_WALLET => 'success',
                        Payment::METHOD_CREDIT_CARD => 'warning',
                        Payment::METHOD_COD => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Payment::STATUS_PENDING => 'warning',
                        Payment::STATUS_PROCESSING => 'info',
                        Payment::STATUS_COMPLETED => 'success',
                        Payment::STATUS_FAILED => 'danger',
                        Payment::STATUS_REFUNDED => 'gray',
                        default => 'gray',
                    }),

                Tables\Columns\ImageColumn::make('payment_proof')
                    ->disk('public')
                    ->circular(),

                Tables\Columns\TextColumn::make('paid_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        Payment::METHOD_BANK_TRANSFER => 'Bank Transfer',
                        Payment::METHOD_E_WALLET => 'E-Wallet',
                        Payment::METHOD_CREDIT_CARD => 'Credit Card',
                        Payment::METHOD_COD => 'Cash on Delivery',
                    ]),

                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        Payment::STATUS_PENDING => 'Pending',
                        Payment::STATUS_PROCESSING => 'Processing',
                        Payment::STATUS_COMPLETED => 'Completed',
                        Payment::STATUS_FAILED => 'Failed',
                        Payment::STATUS_REFUNDED => 'Refunded',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
