<?php

class InvalidDataException extends Exception {
    public function __construct($message = "Invalid data provided", $code = 400) {
        parent::__construct($message, $code);
    }
}
?>