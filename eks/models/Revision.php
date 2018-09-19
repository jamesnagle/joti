<?php 
namespace Eks\Models;

use Illuminate\Database\Eloquent\Model;

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
}