<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCampaign extends Model
{
    use HasFactory;

    protected $table = 'categorycampaign';
    protected $primaryKey = 'CategoryCampaignID'; 

    protected $fillable = ['NamaKategoriCampaign'];

    // Satu kategori bisa punya banyak campaign
    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'CategoryID', 'CategoryCampaignID');
    }
}