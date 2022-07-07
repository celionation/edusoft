<?php

namespace core\helpers;

class Navigation
{
    public static function isCurrentPage($page)
    {
        global $currentLink;
        if (!empty($page) && strpos($page, ':id') > -1) {
            $page = str_replace(":id", "", $page);
            return strpos($currentLink, $page) > -1;
        }
        return $page == $currentLink;
    }

    public static function activeClass($page, $class = '')
    {
        $active = self::isCurrentPage($page);
        $class = $active ? $class . " active" : $class;
        return $class;
    }

    public static function subLink($link, $label)
    {
        $active = self::isCurrentPage($link);
        $class = self::activeClass($link);
        $linkClass = 'fw-bold text-black border-end border-1 px-2 text-capitalize';
        $linkClass .= $active ? " active" : "";
        $link =  '/' . $link;
        return "<a class=\"{$linkClass}{$class}\" href=\"{$link}\" >{$label}</a>";
    }

    public static function navItem($link, $label, $isDropdownItem = false, $page = '')
    {
        $active = self::isCurrentPage($link);
        $class = self::activeClass($link);
        $linkClass = $isDropdownItem ? 'dropdown-item' : 'nav-link';
        $linkClass .= $active && $isDropdownItem ? " active" : "";
        $link =  '/' . $link;
        $html = "<li class=\"nav-item\">";
        $html .= "<a class=\"{$linkClass}{$class}\" href=\"{$link}\" >{$label}</a>";
        $html .= "</li>";
        return $html;
    }

    public static function navItemIcon($link, $label, $icon = '', $isDropdownItem = false): string
    {
        $active = self::isCurrentPage($link);
        $class = self::activeClass($link);
        $linkClass = $isDropdownItem ? 'dropdown-item' : 'nav-link';
        $linkClass .= $active && $isDropdownItem ? " active" : "";
        $link =  '/' . $link;
        $html = "<li class=\"nav-item\" data-bs-toggle=\"tooltip\" data-placement=\"right\" title=\"{$label}\">";
        $html .= "<a class=\"{$linkClass}{$class}\" href=\"{$link}\" ><i class=\"{$icon}\"></i><span class=\"nav-link-text\">{$label}</span></a>";
        $html .= "</li>";
        return $html;
    }
}