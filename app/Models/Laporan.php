<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['dibuat'];

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'laporan_barang')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function getDibuatAttribute()
    {
        return Carbon::parse($this->created_at)
            ->locale('id')
            ->isoFormat('dddd, D MMMM YYYY HH:mm') . ' WIB';
    }
}
