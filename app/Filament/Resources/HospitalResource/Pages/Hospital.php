<?php

namespace App\Filament\Resources\HospitalResource\Pages;

use App\Filament\Resources\HospitalResource;
use Filament\Resources\Pages\Page;

class Hospital extends Page
{
    protected static string $resource = HospitalResource::class;

    protected static string $view = 'filament.resources.hospital-resource.pages.hospital';

    public $table='Hello Abhijiit';
}
