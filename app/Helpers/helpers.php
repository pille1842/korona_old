<?php

function manual_link($target = '')
{
    $target = str_replace(' ', '_', $target);
    return '<a
        href="http://www.erixpage.de/koronawiki/index.php/' . $target . '"
        target="_blank"
        data-toggle="tooltip"
        data-placement="bottom"
        title="'.trans('app.manual_link').'">
        <i class="fa fa-question-circle" aria-hidden="true"></i>
        </a>';
}
