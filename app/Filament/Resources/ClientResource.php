<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('firstName')
                    ->required(),
                Forms\Components\TextInput::make('lastName')
                    ->required(),
                Forms\Components\TextInput::make('phoneNumber')
                    ->tel()
                    ->required(),
                Forms\Components\TextInput::make('address')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\Select::make('wilaya')
                    ->options([
                        'Adrar' => 'Adrar',
                        'Chlef' => 'Chlef',
                        'Laghouat' => 'Laghouat',
                        'Oum El Bouaghi' => 'Oum El Bouaghi',
                        'Batna' => 'Batna',
                        'Béjaïa' => 'Béjaïa',
                        'Biskra' => 'Biskra',
                        'Béchar' => 'Béchar',
                        'Blida' => 'Blida',
                        'Bouira' => 'Bouira',
                        'Tamanrasset' => 'Tamanrasset',
                        'Tébessa' => 'Tébessa',
                        'Tlemcen' => 'Tlemcen',
                        'Tiaret' => 'Tiaret',
                        'Tizi Ouzou' => 'Tizi Ouzou',
                        'Algiers (Alger)' => 'Algiers (Alger)',
                        'Djelfa' => 'Djelfa',
                        'Jijel' => 'Jijel',
                        'Sétif' => 'Sétif',
                        'Saïda' => 'Saïda',
                        'Skikda' => 'Skikda',
                        'Sidi Bel Abbès' => 'Sidi Bel Abbès',
                        'Annaba' => 'Annaba',
                        'Guelma' => 'Guelma',
                        'Constantine' => 'Constantine',
                        'Médéa' => 'Médéa',
                        'Mostaganem' => 'Mostaganem',
                        'M\'Sila' => 'M\'Sila',
                        'Mascara' => 'Mascara',
                        'Ouargla' => 'Ouargla',
                        'Oran' => 'Oran',
                        'El Bayadh' => 'El Bayadh',
                        'Illizi' => 'Illizi',
                        'Bordj Bou Arréridj' => 'Bordj Bou Arréridj',
                        'Boumerdès' => 'Boumerdès',
                        'El Tarf' => 'El Tarf',
                        'Tindouf' => 'Tindouf',
                        'Tissemsilt' => 'Tissemsilt',
                        'El Oued' => 'El Oued',
                        'Khenchela' => 'Khenchela',
                        'Souk Ahras' => 'Souk Ahras',
                        'Tipaza' => 'Tipaza',
                        'Mila' => 'Mila',
                        'Aïn Defla' => 'Aïn Defla',
                        'Naâma' => 'Naâma',
                        'Aïn Témouchent' => 'Aïn Témouchent',
                        'Ghardaïa' => 'Ghardaïa',
                        'Relizane' => 'Relizane',
                        'El M\'Ghair' => 'El M\'Ghair',
                        'El Menia' => 'El Menia',
                        'Ouled Djellal' => 'Ouled Djellal',
                        'Bordj Baji Mokhtar' => 'Bordj Baji Mokhtar',
                        'Béni Abbès' => 'Béni Abbès',
                        'Timimoun' => 'Timimoun',
                        'Touggourt' => 'Touggourt',
                        'Djanet' => 'Djanet',
                        'In Salah' => 'In Salah',
                        'In Guezzam' => 'In Guezzam',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('firstName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phoneNumber')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('wilaya')
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
