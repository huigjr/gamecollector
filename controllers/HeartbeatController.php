<?php

class HeartbeatController extends BaseController
{
    public function init()
    {
        if(empty($this->slug)){
            $this->session->heartbeat = time();
            RedirectHelper::outputJson(['status' => 'alive']);
        } else RedirectHelper::pageNotFound();
    }
}