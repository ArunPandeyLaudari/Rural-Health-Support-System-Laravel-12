<?php

namespace App\Filament\Resources\DoctorResource\RelationManagers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Hospital;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'appointment';

    public function form(Form $form): Form
    {
        $loggedUser=auth()->user();
        return $form
            ->schema([
            TextInput::make('name')->required()
            ->default($loggedUser->name)
            // ->disabled()
            ->label('Patient Name'),
            TextInput::make('age')->required()->numeric(),
            TextInput::make('phone')->required(),
            TextInput::make('address')->required(),
            Select::make('hospital_id')
                ->label('Hospital')
                ->options(Hospital::pluck('hospital_name','id'))
                ->searchable()
                ->required()
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('doctor_id',null)),
            Select::make('doctor_id')
                ->label('Doctor Name')
                ->options(function (callable $get){
                    $hospital = Hospital::find($get('hospital_id'));
                    if(!$hospital){
                        return Doctor::all()->where('available',1)->pluck('name','id');
                    }
                    return $hospital->doctor->where('available',1)->pluck('name','id');
                })
                ->preload()
                ->searchable()
                ->required(),
                DatePicker::make('date')
                ->native(false)
                ->minDate(now()),
                TimePicker::make('start_time')
                // ->native(false)
                ->seconds(false),
                // ->rule([new AppointmentOverlap(),]),
                TimePicker::make('end_time')
                // ->native(false)
                // ->displayFormat('h:i A')
                ->seconds(false)
                // ->rule([new Validate()]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('doctor_name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->label('Patient Name'),
                Tables\Columns\TextColumn::make('age'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('hospital.hospital_name')->label('Hospital Name'),
                Tables\Columns\TextColumn::make('doctor.name')->label('Doctor Name')->prefix('Dr. '),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('start_time'),
                Tables\Columns\TextColumn::make('end_time'),
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
