<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Advertisement extends Model
{
    use HasFactory;
    protected $table = 'advertisements';
    protected $primaryKey = 'AdID';
    protected $fillable = [
        'AdID',
        'UserID',
        'CategoryID',
        'Title',
        'Description',
        'AdPhoto',
        'Status',
    ];
    public function Users()
    {
        return $this->belongsTo(User::class, 'UserID');
    }
    public function Category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }


}
