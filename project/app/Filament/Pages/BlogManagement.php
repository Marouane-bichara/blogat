<?php

namespace App\Filament\Pages;

use App\Models\Article;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;

class BlogManagement extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Blog Management';
    protected static string $view = 'filament.pages.blog-management';

    protected function getTableQuery()
    {
        return Article::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'published' => 'success',
                    'draft' => 'warning',
                    'exported' => 'danger',
                    default => 'gray',
                }),
            Tables\Columns\TextColumn::make('created_at')->date(),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'published' => 'Active',
                    'draft' => 'Draft',
                    'exported' => 'Exported',
                ])
                ->label('Status')
                ->default('published'),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('publish')
                ->label('Publish')
                ->icon('heroicon-o-check')
                ->requiresConfirmation()
                ->action(fn (Article $record) => $record->update(['status' => 'published']))
                ->visible(fn (Article $record) => $record->status !== 'published'),

            Tables\Actions\Action::make('unpublish')
                ->label('Unpublish')
                ->icon('heroicon-o-x-mark')
                ->requiresConfirmation()
                ->action(fn (Article $record) => $record->update(['status' => 'draft']))
                ->visible(fn (Article $record) => $record->status === 'published'),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            Tables\Actions\BulkAction::make('bulkPublish')
                ->label('Publish Selected')
                ->action(fn ($records) => $records->each->update(['status' => 'published']))
                ->requiresConfirmation(),

            Tables\Actions\BulkAction::make('bulkUnpublish')
                ->label('Unpublish Selected')
                ->action(fn ($records) => $records->each->update(['status' => 'draft']))
                ->requiresConfirmation(),
        ];
    }
}
