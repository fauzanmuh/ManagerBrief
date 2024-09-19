<?php

namespace App\Filament\Resources\Manager\DeveloperResource\Pages;

use App\Filament\Resources\Manager\DeveloperResource;
use Auth;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDeveloper extends CreateRecord
{
    protected static string $resource = DeveloperResource::class;
    protected function beforeSave()
    {
        $this->record->user_id = Auth::id(); // Automatically sets user_id to the current logged-in user's ID
    }
}
