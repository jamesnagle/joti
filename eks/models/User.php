<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'role_id'
    ];
    public function role()
    {
        return $this->belongsTo('Eks\Models\Role');
    }
}