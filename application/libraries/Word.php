<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/PhpWord/Autoloader.php";
use PhpOffice\PhpWord\Autoloader as Autoloader;

Autoloader::register();


class Word extends PhpOffice\PhpWord\PhpWord {

    public function __construct(){
        parent::__construct();
    }

}