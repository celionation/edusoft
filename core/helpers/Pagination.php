<?php

namespace core\helpers;

class Pagination
{
    public static function getPaginationNumbers($currentPage, $totalNumberOfPages)
    {
        $current = $currentPage;
        $last = $totalNumberOfPages;
        $delta = 2;
        $left = $current - $delta;
        $right = $current + $delta + 1;

        $range = [];
        $rangeWithDots = [];
        $i = -1;

        for ($i = 1; $i <= $last; $i++) {
            if ($i == 1 || $i == $last || $i >= $left && $i < $right) {
                array_push($range, $i);
            }
        }

        for ($i = 0; $i < count($range); $i++) {
            if ($i != -1) {
                if ($range[$i] - $i === 2) {
                    array_push($rangeWithDots, $i + 1);
                } else if ($range[$i] - $i !== 1) {

                    array_push($rangeWithDots, '...');
                }
            }

            array_push($rangeWithDots, $range[$i]);
            $i = $range[$i];
        }
        return $rangeWithDots;
    }

    public static function displayPagination($pageNumbers, $currentPage, $currentLink, $prevPage, $nextPage)
    {
        $html = '<div class="">';

        $html .= '<nav aria-label="Pagination">';

        $html .= '<ul class="d-flex justify-content-center align-items-center my-1 pagination">';

        $prevPage = !$prevPage ? 'disabled' : '';

        $html .= '<li class="page-item '.$prevPage.'" aria-current="page">';

        $html .= '<a class="page-link" href="' . ROOT . $currentLink . '?page=' . $prevPage . '">&laquo;</a>';

        $html .= '</li>';

        $nextPage = !$nextPage ? 'disabled' : '';

        $html .= '<li class="page-item">';
        $html .= '<a class="page-link" href="' . ROOT . $currentLink . '?page=' . $nextPage . '">&raquo;</a>';
        $html .= '</li>';

        $html .= '</ul>';

        $html .= '</nav>';

        $html .= '</div>';

        return $html;
    }

}