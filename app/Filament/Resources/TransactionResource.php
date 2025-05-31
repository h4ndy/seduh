<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\TransactionResource\Pages;


class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
         return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        Select::make('cash_book_id')
                            ->label('Cash Book')
                            ->relationship('cashBook', 'name')
                            ->required(),

                        Select::make('type')
                            ->label('Transaction Type')
                            ->options([
                                'income' => 'Income',
                                'expense' => 'Expense',
                                'transfer' => 'Transfer',
                            ])
                            ->reactive()
                            ->required(),

                        Select::make('fund_id')
                            ->label('Akun Pos')
                            ->relationship('fund', 'name')
                            ->searchable()
                            ->columnSpanFull(),

                        TextInput::make('amount')
                            ->numeric()
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),

                        DatePicker::make('date')
                            ->required()
                            ->default(now())
                            ->columnSpanFull(),

                        // Pos tujuan untuk transfer
                        Select::make('transfer_to_fund_id')
                            ->label('Transfer To')
                            ->relationship('fund', 'name')
                            ->visible(fn (callable $get) => $get('type') === 'transfer')
                            ->required(fn (callable $get) => $get('type') === 'transfer')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')->date(),
                //Tables\Columns\TextColumn::make('cashBook.name')->label('Cash Book'),
                Tables\Columns\TextColumn::make('type')->label('Type')->badge(),
                Tables\Columns\TextColumn::make('amount')->money('IDR', true)
                    ->summarize(Tables\Columns\Summarizers\Sum::make()),
                Tables\Columns\TextColumn::make('description'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'income' => 'Income',
                        'expense' => 'Expense',
                        'transfer_out' => 'Transfer Out',
                        'transfer_in' => 'Transfer In',
                    ]),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
