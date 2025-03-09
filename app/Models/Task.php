<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'comment',
        'deadline',
        'status',
        'is_displayed_on_main',
        'completed_at',
        'is_deleted',
    ];
    protected $casts = [
        'deadline' => 'datetime',
        'completed_at' => 'datetime',
        'is_displayed_on_main' => 'boolean',
        'is_deleted' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
