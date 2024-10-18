<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'pengirim',
        'judul',
        'isi',
        'tanggal',
        'sebut'
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'pengirim');
    }
}
