<?php

function btn_edit($uri)
{
    return anchor($uri, '<span class="glyphicon glyphicon-edit"></span>');
}
function btn_delete($uri)
{
    return anchor($uri, '<span class="glyphicon glyphicon-remove"></span>', array('onclick'=>"return confirm('Are you sure you want to delete. This can not be undone');"));
}