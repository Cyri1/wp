<?php 
function tm_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if (!$pages) {
        return;
    }
    echo '<nav aria-label="Pagination">';
    echo '<ul class="pagination pagination-sm mt-2">';
    foreach ($pages as $page) {
        $active = strpos($page, 'current') ? 'active' : '';
        echo '<li class="page-item ' . $active . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

function tm_comments_pagination()
{
    $pages = paginate_comments_links(['type' => 'array']);
    if (!$pages) {
        return;
    }
    echo '<nav aria-label="Pagination">';
    echo '<ul class="pagination pagination-sm mt-2">';
    foreach ($pages as $page) {
        $active = strpos($page, 'current') ? 'active' : '';
        echo '<li class="page-item ' . $active . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}

?>