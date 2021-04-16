<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['recipients', 'subject', 'body'];

    /**
     * Get all of the posts that are assigned this tag.
     */
    public function students()
    {
        return $this->morphedByMany(Student::class, 'recipient', 'message_recipients')->withTimestamps();
    }

    /**
     * Get all of the videos that are assigned this tag.
     */
    public function teachers()
    {
        return $this->morphedByMany(Teacher::class, 'recipient', 'message_recipients')->withTimestamps();
    }

    public function getRecipientCountAttribute()
    {
        return $this->students()->count() + $this->teachers->count();
    }
}
