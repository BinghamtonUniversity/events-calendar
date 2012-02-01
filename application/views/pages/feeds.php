<div style="margin-top: 20px;">
    <h3 style="margin-bottom: 5px;">Add a New Feed</h3>
    <?php
        echo Form::open('feed/create');
        echo '<label>Feed Title:</label>  ';
        echo Form::input('feed_title');
        echo Form::close();
    ?>
    <h3 style="margin-top: 20px;">Current Feeds</h3>
    <ul>
    <?php
        foreach ($feeds as $feed) {
            echo sprintf('<li>%s (%s events) [<a href="%s">edit</a>] [<a href="%s">delete</a>] [<a href="%s">view as JSON</a>]</li>',
                $feed->title,
				count($feed->events->find_all()->as_array()),
                URL::site('feed/edit/'.$feed->id),
                URL::site('feed/delete/'.$feed->id),
                URL::site('feed/json/'.$feed->id)
            );
        }
    ?>
    </ul>

</div>
