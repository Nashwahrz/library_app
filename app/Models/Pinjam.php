<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pinjam extends Model
{
    use HasFactory;

    protected $table = 'pinjams';

    protected $fillable = [
        'user_id',
        'book_id',
        'mulai_akses',
        'berakhir_pada',
        'status',
    ];

    protected $casts = [
        'mulai_akses'   => 'datetime',
        'berakhir_pada' => 'datetime',
    ];

    /* =========================
       RELATION
    ========================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /* =========================
       HELPER / LOGIC
    ========================= */

    // cek apakah masih aktif
    public function isActive()
    {
        return $this->status === 'aktif'
            && now()->lessThanOrEqualTo($this->berakhir_pada);
    }

    // cek apakah sudah berakhir
    public function isExpired()
    {
        return now()->greaterThan($this->berakhir_pada);
    }

    // update otomatis jika sudah lewat waktu
    public function updateStatusIfExpired()
    {
        if ($this->isExpired() && $this->status !== 'berakhir') {
            $this->update([
                'status' => 'berakhir'
            ]);
        }
    }

    // sisa waktu (untuk UI)
    public function sisaHari()
    {
        if ($this->isExpired()) {
            return 0;
        }

        return now()->diffInDays($this->berakhir_pada);
    }
}
