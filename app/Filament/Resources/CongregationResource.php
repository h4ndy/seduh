<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Congregation;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CongregationResource\Pages;
use Teguh02\IndonesiaTerritoryForms\IndonesiaTerritoryForms;
use App\Filament\Resources\CongregationResource\RelationManagers;

class CongregationResource extends Resource
{
    protected static ?string $model = Congregation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                IndonesiaTerritoryForms::make(),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListCongregations::route('/'),
            'create' => Pages\CreateCongregation::route('/create'),
            'edit' => Pages\EditCongregation::route('/{record}/edit'),
        ];
    }
}
