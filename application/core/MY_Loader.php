<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Class MY_Loader
 */
class MY_Loader extends CI_Loader
{
    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
    }
    /**
     * Inclue les templates header.php et footer.php pour chaque view a afficher
     *
     * @param string $viewFile
     * @param array  $vars
     * @param bool   $return
     *
     * @return string
     */
    public function myView($viewFile, $vars = array(), $return = FALSE) {
        $content  = $this->view('templates/header', $vars, $return);
        $content .= $this->view($viewFile, $vars, $return);
        $content .= $this->view('templates/footer', $vars, $return);
        if ($return) {
            return $content;
        }
    }
}