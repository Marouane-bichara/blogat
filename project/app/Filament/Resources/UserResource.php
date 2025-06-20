<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'User Management';
    protected static ?string $navigationLabel = 'Users';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                    ->hiddenOn('edit'),

                Select::make('role_id')
                    ->relationship('role', 'name')
                    ->required(),

                Select::make('provider')
                    ->options([
                        'local' => 'Local',
                        'google' => 'Google',
                    ])
                    ->required(),

                TextInput::make('article_quota_remaining')
                    ->numeric()
                    ->required(),

                DateTimePicker::make('subscription_expires_at')
                    ->label('Subscription Expires At')
                    ->nullable(),

                Select::make('plan_id')
                    ->relationship('plan', 'name')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),

                BadgeColumn::make('role.name')
                    ->label('Role')
                    ->colors([
                        'success' => fn ($state) => $state === 'admin',
                        'info' => fn ($state) => $state === 'user',
                    ]),

                BadgeColumn::make('provider')
                    ->colors([
                        'primary' => 'local',
                        'success' => 'google',
                    ]),

                TextColumn::make('article_quota_remaining')
                    ->label('Quota Remaining'),

                TextColumn::make('subscription_expires_at')
                    ->label('Subscription Expiry')
                    ->dateTime(),

                TextColumn::make('plan.name')
                    ->label('Plan')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role_id')
                    ->relationship('role', 'name')
                    ->label('Role'),

                Tables\Filters\SelectFilter::make('provider')
                    ->options([
                        'local' => 'Local',
                        'google' => 'Google',
                    ])
                    ->label('Provider'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
