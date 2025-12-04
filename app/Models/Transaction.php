<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    // Primary Key tabel kamu
    protected $primaryKey = 'TransactionID';
    const CREATED_AT = 'TanggalTransaksi';
    const UPDATED_AT = null;

    protected $fillable = [
        'CampaignID',        
        'user_id',           
        'Jumlah',            
        'MetodePembayaran',  
        'StatusPembayaran',  
        'NamaDonatur',       
        'EmailDonatur',      
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'CampaignID', 'CampaignID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}