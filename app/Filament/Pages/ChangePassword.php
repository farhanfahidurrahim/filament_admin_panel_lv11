<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form; // Correct import
use Filament\Forms\Components\Password;  // Correct import
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Page
{
    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.change-password';

    public function form(Form $form): Form
    {
        return $form->schema([
            Password::make('current_password')
                ->label('Current Password')
                ->required(),

            Password::make('new_password')
                ->label('New Password')
                ->required(),

            Password::make('new_password_confirmation')
                ->label('Confirm New Password')
                ->required()
                ->same('new_password'), // Ensures password confirmation matches
        ]);
    }

    public function save(): void
    {
        $validated = $this->form->getState();

        // Manually validate the current password
        if (!Hash::check($validated['current_password'], Auth::user()->password)) {
            $this->form->addError('current_password', 'Current password is incorrect.');
            return;
        }

        // Validate new password confirmation
        if ($validated['new_password'] !== $validated['new_password_confirmation']) {
            $this->form->addError('new_password_confirmation', 'Passwords do not match.');
            return;
        }

        // Update password
        $user = Auth::user();
        $user->password = Hash::make($validated['new_password']);
        $user->save();

        // Return success message
        session()->flash('success', 'Password changed successfully!');
    }
}
