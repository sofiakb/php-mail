<?php
/**
 * php-mail
 * This file contains Message class.
 *
 * Created by PhpStorm on 27/12/2021 at 17:16
 *
 * @author Sofiakb <contact.sofiakb@gmail.com>
 * @package Sofiakb\Mail
 * @file Sofiakb\Mail\Message
 */

namespace Sofiakb\Mail;

use Ssf\Support\Traits\ForwardsCalls;
use Swift_Attachment;
use Swift_Image;
use Swift_Message;
use Swift_Mime_Attachment;

/**
 * Class Message
 * @package Sofiakb\Mail
 * @author Sofiakb <contact.sofiakb@gmail.com>
 *
 * @mixin Swift_Message
 */
class Message
{
    use ForwardsCalls;
    
    /**
     * The Swift Message instance.
     *
     * @var Swift_Message
     */
    protected Swift_Message $swift;
    
    /**
     * CIDs of files embedded in the message.
     *
     * @var array
     */
    protected array $embeddedFiles = [];
    
    /**
     * Create a new message instance.
     *
     * @param Swift_Message|null $swift
     */
    public function __construct(Swift_Message $swift = null)
    {
        $this->swift = $swift ?? new Swift_Message();
    }
    
    /**
     * Add a "from" address to the message.
     *
     * @param string|array $address
     * @param string|null $name
     * @return $this
     */
    public function from($address, ?string $name = null): Message
    {
        $this->swift->setFrom($address, $name);
        
        return $this;
    }
    
    /**
     * Set the "sender" of the message.
     *
     * @param string|array $address
     * @param string|null $name
     * @return $this
     */
    public function sender($address, ?string $name = null): Message
    {
        $this->swift->setSender($address, $name);
        
        return $this;
    }
    
    /**
     * Set the "return path" of the message.
     *
     * @param string $address
     * @return $this
     */
    public function returnPath(string $address): Message
    {
        $this->swift->setReturnPath($address);
        
        return $this;
    }
    
    /**
     * Add a recipient to the message.
     *
     * @param string|array $address
     * @param string|null $name
     * @param bool $override
     * @return $this
     */
    public function to($address, ?string $name = null, bool $override = false): Message
    {
        if ($override) {
            $this->swift->setTo($address, $name);
            
            return $this;
        }
        
        return $this->addAddresses($address, $name, 'To');
    }
    
    /**
     * Add a carbon copy to the message.
     *
     * @param string|array $address
     * @param string|null $name
     * @param bool $override
     * @return $this
     */
    public function cc($address, ?string $name = null, bool $override = false): Message
    {
        if ($override) {
            $this->swift->setCc($address, $name);
            
            return $this;
        }
        
        return $this->addAddresses($address, $name, 'Cc');
    }
    
    /**
     * Add a blind carbon copy to the message.
     *
     * @param string|array $address
     * @param string|null $name
     * @param bool $override
     * @return $this
     */
    public function bcc($address, ?string $name = null, bool $override = false): Message
    {
        if ($override) {
            $this->swift->setBcc($address, $name);
            
            return $this;
        }
        
        return $this->addAddresses($address, $name, 'Bcc');
    }
    
    /**
     * Add a reply to address to the message.
     *
     * @param string|array $address
     * @param string|null $name
     * @return $this
     */
    public function replyTo($address, ?string $name = null): Message
    {
        return $this->addAddresses($address, $name, 'ReplyTo');
    }
    
    /**
     * Set the subject of the message.
     *
     * @param string $subject
     * @return $this
     */
    public function subject(string $subject): Message
    {
        $this->swift->setSubject($subject);
        
        return $this;
    }
    
    /**
     * Set the message priority level.
     *
     * @param int $level
     * @return $this
     */
    public function priority(int $level): Message
    {
        $this->swift->setPriority($level);
        
        return $this;
    }
    
    /**
     * Attach a file to the message.
     *
     * @param string $file
     * @param array $options
     * @return $this
     */
    public function attach(string $file, array $options = []): Message
    {
        $attachment = $this->createAttachmentFromPath($file);
        
        return $this->prepAttachment($attachment, $options);
    }
    
    /**
     * Attach in-memory data as an attachment.
     *
     * @param string $data
     * @param string $name
     * @param array $options
     * @return $this
     */
    public function attachData(string $data, string $name, array $options = []): Message
    {
        $attachment = $this->createAttachmentFromData($data, $name);
        
        return $this->prepAttachment($attachment, $options);
    }
    
    /**
     * Embed a file in the message and get the CID.
     *
     * @param string $file
     * @return string
     */
    public function embed(string $file): string
    {
        if (isset($this->embeddedFiles[$file])) {
            return $this->embeddedFiles[$file];
        }
        
        return $this->embeddedFiles[$file] = $this->swift->embed(
            Swift_Image::fromPath($file)
        );
    }
    
    /**
     * Embed in-memory data in the message and get the CID.
     *
     * @param string $data
     * @param string $name
     * @param string|null $contentType
     * @return string
     */
    public function embedData(string $data, string $name, ?string $contentType = null): string
    {
        $image = new Swift_Image($data, $name, $contentType);
        
        return $this->swift->embed($image);
    }
    
    /**
     * Get the underlying Swift Message instance.
     *
     * @return Swift_Message
     */
    public function getSwiftMessage(): Swift_Message
    {
        return $this->swift;
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
        return $this->forwardCallTo($this->swift, $method, $parameters);
    }
    
    /**
     * Add a recipient to the message.
     *
     * @param string|array $address
     * @param string $name
     * @param string $type
     * @return $this
     */
    protected function addAddresses($address, string $name, string $type): Message
    {
        if (is_array($address)) {
            $this->swift->{"set{$type}"}($address, $name);
        } else {
            $this->swift->{"add{$type}"}($address, $name);
        }
        
        return $this;
    }
    
    /**
     * Create a Swift Attachment instance.
     *
     * @param string $file
     * @return Swift_Mime_Attachment
     */
    protected function createAttachmentFromPath(string $file): Swift_Mime_Attachment
    {
        return Swift_Attachment::fromPath($file);
    }
    
    /**
     * Create a Swift Attachment instance from data.
     *
     * @param string $data
     * @param string $name
     * @return Swift_Attachment
     */
    protected function createAttachmentFromData(string $data, string $name): Swift_Attachment
    {
        return new Swift_Attachment($data, $name);
    }
    
    /**
     * Prepare and attach the given attachment.
     *
     * @param Swift_Attachment|Swift_Mime_Attachment $attachment
     * @param array $options
     * @return $this
     */
    protected function prepAttachment($attachment, array $options = []): Message
    {
        // First we will check for a MIME type on the message, which instructs the
        // mail client on what type of attachment the file is so that it may be
        // downloaded correctly by the user. The MIME option is not required.
        if (isset($options['mime'])) {
            $attachment->setContentType($options['mime']);
        }
        
        // If an alternative name was given as an option, we will set that on this
        // attachment so that it will be downloaded with the desired names from
        // the developer, otherwise the default file names will get assigned.
        if (isset($options['as'])) {
            $attachment->setFilename($options['as']);
        }
        
        $this->swift->attach($attachment);
        
        return $this;
    }
}