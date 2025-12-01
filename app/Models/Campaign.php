<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaign'; 
    protected $primaryKey = 'CampaignID'; 

    protected $fillable = [
        'user_id', 'CategoryID', 'Judul', 'Deskripsi', 
        'ImageURL', 'TargetDana', 'DanaTerkumpul'
    ];

    
    public function user() {
        return $this->belongsTo(User::class);
    }


    public function transactions() {
        return $this->hasMany(Transaction::class, 'CampaignID');
    }
}
