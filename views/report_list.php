<table class=" table table-striped">

    <tbody>
        <?php
        if ($incidents->count() == 0) {
            ?>
            <tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_reports'); ?></td></tr>
            <?php
        }
        foreach ($incidents as $incident) {
            $incident_id = $incident->id;
            $incident_title = text::limit_chars(strip_tags($incident->incident_title), 40, '...', True);
            $incident_date = $incident->incident_date;
            $incident_date = date('M j Y', strtotime($incident->incident_date));
            $incident_location = $incident->location->location_name;
            $incident_thumb = url::file_loc('img') . "media/img/report-thumb-default.jpg";
            $media = ORM::Factory('media')->where('incident_id', $incident_id)->find_all();
            if ($media->count()) {
                foreach ($media as $photo) {
                    if ($photo->media_thumb) { // Get the first thumb
                        $incident_thumb = url::convert_uploaded_to_abs($photo->media_thumb);
                        break;
                    }
                }
            }
            ?>

            <tr>
                <?php
                echo View::factory('report-summary', array(
                    'incident_id' => $incident_id,
                    'incident_location' => $incident_location,
                    'incident_title' => $incident_title,
                    'incident_thumb' => $incident_thumb,
                    'incident_date' => $incident_date,
                        )
                )->render();
                ?>    
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<a class="more" href="<?php echo url::site() . 'reports/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
