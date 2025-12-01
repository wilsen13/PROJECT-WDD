<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    
    protected $table = 'news';
    protected $primaryKey = 'newsID';

    protected $fillable = [
        'user_id', 'Judul', 'Deskripsi', 'VideoURL', 'TanggalPublikasi'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
