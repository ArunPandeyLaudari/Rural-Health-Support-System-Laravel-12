<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HospitalResource\Pages;
use App\Filament\Resources\HospitalResource\RelationManagers;
use App\Models\Hospital;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HospitalResource extends Resource
{
    protected static ?string $model = Hospital::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('hospital_name')->required()
            ->live(onBlur:true),
            Forms\Components\TextInput::make('phone')->required(),
            Forms\Components\TextInput::make('address')->required(),
            Forms\Components\DatePicker::make('since')->required(),
            Forms\Components\TextInput::make('bond_of')->required()->label('Bond Year'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hospital_name')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('since'),
                Tables\Columns\TextColumn::make('bond_of')->label('Bond Year'),
            ])
            ->filters([
                //
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
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
          RelationManagers\DoctorsRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHospitals::route('/'),
            'create' => Pages\CreateHospital::route('/create'),
            'edit' => Pages\EditHospital::route('/{record}/edit'),
            'list' => Pages\Hospital::route('/list'),
        ];
    }    
}
