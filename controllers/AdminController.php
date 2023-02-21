<?php

class AdminController extends BaseController
{
    protected $template = 'admin';
    protected $accesslevel = 2;
    
    const MODELS = [
        'pages'    => ['model' => 'PageModel',    'accesslevel' => 2, 'nav' => true],
        'games'    => ['model' => 'GameModel',    'accesslevel' => 2, 'nav' => true],
        'releases' => ['model' => 'ReleaseModel', 'accesslevel' => 2, 'nav' => false],
        'covers'   => ['model' => 'CoverModel',   'accesslevel' => 2, 'nav' => false],
    ];

    public function init()
    {
        $i = empty($this->slug) ? 0 : count($this->slug);
        if($i === 0) $this->home();
        elseif($i === 1) $this->list($this->slug[0]);
        elseif($i === 2 && $this->slug[1] === 'new') $this->new($this->slug[0]);
        elseif($i === 3 && $this->slug[1] === 'new') $this->new($this->slug[0], $this->slug[2]);
        elseif($i === 3 && $this->slug[1] === 'edit') $this->update($this->slug[0], $this->slug[2]);
        elseif($i === 3 && $this->slug[1] === 'delete') $this->delete($this->slug[0], $this->slug[2]);
        elseif($i === 4 && $this->slug[1] === 'edit') $this->update($this->slug[0], $this->slug[3], $this->slug[2]);
        elseif($i === 3 && $this->slug[1] === 'console') $this->consolelist($this->slug[2]);
        else RedirectHelper::pageNotFound();
    }

    private function home()
    {
        $this->view = 'admin.html';
    }
    
    private function list($entity)
    {
        $this->view = "list$entity.html";
        $this->di->Page->title = ucfirst($entity);
        $this->di->Page->entity = $entity;
        $model = $this->getModel($entity);
        $model->list();
    }
    
    private function consolelist($console)
    {
        $this->view = "listgames.html";
        $this->di->Page->title = 'Games | '.ucfirst($console);
        $this->di->Page->entity = 'games';
        $model = $this->getModel('games');
        $model->list($console);
    }
    
    private function new($entity, $parentid = null)
    {
        if($parentid) $this->di->Page->parentid = $parentid;
        $model = $this->post($entity, 'create', $parentid);
        $model->new();
    }

    private function update($entity, $url, $parentid = null)
    {
        $model = $this->post($entity, 'update', $parentid);
        $model->read($url, 'url');
    }

    private function delete($entity, $url)
    {
        if($entity === 'pages' && $url === 'home'){
            $this->session->error = "The home page can't be deleted";
        } else {
            $model = $this->getModel($entity);
            $model->delete($url, 'url');
            $this->session->message = 'Deleted successfully!';
        }
        RedirectHelper::redirect($model->return ?? "/admin/$entity");
    }

    private function getModel($slug)
    {
        $class = self::MODELS[$slug]['model'] ?? null;
        if(!empty(self::MODELS[$slug]['accesslevel'])){
            $this->accesslevel = self::MODELS[$slug]['accesslevel'];
        }
        if($class && class_exists($class)) return $this->di->$class;
        else RedirectHelper::pageNotFound();
    }
    
    private function post($entity, $method, $parentid = null)
    {
        $this->view = "edit$entity.html";
        $model = $this->getModel($entity);
        if(!empty($_POST)){
            if($parentid) $model->parentid = $parentid;
            if($model->$method($_POST)) $this->session->message = 'Saved successfully';
            else $this->session->error = 'Failed to save';
            RedirectHelper::redirect($model->return ?? "/admin/$entity");
        } else return $model;
    }
}