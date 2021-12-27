<?php
/**
 * php-mail
 * This file contains NullMessageException class.
 *
 * Created by PhpStorm on 27/12/2021 at 17:10
 *
 * @author Sofiakb <contact.sofiakb@gmail.com>
 * @package Sofiakb\Mail\Exceptions
 * @file Sofiakb\Mail\Exceptions\NullMessageException
 */

namespace Sofiakb\Mail\Exceptions;

use Exception;
use Sofiakb\Mail\Facades\Mail;
use Throwable;

class NullMessageException extends Exception
{
    /**
     * NullMessageException constructor.
     * @param null $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?? sprintf("Please provide a message with %s::create() or as parameter", Mail::class), $code, $previous);
    }
}