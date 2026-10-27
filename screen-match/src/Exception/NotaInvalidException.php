<?php

namespace ScreenMatch\Exception;

use InvalidArgumentException;
use Throwable;
use Override;

class NotaInvalidException extends InvalidArgumentException {
    public function __construct() {
        return parent::__construct('Nota precisa ser entre 0 e 10');
    }
}
