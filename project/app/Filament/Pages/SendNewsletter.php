<?php

namespace App\Filament\Pages;

use App\Mail\NewsletterMail;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Forms;
use Illuminate\Support\Facades\Mail;

class SendNewsletter extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationGroup = 'Communication';
    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static string $view = 'filament.pages.send-newsletter';
    protected static ?string $title = 'Send Newsletter';

    public ?string $newsletterContent = null;

    public function mount(): void
    {
        $this->form->fill([
            'newsletterContent' => '',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Textarea::make('newsletterContent')
                ->label('Newsletter Content')
                ->rows(10)
                ->required(),
        ];
    }

    public function send(): void
    {
        $data = $this->form->getState();

        $users = User::all(); // Or filter only subscribed users

        foreach ($users as $user) {
            Mail::to($user->email)->send(new NewsletterMail($data['newsletterContent']));
        }

        session()->flash('success', '✅ Newsletter sent to all users.');
    }
}
