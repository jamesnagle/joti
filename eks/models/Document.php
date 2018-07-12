<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    protected $table = 'documents';
    protected $fillable = [
        'title',
        'body',
        'slug',
        'type',
        'status'
    ];
    public function seoMeta() {
        return $this->hasOne('Eks\Models\SeoMeta');
    }
}