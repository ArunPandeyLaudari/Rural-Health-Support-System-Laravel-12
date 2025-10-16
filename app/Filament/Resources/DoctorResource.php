<?php

namespace App\Filament\Resources;

use Closure;
use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Doctor;
use App\Models\Hospital;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn\TextColumnSize;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()
                // ->live(onBlur:true)
                ->formatStateUsing(function ($state) {
                    return $state ? ucfirst($state) : ''; // Handle null value gracefully
                }),
                Select::make('hospital_id')
                ->options(Hospital::pluck('hospital_name','id'))
                ->label('Hospital Name')
                ->preload()
                ->searchable()
                ->required(),
                TextInput::make('phone')->required(),
                TextInput::make('speciality')->required(),
                TextInput::make('room')->required()->label('Room Number'),
                TextInput::make('experience')->required()->numeric()->label('Experience(In Year)'),
                Toggle::make('available')->label('Availablity')
                ->helperText('Enable or disable For availability')
                ->default(true)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->sortable(),
                TextColumn::make('speciality'),
                TextColumn::make('experience')
                ->toggleable(),
                TextColumn::make('room'),
                TextColumn::make('hospital.hospital_name')->label('Hospital Name'),
                TextColumn::make('phone'),
                IconColumn::make('available')->boolean()
            ])
            ->filters([
                TernaryFilter::make('available')
                    ->label('Available')
                    ->boolean()
                    ->trueLabel('Only Available Doctors')
                    ->falseLabel('Only Unavailable Doctors')
                    ->native(false),
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
            RelationManagers\AppointmentsRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }    
}
