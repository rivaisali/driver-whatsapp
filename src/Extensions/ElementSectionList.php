<?php

namespace BotMan\Drivers\Whatsapp\Extensions;

class ElementSectionList
{

     /** @var string */
     protected $type = self::TYPE_REPLY;

    /** @var string */
    protected $title;

    /** @var array */
    protected $rows = [];

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
     * @param  string  $title
     * @param  array   $rows
     * @return static
     */
    public static function create($title, array $rows)
    {
        return new static($title, $rows);
    }

    /**
     * @param  string  $title
     * @param  array   $rows
     */
    public function __construct($title, array $rows)
    { 
        $this->title = $title;
        $this->rows = $rows;

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
        $listArray = [
                'title' => $this->title,
                'rows' => $this->rows
        ];

        return $listArray;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
