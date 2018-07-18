<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name'
    ];
    public function documents()
    {
        return $this->hasMany('Eks\Models\Document');
    }
}