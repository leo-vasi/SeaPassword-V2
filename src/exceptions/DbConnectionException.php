<?php

namespace exceptions;

use Exception;

class DbConnectionException extends Exception {
    public function __construct($message = "Error establishing database connection to database", $code = 500) {
        parent::__construct($message, $code);
    }
}