<?php
 
use Phalcon\Mvc\Controller;
 
class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->tag->setTitle("Learning Phalcon");
 
        //set assets in header template
        $this->assets
            ->collection('headerCss')
            ->addCss('css/bootstrap.min.css')
            ->addCss('css/bootstrap-theme.min.css');
            //->addCss('css/bootstrap-theme.css');
 
        $this->assets
            ->collection('headerJs')
            ->addJs('js/jquery.min.js');
        //set assets in footer template
        $this->assets
            ->collection('footer')
            ->addJs('js/bootstrap.js');
    }
}