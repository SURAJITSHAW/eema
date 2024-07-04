<?php
##############################################
########## Seesions Control File #############
######### Package: RTAK v2.0, 2016 ###########
######### Version: 2.0 #######################
######### Author: ABHIJEET K. ################
##############################################

class Session{

    public $_started = false;

    protected $_secureId = false;

    function __construct($secureId = false){
        $this->_secureId = $secureId;
        if(! isset($_SESSION['started']) ){
            session_start();
            if($this->_secureId){
                session_regenerate_id();
            }
            $this->_started = true;
            $this->set('started', $this->_started);
        }
    }

    public function getID(){
        if(! $this->get('started') )
            return false;
        else
            return session_id();
    }

    public function get($name){
        if(! isset($_SESSION[$name]) )
            return false;
        else
            return $_SESSION[$name];
    }

    public function set($name, $value){
        $_SESSION[$name] = $value;
    }

    public function getAll(){
        if(! $this->get('started') ){
            return false;
        }else{
            return $_SESSION;
        }
    }

    public function delete($name){
        if(! isset($_SESSION[$name]) ){
            return false;
        }else{
            unset($_SESSION[$name]);
            return true;
        }
    }

    public function destroy(){
        if( $this->get('started') ){
            session_destroy();
            return true;
        }else{
            return false;
        }
    }

    public function logMessages($echo = true){
        if( $this->get('success') && ($this->get('success') !== '') ){
            if($echo)
                echo '<div class="alert alert-success">'.$this->get('success').'</div>';
            else
                '<div class="alert alert-success">'.$this->get('success').'</div>';
            $this->delete('success');
        }
        if( $this->get('error') && ($this->get('error') !== '') ){
            if($echo)
                echo '<div class="alert alert-danger">'.$this->get('error').'</div>';
            else
                '<div class="alert alert-danger">'.$this->get('error').'</div>';
            $this->delete('error');
        }
    }

}

$session = new Session;
