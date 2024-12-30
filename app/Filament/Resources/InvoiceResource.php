<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers\InvoiceItemsRelationManager;
use App\Models\Invoice;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $slug = 'invoices';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';





    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Select::make('client_id')
                    ->relationship('client', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('due_date'),


                RichEditor::make('additional_notes')
                    ->required(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
//                        'sent' => 'Sent',
                        'paid' => 'Paid',
                    ])
                    ->default('draft')
                    ->required(),



                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Invoice $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Invoice $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number'),

                TextColumn::make('client.name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('items_sum_price')->sum('items', 'price')->label('Total'),

                TextColumn::make('sent_at')->dateTime(),
                TextColumn::make('paid_at')->dateTime(),



                TextColumn::make('due_date')
                    ->date(),

                SelectColumn::make('status')->options(
                    [
                        'paid' => 'Paid',
                        'confirmed' => 'Confirmed',
                    ]
                )->selectablePlaceholder(false)    ->afterStateUpdated(function ($record, $state) {
                 if($state === 'confirmed'){
                    Mail::to($record->client->email)->send(new \App\Mail\ReceiptMail($record->client->name, route('invoice', $record->id)));
                 }
                })->disabled(fn($record) => $record->status !== 'paid'),


//                TextColumn::make('additional_notes')->html(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'paid' => 'Paid',
                        'confirmed' => 'Confirmed',
                    ])
            ], layout: FiltersLayout::AboveContent)
            ->actions([
                Action::make('Send Invoice')->action(function (Invoice $record){
                    if ($record->items()->count() < 1){
                     Notification::make()
                     ->title('You cannot send an invoice without any items')->danger()->send()
                     ;

                     return;
                    }

                    $client = $record->client;
                    $record->update(['sent_at' => now(), 'status' => 'sent']);
                    Mail::to(
                        $client->email,
                    )->send(new \App\Mail\InvoiceMail($client->name, route('invoice', $record->id)));
                })->button()
                ->visible(fn(Invoice $record) => $record->status === 'draft'),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['client']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['client.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->client) {
            $details['Client'] = $record->client->name;
        }

        return $details;
    }

    public static function getRelations(): array
    {
        return [InvoiceItemsRelationManager::class];
    }


}
