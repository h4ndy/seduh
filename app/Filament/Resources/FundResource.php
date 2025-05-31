<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Fund;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FundResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FundResource\RelationManagers;

class FundResource extends Resource
{
    protected static ?string $model = Fund::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Akun Pos/Program';

    protected static ?string $pluralLabel = 'Akun Pos/Program';

    protected static ?string $label = 'Akun Pos/Program';

    protected static ?string $navigationGroup = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255),
                    Forms\Components\TextInput::make('begining_balance')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('begining_balance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ending_balance')
                    ->numeric()
                    ->sortable(),

            ])
            ->filters([
                //
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
            'index' => Pages\ListFunds::route('/'),
            'create' => Pages\CreateFund::route('/create'),
            'edit' => Pages\EditFund::route('/{record}/edit'),
        ];
    }
}
