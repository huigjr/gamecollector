<?php

class CoverModel extends BaseModel
{
    protected $id = 'coverid';
    protected $table = 'covers';

    public function getAllGameCovers($id)
    {
        //$this->page->covers = $this->db->getAll("SELECT console,image FROM `covers` WHERE `gameid` = :id", ['id' => $id]);
        $this->page->partial('covers', "SELECT console,image FROM `covers` WHERE `gameid` = :id", ['id' => $id]);
    }

    public function create($array)
    {
        if(isset($_FILES["file"]["tmp_name"])){
            $game = $this->di->ReleaseModel->getById($_POST['releaseid']);
            $filename = $game['url'].'-'.$_POST['region'];
            if($_POST['console'] === 'smart'){
                $console = 'xbo';
                $second = 'sxs';
            } else {
                $console = $_POST['console'];
                $second = null;
            }
            $raw = ROOT."/assets/images/raw/{$console}/{$filename}.".$this->getExtention();
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $raw)){
                $image = new Image($raw);
                $image->scaleToWidth(600);
                $image->save(ROOT."/assets/images/large/{$console}/{$filename}.webp", 60);
                parent::create([
                    'gameid' => $game['gameid'],
                    'covertype' => 1,
                    'console' => $console,
                    'second' => $second,
                    'region' => $_POST['region'],
                    'image' => "{$filename}.webp",
                ]);
                $this->session->message = 'File uploaded';
            } else {
                $this->session->error = 'File upload failed';
            }
            RedirectHelper::redirect("/admin/games/edit/{$game['url']}");
        }
        
    }

    private function getExtention()
    {
        $mime = getimagesize($_FILES["file"]["tmp_name"])['mime'];
        if($mime === 'image/jpeg') return 'jpg';
        elseif($mime === 'image/png') return 'png';
        elseif($mime === 'image/webp') return 'webp';
        else throw new Exception('File type not supported');
    }
}