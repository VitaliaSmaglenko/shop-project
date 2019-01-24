<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 22.01.2019
 * Time: 19:35
 */

namespace App;

class Pagination
{
    /**
     * @var int
     */
    private $max = 10;
    private $index = 'page';
    private $current_page;
    private $total;
    private $limit;

    public function __construct($total, $currentPage, $limit, $index)
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->index = $index;
        $this->amount = $this->amount();
         $this->setCurrentPage($currentPage);
    }

    /**
     * Displays links
     * @return string
     */
    public function get()
    {
         $links = null;
        $limits = $this->limits();

        $html = '<ul class="pagination justify-content-center">';
        for ($page = $limits[0]; $page <= $limits[1]; $page++) {
            if ($page == $this->current_page) {
                $links .= '<li class="page-item"><a class="page-link" href="#">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }
        if (!is_null($links)) {
            if ($this->current_page > 1) {
                $links = $this->generateHtml(1, '&lt;') . $links;
            }
            if ($this->current_page < $this->amount) {
                $links .= $this->generateHtml($this->amount, '&gt;');
            }
        }
        $html .= $links . '</ul>';
        return $html;
    }

    /**
     * Generates html-code links
     * @param $page
     * @param null $text
     * @return string
     */
    private function generateHtml($page, $text = null)
    {
        if (!$text) {
            $text = $page;
        }
        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);
        return
            '<li class="page-item"><a class="page-link" href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    /**
     * values for start
     * @return array
     */
    private function limits()
    {
        $left = $this->current_page - round($this->max / 2);
        $start = $left > 0 ? $left : 1;
        if ($start + $this->max <= $this->amount) {
            $end = $start > 1 ? $start + $this->max : $this->max;
        } else {
            $end = $this->amount;
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        return
            array($start, $end);
    }

    /**
     * Sets current page
     * @param $currentPage
     */
    private function setCurrentPage($currentPage)
    {
        $this->current_page = $currentPage;
        if ($this->current_page > 0) {
            if ($this->current_page > $this->amount) {
                $this->current_page = $this->amount;
            }
        } else {
            $this->current_page = 1;
        }
    }

    /**
     * Gets the total numbers of pages
     * @return float
     */
    private function amount()
    {
        return ceil($this->total / $this->limit);
    }
}
