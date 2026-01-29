<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // kolom yang boleh diisi mass assignment
    protected $fillable = [
        'book_name',
        'category',
        'penulis',
        'sinopsis',
        'cover',
        'tahun_terbit',
        'writer_id',
    ];

    // relasi ke tabel pinjams

        public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id');
    }
    public function pinjams()
    {
        return $this->hasMany(Pinjam::class);
    }
    public function chapters()
{
    return $this->hasMany(Chapter::class)
                ->orderBy('chapter_order');
}

}
