<?php

namespace App\Filament\Resources;

use App\Enums\AppointmentStatus;
use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Http\Controllers\AppointmentController;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\User;
use App\Rules\AppointmentOverlap;
use Faker\Guesser\Name;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Http\Controllers\RedirectToHomeController;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Filament\Tables\Columns;
use Spatie\Color\Validate;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
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
            ->closeOnDateSelection()
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
    // Doctor::where('available',1)->pluck('name','id')
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('users_counts')->counts('doctor'),
                TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->label('Patient Name'),
                TextColumn::make('age'),
                TextColumn::make('phone'),
                TextColumn::make('address'),
                TextColumn::make('hospital.hospital_name')->label('Hospital Name'),
                TextColumn::make('doctor.name')->label('Doctor Name')->prefix('Dr. '),
                TextColumn::make('date'),
                TextColumn::make('start_time'),
                TextColumn::make('end_time'),
                // TextColumn::make('status')
                //     ->badge()
                //     ->sortable()
            ])
            ->filters([
                
            ])
            ->actions([
                // Tables\Actions\Action::make('Confirm')
                //     ->action(function (Appointment $record) {
                //         $record->status = AppointmentStatus::Confirmed;
                //         $record->save();
                //     })
                //     ->visible(fn (Appointment $record) => $record->status != AppointmentStatus::Confirmed)
                //     ->color('success')
                //     ->icon('heroicon-o-check'),
                // Tables\Actions\Action::make('Cancel')
                //     ->action(function (Appointment $record) {
                //         $record->status = AppointmentStatus::Canceled;
                //         $record->save();
                //     })
                //     ->visible(fn (Appointment $record) => $record->status != AppointmentStatus::Canceled)
                //     ->color('danger')
                //     ->icon('heroicon-o-x-mark'),
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
           //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }    

}
