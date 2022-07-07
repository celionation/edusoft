<?php


use core\Config;
use core\View;
use src\models\Articles;
use src\models\Comments;

function asset($url)
{
    $file_path = $url;
    $file_path = str_replace("\\", "/", $file_path);
    return str_replace("//", "/", $file_path);
}

/**
 * Component Function is to Add
 * Small component of the Page
 * For improved and Neat Code
 *
 * @param [type] $component
 * @return void
 */
function component($component)
{
    return View::component($component);
}

function partials($partial)
{
    return View::partial($partial);
}

function formatDollars($dollars): string
{
    $formatted = "$" . number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $dollars)), 2);
    return $dollars < 0 ? "({$formatted})" : "{$formatted}";
}

function formatNaira($naira): string
{
    $formatted = number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $naira)), 2) . "Naira";
    return $naira < 0 ? "({$formatted})" : "{$formatted}";
}

function back()
{
    $prev = "
        <script>
            javascript:history.go(-1)
        </script>
    ";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $prev = str_replace(Config::get('URL'), '', $_SERVER['HTTP_REFERER']);
        $prev = str_replace(Config::get('URL') . "/admin", '', $_SERVER['HTTP_REFERER']);
    }
    return $prev;
}

function uploadLink($link)
{
    $uploadLink = $link;
    if($uploadLink == 'localhost') {
        $uploadLink = '/';
    }
    return $uploadLink;
}