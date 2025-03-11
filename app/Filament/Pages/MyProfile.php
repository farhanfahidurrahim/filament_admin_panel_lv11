<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MyProfile extends Page
{
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.my-profile';
}
