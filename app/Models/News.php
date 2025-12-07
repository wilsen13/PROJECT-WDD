<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    

    protected $table = 'news';
    protected $primaryKey = 'newsID';
    const UPDATED_AT = null;


    protected $fillable = [
        'user_id',    
        'Judul',      
        'Deskripsi',  
        'VideoURL',   
    ];

    // Relasi ke User yang mengupdate berita (admin)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}