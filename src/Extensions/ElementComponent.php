<?php

namespace BotMan\Drivers\Whatsapp\Extensions;

class ElementComponent
{

     /** @var string */
     protected $type = self::TYPE_REPLY;

    /** @var array */
    protected $parameters = [];

    /** @var string */
    protected $type_component;

    /** @var string */
    protected $url;

    /** @var string */
    protected $fallback_url;

    /** @var string */
    protected $payload;


    /** @var string */
    protected $webview_share_button;

    /** @var bool */
    protected $messenger_extensions = false;

    /** @var GenericTemplate */
    protected $shareContents;


    const TYPE_REPLY = 'reply';


    /**
     * @param  array   $parameters
     * @return static
     */
    public static function create($type_component, array $parameters)
    {
        return new static($type_component, $parameters);
    }
  
    

    /**
     * @param  array   $parameters
     */
    public function __construct($type_component, array $parameters)
    { 
        $this->type_component = $type_component;
        $this->parameters = $parameters;
    }

     /**
     * Set the button URL.
     *
     * @param  string  $url
     * @return $this
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the button type.
     *
     * @param  string  $type
     * @return $this
     */
    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param $payload
     * @return $this
     */
    public function payload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * @param  string  $fallback_url
     * @return $this
     */
    public function fallbackUrl($fallback_url)
    {
        $this->fallback_url = $fallback_url;

        return $this;
    }

    /**
     * enable messenger extensions.
     *
     * @return $this
     */
    public function enableExtensions()
    {
        $this->messenger_extensions = true;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        
        $componentArray = [  
                'type' => $this->type_component,
                'sub_type' => 'url',
                'index' => '0',
                'parameters' => $this->parameters
    ];

    return $componentArray;
    
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
