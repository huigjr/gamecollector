<?php

class AdminController extends BaseController
{
    protected $template = 'admin';
    protected $accesslevel = 1;
    
    const MODELS = [
        'pages' => ['model' => 'PageModel', 'accesslevel' => 1],
        'games' => ['model' => 'GameModel', 'accesslevel' => 1],
    ];

    public function init()
    {
        $i = empty($this->slug) ? 0 : count($this->slug);
        if($i === 0) $this->home();
        elseif($i === 1) $this->list($this->slug[0]);
        elseif($i === 2 && $this->slug[1] === 'new') $this->new($this->slug[0]);
        elseif($i === 3 && $this->slug[1] === 'edit') $this->update($this->slug[0], $this->slug[2]);
        elseif($i === 3 && $this->slug[1] === 'delete') $this->delete($this->slug[0], $this->slug[2]);
        else RedirectHelper::pageNotFound();
    }

    private function home()
    {
        $this->view = 'admin.html';
    }
    
    private function list($entity)
    {
        $this->view = 'list.html';
        $this->di->Page->title = ucfirst($entity);
        $this->di->Page->entity = $entity;
        $model = $this->getModel($entity);
        $model->list();
    }
    
    private function new($entity)
    {
        $model = $this->getModel($entity);
        if(!empty($_POST)){
            $model->create($_POST);
            $this->session->message = 'Created successfully!';
            RedirectHelper::redirect("/admin/$entity");
        } else $model->new();
        $this->view = "edit$entity.html";
    }

    private function update($entity, $url)
    {
        $model = $this->getModel($entity);
        if(!empty($_POST)){
            $model->update($_POST);
            $this->session->message = 'Saved successfully!';
            RedirectHelper::redirect("/admin/$entity");
        }
        $this->view = "edit$entity.html";
        $model->read($url, 'url');
    }

    private function delete($entity, $url)
    {
        if($entity === 'pages'){
            if($url === 'home'){
                $this->session->error = "The home page can't be deleted";
            } else {
                $model = $this->getModel($entity);
                $model->delete($url, 'url');
                $this->session->message = 'Deleted successfully!';
            }
        } else {
            $this->session->error = 'Delete function not yet implemented for Games';
        }
        RedirectHelper::redirect("/admin/$entity");
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
}