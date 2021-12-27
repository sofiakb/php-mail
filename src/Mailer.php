<?php
/**
 * php-mail
 * This file contains Mailer class.
 *
 * Created by PhpStorm on 27/12/2021 at 17:13
 *
 * @author Sofiakb <contact.sofiakb@gmail.com>
 * @package Sofiakb\Mail
 * @file Sofiakb\Mail\Mailer
 */

namespace Sofiakb\Mail;

use Sofiakb\Mail\Exceptions\NullMessageException;
use Ssf\Support\Traits\ForwardsCalls;
use Swift_Mailer;
use Throwable;

/**
 * Class Mailer
 * Cette classe contient la logique de l'envoie
 * d'e-mail. Voir @see \Sofiakb\Mail\Facades\Mail pour
 * plus d'informations.
 *
 * @package Sofiakb\Mail
 *
 * @mixin Message
 */
class Mailer
{
    use ForwardsCalls;
    
    /**
     * @var Mailer|null null
     */
    private static ?Mailer $instance = null;
    
    /**
     * @var Transport $transport
     */
    private Transport $transport;
    
    /**
     * @var Swift_Mailer $mailer
     */
    private Swift_Mailer $mailer;
    
    /**
     * @var Message|null $message
     */
    private ?Message $message;
    
    private array $failedRecipients;
    
    public function __construct()
    {
        $this->transport = new Transport();
        $this->mailer = new Swift_Mailer($this->transport->get());
        $this->message = null;
        $this->failedRecipients = array();
    }
    
    /**
     * @param string $content
     * @param string|null $subject
     * @param Message|null $message
     * @return bool
     * @throws NullMessageException
     * @throws Throwable
     */
    public function text(string $content, string $subject = null, Message $message = null): bool
    {
        if (($this->message = $this->message ?? $message) === null)
            throw new NullMessageException();
        $this->message->setBody($content);
        if ($subject)
            $this->message->setSubject($subject);
        return $this->send();
    }
    
    /**
     * @param string $content
     * @param string|null $subject
     * @param Message|null $message
     * @return bool
     * @throws NullMessageException
     * @throws Throwable
     */
    public function html(string $content, string $subject = null, Message $message = null): bool
    {
        if (($this->message = $this->message ?? $message) === null)
            throw new NullMessageException();
        $this->message->setContentType('text/html')
            ->setBody($content, 'text/html')
            ->setSubject($subject);
        return $this->send();
    }
    
    /**
     * @return bool
     * @throws Throwable
     */
    public function send(): bool
    {
        try {
            $this->mailer->send($this->message->getSwiftMessage(), $this->failedRecipients);
            return true;
        }
        catch (Throwable $exception) {
            throw $exception;
        }
    }
    
    /**
     * @param Message $message
     * @return $this
     */
    public function message(Message $message): Mailer
    {
        $this->message = $message;
        return $this;
    }
    
    /**
     * Dynamically pass missing methods to the Swift instance.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        $this->forwardCallTo($this->message, $method, $parameters);
        return $this;
    }
}