<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommandeResource\Pages;
use App\Filament\Resources\CommandeResource\RelationManagers;
use App\Models\Commande;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommandeResource extends Resource
{
    protected static ?string $model = Commande::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('commandNumber')
                    ->default('CMD-' . date('Ymd') . '-' . rand(100, 999))
                    ->required(),
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'firstName')
                    ->required(),
                Forms\Components\Select::make('car_model_id')
                    ->relationship('carModel', 'model')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'purchased' => 'Purchased',
                        'in_shipping' => 'In Shipping',
                        'arrived' => 'Arrived',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('totalPrice')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('deposit')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('remainingAmount')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('paymentStatus')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'partial' => 'Partial',
                        'paid' => 'Paid',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('comments')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('container_id')
                    ->numeric(),
                Forms\Components\DateTimePicker::make('deliveredAt'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('commandNumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('car_model_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('totalPrice')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deposit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('remainingAmount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('paymentStatus')
                    ->searchable(),
                Tables\Columns\TextColumn::make('container_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deliveredAt')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListCommandes::route('/'),
            'create' => Pages\CreateCommande::route('/create'),
            'edit' => Pages\EditCommande::route('/{record}/edit'),
        ];
    }
}
