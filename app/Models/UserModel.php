<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';
    public $timestamps = false; 
    
    protected $dates = ['deleted_at'];

    //jobsheet 4
    protected $fillable = ['level_id', 'username', 'nama', 'password'];
    //protected $fillable = ['username', 'nama', 'password', 'level_id'];

    public function level(): BelongsTo      
{
    return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
}

}
