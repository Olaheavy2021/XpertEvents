<?php

class Pagination {

    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($page=1, $per_page=20, $total_count=0) {
        $this->current_page = (int) $page;
        $this->per_page = (int) $per_page;
        $this->total_count = (int) $total_count;
    }

    /**
     * @return int
     */
    public function offset(): int
    {
        return $this->per_page * ($this->current_page - 1);
    }

    /**
     * @return int
     */
    public function totalPages(): int
    {
        return ceil($this->total_count / $this->per_page);
    }

    public function previousPage()
    {
        $prev = $this->current_page - 1;
        return ($prev > 0) ? $prev : false;
    }

    public function nextPage()
    {
        $next = $this->current_page + 1;
        return ($next <= $this->totalPages()) ? $next : false;
    }

    /**
     * @param string $url
     * @return string
     */
    public function previousLink(string $url=""): string
    {
        $link = "";
        if($this->previousPage()) {
            $link .= "<a href=\"{$url}?page={$this->previousPage()}\">";
            $link .= "&laquo; Previous</a>";
        }
        return $link;
    }

    /**
     * @param string $url
     * @return string
     */
    public function nextLink(string $url=""): string
    {
        $link = "";
        if($this->nextPage()) {
            $link .= "<a href=\"{$url}?page={$this->nextPage()}\">";
            $link .= "Next &raquo;</a>";
        }
        return $link;
    }

    /**
     * @param string $url
     * @return string
     */
    public function numberLinks(string $url=""): string
    {
        $output = "";
        for($i=1; $i <= $this->totalPages(); $i++) {
            if($i == $this->current_page) {
                $output .= "<span class=\"selected\">{$i}</span>";
            } else {
                $output .= "<a href=\"{$url}?page={$i}\">{$i}</a>";
            }
        }
        return $output;
    }

    public function pageLinks($url): string
    {
        $output = "";
        if($this->totalPages() > 1) {
            $output .= "<div class=\"pagination\">";
            $output .= $this->previousLink($url);
            $output .= $this->numberLinks($url);
            $output .= $this->nextLink($url);
            $output .= "</div>";
        }
        return $output;
    }
}
