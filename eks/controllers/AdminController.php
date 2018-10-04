<?php 
namespace Eks\Controllers;

use Eks\Template;
use Eks\Models\Document;

class AdminController 
{
    protected $response;
    protected $method;
    protected $type;
    protected $action;
    protected $category = null;
    protected $docs;
    protected $id;

    function __construct($response) {
        $this->response = $response;
    }

    public function method($method) {
        $this->method = $method;
        return $this;
    }
    public function type($type) {
        $this->type = $type;
        return $this;
    }
    public function action($action) {
        $this->action = $action;
        return $this;
    }
    public function get($id = null) {
        $this->id = $id;

        $this->applyCategory();

        if ($this->isDestroy() 
            && $this->id !== null) {
            $this->delete();
            return;
        }
        if ($this->isTrashed() 
            && $this->id !== null) {
            $this->trash();
            return;
        }
        if ($this->isNew() 
            && $this->id === null) {
            $this->newSingle();
            return;
        }      
        if ($this->isEdit()) {
            $this->getSingle();
        } else {
            $this->getCollection();
        } 
    }
    protected function getCollection() {
        if ($this->isPage()) {
            $this->fetchPages();
        } else {
            $this->fetchPosts();
        }
        Template::load('admin/' . $this->action . '.php', [
            'title'         => $this->title(),
            'collection'    => $this->docs
        ]);
    }
    protected function getSingle() {
        $doc = Document::with(['seoMeta', 'draft', 'revisions'])->where('id', $this->id)->first();

        Template::load('admin/' . $this->action . '.php', [
            'title' => $this->title(),
            'doc'   => $doc
        ]);         
    }
    protected function newSingle() {
        $db_type = ($this->isSkill() || $this->isLesson()) ? 'post' : $this->type;
        
        $doc = Document::create([
            'type'          => $db_type,
            'status'        => 'private',
            'category_id'   => $this->category
        ]);

        Template::load('admin/' . $this->action . '.php', [
            'title' => $this->title(),
            'doc'   => $doc
        ]);         
    }    
    protected function fetchPages() {
        $docs = Document::where('type', 'page')->get();

        $this->docs = $docs;
    }
    protected function fetchPosts() {
        $docs = Document::where([
            ['type',        '=', 'post'],
            ['category_id', '=', $this->category]
        ])->with('lessons')->get();

        $this->docs = $docs;
    }
    protected function trash() {
        $doc = Document::find($this->id);
        $doc->delete();

        return $this->response->withRedirect('/admin/?type=' . $this->type . '&action=show');
    }
    protected function delete() {
       $doc = Document::find($this->id);
       $draft = $doc->draft();
       $revisions = $doc->revisions();

       $draft->delete();
       $revisions->delete();
       $doc->forceDelete(); 

       return $this->response->withRedirect('/admin/?type=' . $this->type . '&action=show');
    }
    protected function title() {

        $title = ucwords($this->type);

        switch ($this->action) {
            case 'edit':
                $title = 'Edit ' . $title;
                break;

            case 'new':
                $title = 'New ' . $title;
                break;
            
            default:
                $title = $title . ' Dashboard';
                break;
        }
        return $title;
    }
    protected function applyCategory() {
        if ($this->isPost()) {
            $this->category = 1;
        }
        if ($this->isSkill()) {
            $this->category = 4;
        }
        if ($this->isLesson()) {
            $this->category = 5;
        }
    }
    protected function isEdit() {
        if ($this->action === 'edit') {
            return true;
        } else {
            return false;
        }
    }
    protected function isNew() {
        if ($this->action === 'new') {
            return true;
        } else {
            return false;
        }
    }    
    protected function isSkill() {
        if ($this->type === 'skill') {
            return true;
        } else {
            return false;
        }
    }
    protected function isLesson() {
        if ($this->type === 'lesson') {
            return true;
        } else {
            return false;
        }
    }  
    protected function isPage() {
        if ($this->type === 'page') {
            return true;
        } else {
            return false;
        }
    } 
    protected function isPost() {
        if ($this->type === 'post') {
            return true;
        } else {
            return false;
        }
    }       
    protected function isTrashed() {
        if ($this->action === 'trash') {
            return true;
        } else {
            return false;
        }
    }
    protected function isDestroy() {
        if ($this->action === 'destroy') {
            return true;
        } else {
            return false;
        }
    }
}