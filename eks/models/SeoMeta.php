<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';
    protected $fillable = [
        'title',
        'description',
        'index',
        'nofollow'
    ];
    public function document()
    {
        return $this->belongsTo('Eks\Models\Document');
    }
}