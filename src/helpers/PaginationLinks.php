<?php


namespace app\helpers;

class PaginationLinks
{
    private int $current_page;
    private float|int $num_pages;
    private string $type;

    public function __construct(int $current_page, float|int $num_pages, string $type)
    {
        $this->current_page = $current_page;
        $this->num_pages = $num_pages;
        $this->type = $type;
    }

    public function generate_page_links(): string
    {
        $page_links = "";

        if($this->current_page > 1){
            $page_links .= '<a href="/api?type=' . $this->type . '&page=' . ($this->current_page - 1) . '" style="display:block; margin:0 15px; font-family:sans-serif;"><-</a>';
        } else {
            $page_links .= ' <-';
        }

        for ($i=1; $i <= $this->num_pages ; $i++) { 
            if($this->current_page == $i){
                $page_links .= ' ' . $i;
            } else {
                $page_links .= '<a href="/api?type=' . $this->type . '&page=' . $i . '" style="display:block; margin:0 15px; font-family:sans-serif;">' . $i .'</a>';
            }
    
        }

        // if this page is not the last page, generate the next link
        if($this->current_page < $this->num_pages){
            $page_links .= '<a href="/api?type=' . $this->type . '&page=' . ($this->current_page + 1) . '" style="display:block; margin:0 15px; font-family:sans-serif;">-></a>';
        } else {
            $page_links .= ' ->';
        }

        return $page_links;
    }

}

