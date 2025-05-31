<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Congregation;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Section;
use Filament\Pages\SubNavigationPosition;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\CongregationResource\Pages;
use Teguh02\IndonesiaTerritoryForms\IndonesiaTerritoryForms;

class CongregationResource extends Resource
{
    protected static ?string $model = Congregation::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Manajemen Data';

    protected static ?string $navigationLabel = 'Jamaah';

    protected static ?string $pluralLabel = 'Jamaah';

    protected static ?string $label = 'Jamaah';

    protected static ?int $navigationSort = 2;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;




    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                Section::make('Data Diri')
                    ->description('Data Diri Jamaah')
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->columnSpan([
                                'md' => 12
                            ])
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->columnSpan([
                                'md' => 4
                            ])
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->label('Nomor Telepon')
                            ->columnSpan([
                                'md' => 4
                            ])
                            ->maxLength(255),

                        Forms\Components\Select::make('group_congregation_code')
                            ->columnSpan([
                                'md' => 4
                            ])->label('Kelompok Jamaah')
                            ->options(\App\Models\GroupCongregation::query()->pluck('name', 'code'))
                            ->searchable()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('code')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ])
                            ->createOptionAction(function (Action $action) {
                                return $action
                                    ->modalHeading('Buat Wilayah')
                                    ->modalSubmitActionLabel('Simpan')
                                    ->modalWidth('lg');
                            }),
                    ]),

                Section::make('Detail Alamat')
                    ->columns([
                        'md' => 10,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('address')
                            ->label('Alamat')
                            ->required()
                            ->columnSpan([
                                'md' => 8
                            ])
                            ->maxLength(255),
                        Forms\Components\TextInput::make('rt')
                            ->required()
                            ->columnSpan([
                                'md' => 1
                            ])
                            ->maxLength(3),
                        Forms\Components\TextInput::make('rw')
                            ->required()
                            ->columnSpan([
                                'md' => 1
                            ])
                            ->maxLength(3),
                        IndonesiaTerritoryForms::make(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),

            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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

    // public static function getRecordSubNavigation(Page $page): array
    // {
    //     return $page->generateNavigationItems([
    //         Pages\EditCongregation::class,
    //     ]);
    // }
}
