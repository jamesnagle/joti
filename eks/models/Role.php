<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [];
    public function users()
    {
        return $this->hasMany('Eks\Models\User');
    }
}