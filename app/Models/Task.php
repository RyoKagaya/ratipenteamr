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
            'is_bpo_task',      // ✅ BPOタスクかどうか
            'required_credits', // ✅ BPOに必要なクレジット
            'assignee_id',      // ✅ BPOタスクの担当者
        ];

        protected $casts = [
            'deadline' => 'datetime',
            'completed_at' => 'datetime',
            'is_deleted' => 'boolean',
            'is_displayed_on_main' => 'boolean',
            'is_bpo_task' => 'boolean',
        ];

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function assignee()
        {
            return $this->belongsTo(User::class, 'assignee_id');
        }

        
    }
