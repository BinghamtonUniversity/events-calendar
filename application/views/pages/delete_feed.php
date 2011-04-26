<div style="margin-top: 20px;">
<?php
    echo sprintf('Are you sure you want to delete the <strong>%s</strong> feed?',
        $feed->title
    );
    echo sprintf('<a href="%s">Yes</a>',
        URL::site('feed/confirm_delete/'.$feed->id)
    );
    echo sprintf('<a href="%s">No</a>',
        URL::site('feed')
    );
?>
</div>
