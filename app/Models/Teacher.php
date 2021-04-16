<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function messages()
    {
        return $this->morphToMany(Message::class, 'recipient', 'message_recipients');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($teacher) {
            $teacher->messages()->detach();
        });
    }
}
