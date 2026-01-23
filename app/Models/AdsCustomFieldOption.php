<?php

namespace App\Models;

use App\Models\AdsCustomField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdsCustomFieldOption extends Model
{
    public function field(): HasOne
    {
        return $this->hasOne(AdsCustomField::class, 'id', 'field_id');
    }
}
