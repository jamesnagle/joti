<?php 
namespace Eks\Controllers;

use Eks\Template;
use Eks\Models\Document;

class AdminController 
{
    protected $method;
    protected $type;
    protected $action;
    protected $category = 1;
    protected $docs;
    protected $id;

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

        if ($this->isSkill()) {
            $this->category = 4;
        }
        if ($this->isLesson()) {
            $this->category = 5;
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
        $doc = Document::with('seoMeta')->findOrFail($this->id);

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
    protected function isEdit() {
        if ($this->action === 'edit') {
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

}