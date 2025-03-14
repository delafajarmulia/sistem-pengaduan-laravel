<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Complaint extends Model
{
    use HasFactory;
    protected $table = 'complaints';
    protected $primayKey = 'id';
    protected $fillable = [
        'category_id', 
        'user_id',
        'spot_id', 
        'content', 
        'image',
        'status',
        'date_of_complaint'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
