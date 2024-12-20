<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AccountDetails extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        if(!file_exists('account-details.txt')) {
            $file = fopen('account-details.txt', 'w');
            fwrite($file, '');
            fclose($file);
        }
        $accountDetails = file_get_contents('account-details.txt');

        $this->form->fill([
            'details' => $accountDetails,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('details'),
                // ...
            ])
            ->statePath('data');
    }

    public function create(): void
    {
        $data = $this->form->getState();
//        save the account details to file
        $file = fopen('account-details.txt', 'w');
        fwrite($file, $data['details']);
        fclose($file);

        Notification::make()->title('Account Details Saved')->success()->send();
    }

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.account-details';
}
