<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class associate extends Model
{
    protected $table = 'associate';

    protected $guarded = ['id'];

    public function associateData() {
        return $this->hasOne(AssociateData::class, 'user_id', 'user_id');
    }

    public function associateDocs() {
        return $this->hasMany(AssociateDocs::class, 'user_id', 'user_id');
    }
}
