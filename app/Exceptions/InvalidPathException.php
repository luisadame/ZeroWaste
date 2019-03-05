<?php
namespace App\Exceptions;

class InvalidPathException extends \InvalidArgumentException implements \Throwable
{
    /**
     * The given server id when decrypted is not a valid path.
     *
     * @param string $message
     * @param integer $code
     */
    public function __construct($message = 'The given file path was invalid', $code = 400)
    {
        parent::__construct($message, $code);
    }
}
