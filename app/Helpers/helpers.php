<?php

function manual_link($target = '')
{
    $target = str_replace(' ', '_', $target);
    return '<a href="http://www.erixpage.de/koronawiki/index.php/' . $target . '" target="_blank">
        <i class="fa fa-question-circle" aria-hidden="true"></i>
        </a>';
}
