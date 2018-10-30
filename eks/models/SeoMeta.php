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
    protected $site_name = 'James of the Internet';
    protected $sep = ' | ';

    public function document()
    {
        return $this->belongsTo('Eks\Models\Document');
    }
    public function title()
    {
        $title = $this->title;
        if (!$title) {
            return $this->fallback_title() . $this->sep . $this->site_name;
        }
        return $title;
    }
    public function description() {
        $description = $this->description;
        if (!$description) {
            $doc = $this->document();
            return substr($doc->body, 0, 50) . '...';
        }
        return $description;
    }
    protected function fallback_title() {
        $doc = $this->document();
        return ucwords(implode(' ', explode('-', str_replace('/', '', $doc->slug))));
    }
}