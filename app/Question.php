<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const UPDATED_AT = null;

    protected $primaryKey = 'uuid';
    protected $keyType = 'string';

    protected $fillable = ['user_id', 'data'];
    protected $casts = [
        'uuid' => 'string',
        'user_id' => 'integer',
        'data' => 'array',
        'title' => 'string'
    ];

    public function labels() {
        return $this->hasMany(Label::class, 'question_uuid', 'uuid');
    }
}
