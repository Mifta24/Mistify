<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Shop Management';

    protected static ?string $navigationLabel = 'Perfume Products';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Tabs::make('Product Information')
                            ->tabs([
                                Tabs\Tab::make('Basic Information')
                                    ->schema([
                                        Forms\Components\TextInput::make('name')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn(string $state, Forms\Set $set) =>
                                            $set('slug', Str::slug($state)))
                                            ->placeholder('Enter product name'),
                                        Forms\Components\TextInput::make('slug')
                                            ->required()
                                            ->maxLength(255)
                                            ->unique(ignoreRecord: true)
                                            ->disabled()
                                            ->dehydrated()
                                            ->placeholder('Auto-generated from name'),
                                        Forms\Components\Select::make('category_id')
                                            ->relationship('category', 'name')
                                            ->required(),
                                        Forms\Components\TextInput::make('brand')
                                            ->maxLength(255)
                                            ->placeholder('Enter brand name'),
                                        Forms\Components\Select::make('gender')
                                            ->options([
                                                'Male' => 'Male',
                                                'Female' => 'Female',
                                                'Unisex' => 'Unisex',
                                            ])
                                            ->placeholder('Select target gender'),
                                        Forms\Components\TextInput::make('price')
                                            ->required()
                                            ->numeric()
                                            ->prefix('Rp')
                                            ->placeholder('Base price'),
                                        Forms\Components\TextInput::make('stock')
                                            ->required()
                                            ->numeric()
                                            ->placeholder('Total stock'),
                                        Forms\Components\Select::make('default_size')
                                            ->options([
                                                '5' => '5ml',
                                                '10' => '10ml',
                                                '30' => '30ml',
                                                '50' => '50ml',
                                                '100' => '100ml',
                                                '200' => '200ml',
                                            ])
                                            ->placeholder('Default size'),
                                    ])
                                    ->columns(2),

                                Tabs\Tab::make('Product Details')
                                    ->schema([
                                        Forms\Components\RichEditor::make('description')
                                            ->toolbarButtons([
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                        Forms\Components\Select::make('concentration')
                                            ->options([
                                                'Perfume' => 'Perfume (Parfum)',
                                                'EDP' => 'Eau de Parfum (EDP)',
                                                'EDT' => 'Eau de Toilette (EDT)',
                                                'EDC' => 'Eau de Cologne (EDC)',
                                                'Body Spray' => 'Body Spray',
                                            ])
                                            ->placeholder('Select concentration type'),
                                        Forms\Components\Select::make('fragrance_family')
                                            ->options([
                                                'Floral' => 'Floral',
                                                'Oriental' => 'Oriental',
                                                'Woody' => 'Woody',
                                                'Fresh' => 'Fresh',
                                                'Aromatic' => 'Aromatic',
                                                'Citrus' => 'Citrus',
                                                'Gourmand' => 'Gourmand',
                                                'Spicy' => 'Spicy',
                                                'Chypre' => 'Chypre',
                                            ])
                                            ->placeholder('Select fragrance family'),
                                    ])
                                    ->columns(2),
                                // Untuk menampilkan scent notes dalam bentuk repeater. Scent Notes adalah array yang berisi top, middle, dan base notes.
                                Tabs\Tab::make('Scent Notes')
                                    ->schema([
                                        Forms\Components\Repeater::make('scent_notes.top')
                                            ->label('Top Notes')
                                            ->schema([
                                                Forms\Components\TextInput::make('note')
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->itemLabel(fn(array $state): ?string => $state['note'] ?? null)
                                            ->collapsible()
                                            ->columns(2),

                                        Forms\Components\Repeater::make('scent_notes.middle')
                                            ->label('Middle Notes')
                                            ->schema([
                                                Forms\Components\TextInput::make('note')
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->itemLabel(fn(array $state): ?string => $state['note'] ?? null)
                                            ->collapsible()
                                            ->columns(2),

                                        Forms\Components\Repeater::make('scent_notes.base')
                                            ->label('Base Notes')
                                            ->schema([
                                                Forms\Components\TextInput::make('note')
                                                    ->required()
                                                    ->maxLength(255),
                                            ])
                                            ->itemLabel(fn(array $state): ?string => $state['note'] ?? null)
                                            ->collapsible()
                                            ->columns(2),
                                    ]),

                                Tabs\Tab::make('Size & Pricing')
                                    ->schema([
                                        Forms\Components\Repeater::make('sizes')
                                            ->label('Available Sizes')
                                            ->schema([
                                                Forms\Components\TextInput::make('size')
                                                    ->label('Size (ml)')
                                                    ->required()
                                                    ->numeric()
                                                    ->suffix('ml'),
                                                Forms\Components\TextInput::make('price')
                                                    ->label('Price')
                                                    ->required()
                                                    ->numeric()
                                                    ->prefix('Rp'),
                                                Forms\Components\TextInput::make('stock')
                                                    ->label('Stock')
                                                    ->required()
                                                    ->numeric(),
                                            ])
                                            ->itemLabel(fn(array $state): ?string => $state['size'] . 'ml - Rp ' . number_format($state['price'] ?? 0))
                                            ->collapsible()
                                            ->columns(3),
                                    ]),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columnSpan(['lg' => 2]),

                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Image & Status')
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('products')
                                    ->imageEditor()
                                    ->imageEditorMode(2)
                                    ->imageEditorAspectRatios([
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->loadingIndicatorPosition('left')
                                    ->panelAspectRatio('2:1')
                                    ->panelLayout('integrated')
                                    ->removeUploadedFileButtonPosition('right')
                                    ->uploadProgressIndicatorPosition('left'),

                                Forms\Components\Section::make('Status & Visibility')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Active')
                                            ->helperText('Enable or disable product visibility')
                                            ->required()
                                            ->default(true)
                                            ->onColor(Color::Green)
                                            ->offColor(Color::Red)
                                            ->inline(false)
                                            ->onIcon('heroicon-m-check')
                                            ->offIcon('heroicon-m-x-mark'),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Featured')
                                            ->helperText('Show on featured sections')
                                            ->default(false)
                                            ->onColor(Color::Amber)
                                            ->inline(false),

                                        Forms\Components\Toggle::make('is_new')
                                            ->label('New')
                                            ->helperText('Mark as new product')
                                            ->default(false)
                                            ->onColor(Color::Blue)
                                            ->inline(false),

                                        Forms\Components\Toggle::make('is_bestseller')
                                            ->label('Bestseller')
                                            ->helperText('Mark as bestseller product')
                                            ->default(false)
                                            ->onColor(Color::Pink)
                                            ->inline(false),
                                    ]),
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
                Tables\Columns\ImageColumn::make('image')
                    ->disk('public')
                    ->square()
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('brand')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('concentration')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Male' => 'info',
                        'Female' => 'danger',
                        'Unisex' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\SelectFilter::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Unisex' => 'Unisex',
                    ]),
                Tables\Filters\SelectFilter::make('concentration')
                    ->options([
                        'Perfume' => 'Perfume (Parfum)',
                        'EDP' => 'Eau de Parfum (EDP)',
                        'EDT' => 'Eau de Toilette (EDT)',
                        'EDC' => 'Eau de Cologne (EDC)',
                        'Body Spray' => 'Body Spray',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Featured Status'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('toggleActive')
                        ->label('Toggle Active Status')
                        ->icon('heroicon-o-eye')
                        ->action(fn(Collection $records) => $records->each->update(['is_active' => !$records->first()->is_active]))
                        ->requiresConfirmation(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
