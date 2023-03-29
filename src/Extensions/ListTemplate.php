<?php

namespace BotMan\Drivers\Whatsapp\Extensions;

use BotMan\BotMan\Interfaces\WebAccess;
use Illuminate\Support\Arr;
use JsonSerializable;

class ListTemplate implements JsonSerializable, WebAccess
{

    /** @var string */
    public $text;

    /** @var string */
    public $header;

    /** @var string */
    public $footer;

    /** @var string */
    public $action;

    /** @var array */
    public $sections = [];

    

    /**
     * @param $text
     * @return static
     */
    public static function create($text, $header, $footer, $action)
    {
        return new static($text, $header, $footer, $action);
    }

    public function __construct($text, $header, $footer, $action)
    {
        $this->text = $text;
        $this->header = $header;
        $this->footer = $footer;
        $this->action = $action;
    }

    /**
     * @param  ElementSectionList  $list
     * @return $this
     */
    public function addSection(ElementSectionList $list)
    {
        $this->sections[] = $list->toArray();

        return $this;
    }

    /**
     * @param  array  $buttons
     * @return $this
     */
    public function addSections(array $sections)
    {
        foreach ($sections as $list) {
            if ($list instanceof ElementSectionList) {
                $this->sections[] = $list->toArray();
            }
        }

        return $this;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => 'interactive',
            'interactive' => [
                'action' => [
                    'sections' => $this->sections,
                ]
            ],
        ];
    }


    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Get the instance as a web accessible array.
     * This will be used within the WebDriver.
     *
     * @return array
     */
    public function toWebDriver()
    {
        return [
            'type' => 'list',
            'text' => $this->text,
            'sections' => $this->sections,
        ];
    }
}
