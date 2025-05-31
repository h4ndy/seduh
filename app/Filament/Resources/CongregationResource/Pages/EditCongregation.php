<?php

namespace App\Filament\Resources\CongregationResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CongregationResource;

class EditCongregation extends EditRecord
{
    protected static string $resource = CongregationResource::class;



    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($record->user_id)
            ],
        ]);

        if ($validator->fails()) {
            // Mengirim notifikasi error ke UI Filament
            Notification::make()
                ->title('Validation Error')
                ->danger()
                ->body($validator->errors()->first())
                ->send();

            // Melemparkan exception untuk menghentikan proses
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        $user = User::where('id', $record['user_id'])->first();
        $user->phone = $data['phone'];
        $user->email = $data['email'];
        $user->save();
        return parent::handleRecordUpdate($record, $data);
    }


    protected function getHeaderActions(): array
    {
        return [
            //Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
