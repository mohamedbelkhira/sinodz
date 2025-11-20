<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarModelResource\Pages;
use App\Filament\Resources\CarModelResource\RelationManagers;
use App\Models\CarModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;

class CarModelResource extends Resource
{
    protected static ?string $model = CarModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Car Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->description('Core details about the vehicle')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('brand_id')
                                    ->label('Brand')
                                    ->relationship('brand', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\TextInput::make('model')
                                    ->required()
                                    ->maxLength(255),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('year')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue(date('Y') + 1),
                                Forms\Components\TextInput::make('color')
                                    ->required()
                                    ->maxLength(255),

                            ]),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Section::make('Technical Specifications')
                    ->description('Engine and performance details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\Select::make('transmission')
                                    ->options([
                                        'automatic' => 'Automatic',
                                        'manual' => 'Manual',
                                    ])
                                    ->required(),
                                Forms\Components\Select::make('fuelType')
                                    ->label('Fuel Type')
                                    ->options([
                                        'gasoline' => 'Gasoline',
                                        'diesel' => 'Diesel',
                                        'electric' => 'Electric',
                                        'hybrid' => 'Hybrid',
                                    ])
                                    ->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('engine')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g., 2.0L Turbo'),
                                Forms\Components\TextInput::make('mileage')
                                    ->required()
                                    ->numeric()
                                    ->suffix('km')
                                    ->minValue(0),
                            ]),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Section::make('Pricing & Availability')
                    ->description('Price and current status')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$')
                                    ->minValue(0),
                                Forms\Components\TextInput::make('delivery_price')
                                    ->required()
                                    ->numeric()
                                    ->prefix('$')
                                    ->minValue(0),
                                Forms\Components\Select::make('location')
                                    ->options([
                                        'algeria' => 'Algeria',
                                        'china' => 'China',
                                    ])
                                    ->required(),
                                Forms\Components\Toggle::make('isAvailable')
                                    ->label('Available for Sale')
                                    ->required()
                                    ->default(true)
                                    ->inline(false),
                            ]),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Section::make('Features')
                    ->description('Select all applicable features')
                    ->schema([
                        Forms\Components\Select::make('features')
                            ->multiple()
                            ->relationship('features', 'name')
                            ->preload()
                            ->searchable(),
                    ])
                    ->collapsible(),

                Section::make('Images')
                    ->description('Upload and organize vehicle photos (drag to reorder)')
                    ->schema([
                        Repeater::make('images')
                            ->relationship('images')
                            ->schema([
                                FileUpload::make('image')
                                    ->image()
                                    ->directory('car_models')
                                    ->imageEditor()
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('order')
                                    ->numeric()
                                    ->required()
                                    ->default(0)
                                    ->hidden(),
                            ])
                            ->reorderable()
                            ->orderColumn('order')
                            ->defaultItems(0)
                            ->addActionLabel('Add Image')
                            ->columns(1),
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images.image')
                    ->stacked()
                    ->limit(3)
                    ->limitedRemainingText(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('model')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('color')
                    ->searchable(),
                Tables\Columns\TextColumn::make('transmission')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fuelType')
                    ->searchable(),
                Tables\Columns\TextColumn::make('engine')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mileage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\IconColumn::make('isAvailable')
                    ->boolean(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCarModels::route('/'),
            'create' => Pages\CreateCarModel::route('/create'),
            'edit' => Pages\EditCarModel::route('/{record}/edit'),
        ];
    }
}