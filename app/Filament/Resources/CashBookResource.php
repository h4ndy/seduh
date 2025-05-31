<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\CashBook;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Filament\Resources\CashBookResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CashBookResource\RelationManagers;
use App\Filament\Resources\CashBookResource\Pages\TransferCash;

class CashBookResource extends Resource
{
    protected static ?string $model = CashBook::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-currency-dollar';

    protected static ?string $navigationLabel = 'Akun Kas/Bank';

    protected static ?string $pluralLabel = 'Akun Kas/Bank';

    protected static ?string $label = 'Akun Kas/Bank';

    protected static ?string $navigationGroup = 'Keuangan';



    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label('Keterangan')
                    ->maxLength(255),
                Forms\Components\TextInput::make('begining_balance')
                    ->label('Saldo Awal')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0.00),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('begining_balance')
                    ->label('Saldo Awal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ending_balance')
                    ->label('Saldo Akhir')
                    ->numeric()
                    ->summarize(Sum::make()->label('Total'))
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('transfer')
                    ->label('Transfer Kas')
                     ->url(fn () => TransferCash::getUrl())
                    ->icon('heroicon-o-arrow-right-circle'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCashBooks::route('/'),
            'create' => Pages\CreateCashBook::route('/create'),
            'edit' => Pages\EditCashBook::route('/{record}/edit'),
            'transfer' => Pages\TransferCash::route('/transfer'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
