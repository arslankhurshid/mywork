<?php

echo get_ol($pages);

//echo "<pre>";
//print_r($pages);
//echo "</pre>";
//
//foreach ($pages as $page) {
////    echo "<pre>";
////print_r($page);
////echo "</pre>";
//}
//exit();

function get_ol($array, $child = false) {
    $str = '';
    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $items) {

            foreach ($items as $item) {
                echo "<pre>";
                print_r($item);
                echo "</pre>";
//                    exit();
                $str .= '<li id="list_' . $item['id'] . '">';
                $str .= '<li id="list_' . $item['title'] . '">';
                // if have children
                if (isset($item['children']) && count($item['children'])) {
                    $str .= get_ol($item['children'], TRUE);
                }
                $str .= '</li>' . PHP_EOL;
            }
        }
        $str .= '</ol>' . PHP_EOL;
    }
    return $str;
}
