<?php

namespace core\helpers;

class Paginator
{
    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;
    private $_row_start;

    public function __construct($conn, $query)
    {
        $this->_conn = $conn;
        $this->_query = $query;

        $rs = $this->_conn->query($this->_query);
        $this->_total = $rs->num_rows; // total numbers of rows
    }

    //LIMIT DATA
    //all it does is limits the data returned and returns everything as $result object
    public function getData($limit = 10, $page = 1)
    {
        $this->_limit == 'all';
        $this->_page = $page;

        if($this->_limit == 'all') {
            $query = $this->_query;
        }
        else {
            //create the query,limiting records from page to limit
            $this->_row_start = (($this->_page - 1) * $this->_limit);
            $query = $this->_query .
                    //add to original query: (minus one because of the way the SQL works)
                    " LIMIT {$this->_row_start}, $this->_limit";
        }
        //echo $query;die;

        $rs = $this->_conn->query($query) or die($this->_conn->error);

        while($row = $rs->fetch_assoc()) {
            $results[] = $row;
        }

        //print_r($results);die();

        //return data as object, new stdClass() creates new empty object
        $result = new \stdClass();
        $result->page = $this->_page;
        $result->limit = $this->_limit;
        $result->total = $this->_total;
        $result->data = $results;

        //print_r($result);die;
        return $result;
    }

    public function createLinks($links, $list_class)
    {
        //returns empty result string, no links necessary
        if($this->_limit == 'all') {
            return '';
        }

        //get the last page number
        $last = ceil($this->_total / $this->_limit);

        //calculate start of range for link printing
        $start = (($this->_page - $links) > 0) ? $this->_page - $links : 1;

        //calculate end of range for link printing
        $end = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        //debugging
        echo '$total:' . $this->_total .' | '; //total rows
        echo '$row_start:' . $this->_row_start . ' | ';
        echo '$limit:' . $this->_limit . ' | ';
        echo '$start:' . $start . ' | ';
        echo '$end:' . $end . ' | ';
        echo '$last:' . $last . ' | ';
        echo '$page:' . $this->_page . ' | ';
        echo '$links:' . $links . ' <br /> ';

        //ul bootstrap class - "pagination pagination-sm"
        $html = '<ul class="'. $list_class .'">';

        $class = ($this->_page == 1) ? "disabled" : ""; //disable prev page link

        $previous_page = ($this->_page == 1) ?
            '<a href=""><li class="'. $class .'">&laquo;</a></li>' :
            '<li class="'. $class .'"><a href="?limit='. $this->_limit .' &page='. ($this->_page - 1) .'">&laquo;</a></li>';

        $html .= $previous_page;

        if($start > 1) {
            $html .= '<li><a href="?limit='. $this->_limit .' &page=1">1</a></li>';
            $html .= '<li class="disabled"><span>...</span></li>';
        }

        //print all numbers page links
        for ($i = $start; $i <= $end; $i++) {
            $class = ($this->_page == $i) ? "active" : "";
            $html .= '<li class="'. $class .'"><a href="?limit='. $this->_limit .'&page='. $i .'"></a></li>';
        }

        if($end < $last) {
            $html .= '<li class="disabled"><span>...</span></li>';
            $html .= '<li><a href="?limit='. $this->_limit .'&page='. $last .'">'. $last .'</a></li>';
        }

        $class = ($this->_page == $last) ? "disabled" : "";

//        $this->_page + 1 = nextpage (>>> link)
        $next_page = ($this->_page == $last) ?
            '<li class="'. $class .'"><a href="">&raquo;</a></li>':
            '<li class="'. $class .'"><a href="?limit='. $$this->_limit .'&page='. ($this->_page + 1) .'"></a></li>';

        $html .= $next_page;
        $html .= '</ul>';

        return $html;
    }
}