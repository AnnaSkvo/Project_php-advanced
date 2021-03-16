<?php

namespace app\main;

use app\repositories\GoodRepository;
use app\services\BasketService;
use app\services\DB;
use app\services\TwigRenderServices;

/**
 * Class Container
 * @package app\main
 * @property DB db
 * @property DB db2
 * @property GoodRepository goodRepository
 * @property TwigRenderServices renderer
 * @property BasketService basketService
 */
class Container
{
    protected $componentsData = [];
    protected $components = [];

    /**
     * Container constructor.
     * @param array $componentsData
     */
    public function __construct(array $componentsData)
    {
        $this->componentsData = $componentsData;
    }


    public function __get($name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (!array_key_exists($name, $this->componentsData)) {
            throw new \Exception('В комонентах не определен класс ' . $name);
        }

        $className = $this->componentsData[$name]['class'];
        if (!empty($this->componentsData[$name]['config'])) {
            $config = $this->componentsData[$name]['config'];
            $component = new $className($config);
        } else {
            $component = new $className();
        }

        if (method_exists($component, 'setContainer')) {
            $component->setContainer($this);
        }

        $this->components[$name] = $component;

        return $component;
    }
}