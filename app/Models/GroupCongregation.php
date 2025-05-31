<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCongregation extends Model
{
    protected $guarded = ['id'];

    public function congregations()
    {
        return $this->hasMany(Congregation::class, 'group_congregation_code', 'code');
    }
}
