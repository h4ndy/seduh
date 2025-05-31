<?php

namespace App\Filament\Resources\CongregationResource\Pages;

use App\Models\User;
use App\Models\Congregation;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CongregationResource;

class CreateCongregation extends CreateRecord
{
    protected static string $resource = CongregationResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        $validator = validator()->make($data, [
            'email' => ['required', 'email', 'unique:users,email'],
        ]);


        if ($validator->fails()) {
            return $this->notify(' danger', $validator->getMessageBag()->first());
        }

        $user = new User([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => '12345678',
            'status' => true,
        ]);
        $user->save();
        $data['user_id'] = $user->id;
        $congregation = new Congregation($data);
        $congregation->save();
        return $user;
    }


     protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
