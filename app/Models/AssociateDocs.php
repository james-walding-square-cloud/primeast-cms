<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssociateDocs extends Model
{
    protected $table = 'associate_docs';

    protected $guarded = ['id'];

    public function associateDocs() {
        return $this->hasOne(Associate::class, 'user_id', 'user_id');
    }
}
