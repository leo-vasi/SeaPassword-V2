<?php
namespace exceptions;

use Exception;

class InvalidCredentialsException extends Exception {
    public function __construct($message = "Credenciais inválidas", $code = 401) {
        parent::__construct($message, $code);
    }
}
?>