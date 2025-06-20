<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Pricing Management';
    protected static ?string $navigationLabel = 'Plans';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                Forms\Components\Select::make('billing_cycle')
                    ->options([
                        'monthly' => 'Monthly',
                        'yearly' => 'Yearly',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('article_limit')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                Forms\Components\Repeater::make('features')
                    ->label('Features')
                    ->schema([
                        Forms\Components\TextInput::make('feature')
                            ->label('Feature')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->required()
                    ->minItems(1)
                    ->columns(1)
                    ->default(fn ($record) => $record && is_array($record->features)
                        ? collect($record->features)->map(fn ($item) => ['feature' => $item])->toArray()
                        : []
                    )
                    ->dehydrateStateUsing(fn ($state) => collect($state)->pluck('feature')->all())
                    ->dehydrated(fn ($state) => $state !== null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('billing_cycle'),
                Tables\Columns\TextColumn::make('article_limit'),

                Tables\Columns\TextColumn::make('features')
                    ->label('Features')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', $state) : $state)
                    ->badge(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
