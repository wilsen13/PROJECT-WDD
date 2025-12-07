<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaign'; // Sesuaikan nama tabel
    protected $primaryKey = 'CampaignID'; // Custom Primary Key
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'CategoryID', 'Judul', 'Deskripsi', 
        'ImageURL', 'TargetDana', 'DanaTerkumpul'
    ];

    // Relasi ke User (Admin/Pembuat)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(CategoryCampaign::class, 'CategoryID', 'CategoryCampaignID');
    }
}