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
        'status',
        'category_id'
    ];
    public function seoMeta() {
        return $this->hasOne('Eks\Models\SeoMeta');
    }
    public function category()
    {
        return $this->belongsTo('Eks\Models\Category');
    }
    public function skill() {
        return $this->belongsToMany('Eks\Models\Document', 'skills_lessons', 'lesson_id', 'skill_id');
    }
    public function lessons()
    {
        return $this->belongsToMany('Eks\Models\Document', 'skills_lessons', 'skill_id', 'lesson_id');
    }
    public function uri() {
        if (!$this->category_id)
        {
            return $this->slug;
        }
        if ($this->category_id === 4) {
            return '/skills' . $this->slug;
        }
        if ($this->category_id === 5) {
            return '/skills' . $this->skill()->first()->slug . ltrim($this->slug, '/');
        }
        return $this->slug;
    }
}