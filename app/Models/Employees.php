<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Employees extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';
    protected $fillable = [
        'nik',
        'profile_picture',
        'employees_name',
        'position',
        'phone_number',
        'address'
    ];

    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($employee) {
            // Menghapus gambar dari storage jika ada saat soft delete
        });

        static::restoring(function ($employee) {
            // Tidak ada tindakan khusus saat mengembalikan data, bisa dihilangkan jika tidak perlu
        });

        static::forceDeleting(function ($employee) {
            // Menghapus gambar dari storage secara permanen jika ada saat hard delete
            if ($employee->profile_picture) {
                Storage::delete('public/employees/' . $employee->profile_picture);
            }
        });
    }
}
