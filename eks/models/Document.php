<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model {
    use SoftDeletes;

    protected $table = 'documents';
    protected $fillable = [
        'title',
        'body',
        'slug',
        'type',
        'status',
        'category_id'
    ];
    protected $dates = ['deleted_at'];
    
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
    public function draft()
    {
        return $this->belongsToMany('Eks\Models\Document', 'document_drafts', 'document_id', 'draft_id');
    }
    public function revisions() {
        return $this->hasMany('Eks\Models\Revision');
    }
    public function uri($opt = null) {
        if ($opt === 'edit') {
            return $this->uriEdit();
        }
        if ($opt === 'trash') {
            return $this->uriTrash();
        }        
        if ($opt === 'destroy') {
            return $this->uriDestroy();
        }
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
    public function type() {
        if ($this->category_id === 4) {
            return 'skill';
        }
        if ($this->category_id === 5) {
            return 'lesson';
        }
        return $this->type;
    }
    protected function uriEdit() {
        return '/admin/?type=' . $this->type() . '&action=edit&id=' . $this->id . '#editor';
    }
    protected function uriDestroy() {
        return '/admin/?type=' . $this->type() . '$action=destroy&id=' . $this->id;
    }
    protected function uriTrash() {
        return '/admin/?type=' . $this->type() . '$action=trash&id=' . $this->id;
    }    
    public function value($prop) {
        $draft = $this->draft()->first();
        if ($draft) {
            return $draft->$prop;
        } else {
            return $this->$prop;
        }
    }
}