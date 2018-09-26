<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;
use Eks\Diff;

class Revision extends Model
{
    protected $table = 'revisions';
    protected $fillable = [
        'document_id',
        'body'
    ];
    public function document()
    {
        return $this->belongsTo('Eks\Models\Document');
    }
    public function toArray() {
        return unserialize($this->body);
    }
    public function toHTML() {
        return Diff::toTable($this->toArray());
    }
}