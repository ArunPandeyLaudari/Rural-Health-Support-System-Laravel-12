<?php

namespace App\Filament\Resources\HospitalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorsRelationManager extends RelationManager
{
    protected static string $relationship = 'doctor';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()
                ->live(onBlur:true),
                Select::make('hospitals_id')
                ->relationship(name:'hospitals',titleAttribute: 'hospital_name')
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('doctor_id')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('speciality')
                ,
                Tables\Columns\TextColumn::make('experience')
                ->toggleable(),
                Tables\Columns\TextColumn::make('room'),
                Tables\Columns\TextColumn::make('hospital.hospital_name')->label('Hospital Name'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\IconColumn::make('available')->boolean()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
