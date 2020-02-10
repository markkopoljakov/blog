<?php
session_start();
function msg($name = '', $message ='', $class = 'Alert alert-success'){
    if (!empty($name)){
        if (!empty($message) and empty($_SESSION[$name])){
            $_SESSION[$name] = $message;
            $_SESSION[$name.'_class'] = $class;
        }elseif (empty($message) and !empty($_SESSION[$name])){
            $class =!empty( $_SESSION[$name.'_class']) ? $_SESSION[$name.'_class'] : '';
            echo '<div id="msg" class="'.$class.'">'.$_SESSION[$name].'</div>';
        }
    }
}