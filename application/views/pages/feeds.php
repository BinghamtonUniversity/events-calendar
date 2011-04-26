<div style="margin-top: 20px;">
    <h3>Current Feeds</h3>
    <ul>
<?php
    foreach ($feeds as $feed) {
        echo "<li>{$feed->title}</li>";
    }
?>
    </ul>
</div>
