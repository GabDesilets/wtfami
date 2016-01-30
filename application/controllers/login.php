<?php


/**
 * Class Login
 *
 * Manage the authentication
 *
 * @property Login_Model   $login_model
 * @property users_model $employe_model
 * @property CI_Security   $security
 */
class login extends CI_Controller
{

    /**
     * Constructor
     *
     * Load les models/helpers que nous avons de besoins
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
        $this->load->model('login_model');
        $this->load->model('users_model');
    }

    public function index() {
        $this->showForm();
    }

    /**
     * Affiche la page de connection
     *
     * @param string $error si des erreurs est utiliser lorsque nous validont la combinaison username/password
     * apres que les validations de bases aient passées
     */
    public function showForm($error = '') {
        //$this->output->enable_profiler(TRUE);

        $data['title']    = 'Authentification'; // Capitalize the first letter
        $data['menu']     = 'Authentification';
        $data['isLoggin'] = true;

        $data['error'] = $error
            ? '<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$error.'</div>'
            : '';

        $this->load->view('login/login_view', $data);
    }


    /**
     * Do the user auth
     */
    public function authenticateUser() {

        if ($this->formValidation()) {
            $username = trim($this->input->post('username'));
            $password = do_hash(trim($this->input->post('password')));

            if ($this->login_model->doAuthentication($username, $password)) {
                $user = $this->users_model->whereUsernamePassword($username, $password)->getOne();
                $sessionData = array(
                    'full_name' => ucfirst($user->fname).' '.ucfirst($user->lname),
                    'uid'             => $user->id,
                    'is_logged_in'      => true
                );

                $this->session->set_userdata($sessionData);

                redirect('home');

            }
            else {
                $this->showForm('Nom d\'utilisateur ou mot de passe incorrect');
            }

        }
        else {
            $this->showForm();
        }

    }

    public function disconnectUser(){
        $this->session->sess_destroy();
        redirect('authenticate');
    }

    private  function formValidation() {
        $this->form_validation->set_rules('username', 'Nom d\'utilisateur', "xss_clean|required");
        $this->form_validation->set_rules('password', 'Mot de passe', 'xss_clean|required');

        return $this->form_validation->run();
    }
}