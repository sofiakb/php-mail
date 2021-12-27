<?php
/**
 * php-mail
 * This file contains Transport class.
 *
 * Created by PhpStorm on 27/12/2021 at 17:15
 *
 * @author Sofiakb <contact.sofiakb@gmail.com>
 * @package Sofiakb\Mail
 * @file Sofiakb\Mail\Transport
 */

namespace Sofiakb\Mail;

use Ssf\Support\Env;
use Swift_SmtpTransport;

class Transport
{
    /**
     * @var string|null $username
     */
    private ?string $username;
    
    /**
     * @var string|null $password
     */
    private ?string $password;
    
    /**
     * @var string|null $host
     */
    private ?string $host;
    
    /**
     * @var string|null $port
     */
    private ?string $port;
    
    /**
     * @var string|null $encryption
     */
    private ?string $encryption;
    
    /**
     * @var Swift_SmtpTransport
     */
    private Swift_SmtpTransport $transport;
    
    
    /**
     * Transport constructor.
     * @param array|null[] $parameters
     */
    public function __construct(array $parameters = array('username' => null, 'password' => null, 'host' => null, 'port' => null, 'encryption' => null))
    {
        $this->setUsername($parameters['username'] ?? Env::get('MAIL_USER'));
        $this->setPassword($parameters['password'] ?? Env::get('MAIL_PASSWORD'));
        $this->setHost($parameters['host'] ?? Env::get('MAIL_HOST'));
        $this->setPort($parameters['port'] ?? Env::get('MAIL_PORT'));
        $this->setEncryption($parameters['encryption'] ?? Env::get('MAIL_ENCRYPTION'));
        
        $this->transport = (new Swift_SmtpTransport($this->host, $this->port, $this->encryption))
            ->setUsername($this->username)
            ->setPassword($this->password);
    }
    
    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }
    
    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }
    
    /**
     * @param string|null $host
     */
    public function setHost(?string $host): void
    {
        $this->host = $host;
    }
    
    /**
     * @param string|null $port
     */
    public function setPort(?string $port): void
    {
        $this->port = $port;
    }
    
    /**
     * @param string|null $encryption
     */
    public function setEncryption(?string $encryption): void
    {
        $this->encryption = $encryption;
    }
    
    /**
     * @return Swift_SmtpTransport
     */
    public function get(): Swift_SmtpTransport
    {
        return $this->transport;
    }
    
}