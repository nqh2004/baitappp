<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_name', 'class_id', 'status'];

    protected static function booted()
    {
        static::addGlobalScope('orderByName', function ($query) {
            $query->orderBy('student_name', 'asc');
        });
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class)
            ->withPivot(['score', 'registered_at']);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}