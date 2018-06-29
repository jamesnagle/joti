<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    protected $table = 'documents';
    protected $fillable = [
        'title',
        'body',
        'slug'
    ];
    public function seoMeta() {
        return $this->hasOne('Eks\Models\SeoMeta');
    }
}