<?php

class CoverModel extends BaseModel
{
    protected $id = 'coverid';
    protected $table = 'covers';

    public function create($array)
    {
        if(isset($_FILES["file"]["tmp_name"])){
            $game = $this->di->ReleaseModel->getById($_POST['releaseid']);
            $filename = $game['url'].'-'.$_POST['region'];
            $raw = ROOT."/assets/images/raw/{$_POST['console']}/{$filename}.".$this->getExtention();
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $raw)){
                $image = new Image($raw);
                $image->scaleToWidth(600);
                $image->save(ROOT."/assets/images/large/{$_POST['console']}/{$filename}.webp", 60);
                parent::create([
                    'gameid' => $game['gameid'],
                    'covertype' => 1,
                    'console' => $_POST['console'],
                    'region' => $_POST['region'],
                    'image' => "{$filename}.webm",
                ]);
                $this->session->message = 'File uploaded';
            } else {
                $this->session->error = 'File upload failed';
            }
            RedirectHelper::redirect("/admin/games/edit/{$game['url']}");
        }
        
    }
    
    private function processFile()
    {
        $extention = $this->getExtention();
        var_dump($extention);
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