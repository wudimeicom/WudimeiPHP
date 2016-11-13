<?php
namespace Wudimei;

use Wudimei\Menu\Item;

class Menu
{

    public $menus = [];

    public $parent = null;

    public $prefix = "";

    public $activeIdArray = [];

    public $section = "";

    public $sections = [];
 // config
    public function __construct ()
    {}

    public function section ($sec)
    {
        $this->section = $sec;
    }

    public function initConfig ($sections)
    {
        $this->sections = $sections;
    }

    public function active ($ids)
    {
        if (is_array($ids)) {
            $this->activeIdArray = $ids;
        } else {
            $this->activeIdArray = preg_split("/[,;\s]+/i", $ids);
        }
    }

    public function item ($menuId, $url, $label, $icon = "", $closure = null)
    {
        $item = new Item();
        $item->id = $menuId;
        $item->url = $this->prefix . $url;
        $item->label = \Lang::get($label);
        $item->icon = $icon;
        $item->parent = &$this->parent;
        
        if (in_array($menuId, $this->activeIdArray)) {
            $item->active = true;
        }
        
        if (is_callable($closure)) {
            $tmpP = &$this->parent;
            
            $this->parent = & $item;
            call_user_func($closure);
            $this->parent = &$tmpP;
        }
        if ($this->parent == null) {
            $this->menus[$this->section][] = $item;
        } else {
            $this->parent->submenus[] = $item;
        }
    }

    public function prefix ($prefix)
    {
        $this->prefix = $prefix;
    }

    public function getMenus ()
    {
        return $this->menus;
    }

    public function getHtml ()
    {
        include $this->sections[$this->section];
        
        $menus = $this->menus[$this->section];
        $html = "";
        for ($i = 0; $i < count($menus); $i ++) {
            $html .= $menus[$i];
        }
        return $html;
    }
}
