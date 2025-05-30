<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Tabs;
use App\Enums\CountryEnum;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
public static function form(Form $form): Form
{
    return $form->schema([
        Tabs::make('Kunde')
            ->tabs([
                Tabs\Tab::make('Stammdaten')
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('slug')->required()->unique(ignoreRecord: true),
                        TextInput::make('email')->email(),

                        Select::make('status')
                            ->options([
                                'active' => 'Aktiv',
                                'trial' => 'Testphase',
                                'suspended' => 'Gesperrt',
                                'canceled' => 'Gekündigt',
                                'archived' => 'Archiviert',
                                'pending' => 'Ausstehend',
                                'expired' => 'Abgelaufen',
                                'inactive' => 'Inaktiv',
                                ])
                            ->default('pending'),

                        Toggle::make('newsletter_opt_in')
                            ->label('Newsletter?'),

                        TextInput::make('ext_id')->label('Externe ID'),
                        TextInput::make('monkeyoffice_id')->label('Monkey Office ID'),
                    ]),
            Tabs\Tab::make('Adresse')
            ->schema([
                TextInput::make('address.company_name')
                    ->label('Firma'),
                TextInput::make('address.contact_name')
                    ->label('Ansprechpartner'),
                TextInput::make('address.street')
                    ->label('Straße')->required(),
                TextInput::make('address.postbox')
                    ->label('Postfach'),
                Grid::make(2)
                    ->schema([
                        TextInput::make('address.street_number')
                            ->label('Hausnummer'),
                        TextInput::make('address.additional_address')
                            ->label('Zusatzadresse'),
                    ]),
                Select::make('address.country')
                    ->label('Land')
                    ->options(CountryEnum::EU_COUNTRIES) // Enum mit EU-Ländern
                    ->required()
                    ->default('DE'),
                TextInput::make('address.vat_id')
                    ->label('USt-IdNr.')
                    ->helperText('Format z. B. DE123456789 – keine Prüfung auf Gültigkeit'),
                TextInput::make('address.invoice_email')
                    ->label('Rechnungs-Mail')
                    ->email(),
                ]),
                Tabs\Tab::make('Zahlungsarten')
    ->schema([
        Repeater::make('paymentMethods')
            ->label('Zahlungsmethoden')
            ->relationship() // falls du es relational machst
            ->schema([
                Section::make('Zahlungsmethode')
                    ->schema([
                        Select::make('method')
                            ->label('Zahlungsart')
                            ->options([
                                'paypal' => 'PayPal',
                                'vorkasse' => 'Vorkasse',
                                'stripe' => 'Stripe',
                                'sofort' => 'Sofortüberweisung',
                            ])
                            ->required(),

                        TextInput::make('data.email')
                            ->label('PayPal-Adresse')
                            ->email()
                            ->visible(fn ($get) => $get('method') === 'paypal'),

                        TextInput::make('data.stripe_customer_id')
                            ->label('Stripe Customer ID')
                            ->visible(fn ($get) => $get('method') === 'stripe'),

                        Toggle::make('default')
                            ->label('Standardmethode'),
                    ])
                    ->collapsible() // ← Das macht den Akkordeon-Effekt
                    ->collapsed(),   // ← Startet eingeklappt
            ])
            ->defaultItems(1)
            ->addActionLabel('Zahlungsmethode hinzufügen')
            ->columns(1), // Akkordeons sind eh full width
    ]),

                Tabs\Tab::make('Rechtliches')
                    ->schema([
                        TextInput::make('agb_version')->label('AGB-Version'),
                        Textarea::make('agb_text')->label('AGB-Text')->rows(4),
                        DateTimePicker::make('agb_accepted_at')->label('Zustimmung zu AGB'),

                        TextInput::make('privacy_version')->label('Datenschutz-Version'),
                        Textarea::make('privacy_text')->label('Datenschutzhinweis')->rows(4),
                        DateTimePicker::make('privacy_accepted_at')->label('Zustimmung zu Datenschutz'),
                    ]),
            ])
    ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('status')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'active' => 'primary',
                    'trial' => 'success',
                    'pending' => 'warning',
                    'inactive' => 'gray',
                    'suspended', 'deleted', 'expired' => 'danger',
                    'canceled', 'archived' => 'info',
                    default => 'gray',
                })
                ->tooltip(fn ($state) => match ($state) {
                    'active' => 'Aktiv',
                    'trial' => 'Testphase',
                    'pending' => 'Ausstehend',
                    'inactive' => 'Inaktiv',
                    'suspended' => 'Gesperrt',
                    'expired' => 'Abgelaufen',
                    'canceled' => 'Gekündigt',
                    'archived' => 'Archiviert',
                    'deleted' => 'Gelöscht',
                    default => ucfirst($state),
                })
                ->formatStateUsing(fn ($state) => ucfirst($state)),


            TextColumn::make('name')->searchable()->sortable(),
            TextColumn::make('slug')->searchable()->sortable(),
            TextColumn::make('email')->limit(25),
            TextColumn::make('agb_version')->label('AGB'),
            TextColumn::make('privacy_version')->label('DSGVO'),
            TextColumn::make('created_at')->label('erstellt')->dateTime('d.m.Y'),
            TextColumn::make('deletion_state')
                ->label('Löschung')
                ->badge()
                ->color(fn ($state) => match ($state) {
                    'none' => 'gray',
                    'requested' => 'warning',
                    'soft' => 'danger',
                    default => 'gray',
                })
                ->icon(fn ($state) => match ($state) {
                    'none' => 'heroicon-o-check-circle',
                    'requested' => 'heroicon-o-exclamation-circle',
                    'soft' => 'heroicon-o-trash',
                    default => null,
                })
                ->formatStateUsing(fn ($state) => match ($state) {
                    'none' => 'Keine Löschung',
                    'requested' => 'Löschung angefragt',
                    'soft' => 'Gelöscht (Soft)',
                    default => ucfirst($state),
                })
                ->tooltip(fn ($state) => match ($state) {
                    'none' => 'Kunde ist aktiv',
                    'requested' => 'Kunde hat eine Löschung angefragt',
                    'soft' => 'Kunde wurde als gelöscht markiert',
                    default => '',
                }),
        ])

        ->actions([
            ViewAction::make(),
            EditAction::make(),
            // Delete später ggf. ersetzen mit SoftDeleteButton
            DeleteAction::make(),
        ])
        ->defaultSort('created_at', 'desc');
}
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug', 'email', 'ext_id', 'monkeyoffice_id'];
    }
    public static function getGlobalSearchResultTitle(Model $record): string
{
    return $record->name;
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
