<?php
namespace App\Filament\Resources\CashBookResource\Pages;

use App\Filament\Resources\CashBookResource;
use App\Models\CashBook;
use App\Models\CashBookTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;

class TransferCash extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static string $resource = CashBookResource::class;

    protected static string $view = 'filament.resources.cash-book-resource.pages.transfer-cash';

    public $from_cash_book_id;
    public $to_cash_book_id;
    public $amount;
    public $description;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('from_cash_book_id')
                ->label('Dari Kas')
                ->options(CashBook::pluck('name', 'id'))
                ->required(),

            Forms\Components\Select::make('to_cash_book_id')
                ->label('Ke Kas')
                ->options(CashBook::pluck('name', 'id'))
                ->required(),

            Forms\Components\TextInput::make('amount')
                ->label('Jumlah Transfer')
                ->prefix('Rp')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('description')
                ->label('Keterangan')
                ->maxLength(255),
        ];
    }

    protected function getFormModel(): string
    {
        return self::class;
    }

    public function transfer(): void
    {
        $data = $this->form->getState();

        if ($data['from_cash_book_id'] === $data['to_cash_book_id']) {
            Notification::make()
                ->title('Kas asal dan tujuan tidak boleh sama.')
                ->danger()
                ->send();
            return;
        }

        DB::transaction(function () use ($data) {
            // Transfer Out
            CashBookTransaction::create([
                'cash_book_id' => $data['from_cash_book_id'],
                'type' => 'transfer_out',
                'amount' => $data['amount'],
                'description' => 'Transfer to #' . $data['to_cash_book_id'] . ': ' . $data['description'],
            ]);

            // Transfer In
            CashBookTransaction::create([
                'cash_book_id' => $data['to_cash_book_id'],
                'type' => 'transfer_in',
                'amount' => $data['amount'],
                'description' => 'Transfer from #' . $data['from_cash_book_id'] . ': ' . $data['description'],
            ]);
        });

        Notification::make()
            ->title('Transfer berhasil')
            ->success()
            ->send();

        $this->form->fill(); // Reset form
    }
}
