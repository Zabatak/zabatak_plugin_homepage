
<?php
if ($incidents->count() == 0) {
    echo Kohana::lang('ui_main.no_reports');
}
foreach ($incidents as $incident) {

    $incident_id = $incident->id;
    $incident_title = strip_tags($incident->incident_title);
    $incident_description = strip_tags($incident->incident_description);
    $incident_url = Incident_Model::get_url($incident_id);
    //$incident_category = $incident->incident_category;
    // Trim to 150 characters without cutting words
    // XXX: Perhaps delcare 150 as constant

    $incident_description = text::limit_chars(strip_tags($incident_description), 240, "...", true);
    $incident_date = date('H:i M d, Y', strtotime($incident->incident_date));
    $incident_shortdate = date('M d, Y', strtotime($incident->incident_date));
    //$incident_time = date('H:i', strtotime($incident->incident_date));
    $incident_verified = $incident->incident_verified;

    $comment_count = ORM::Factory('comment')->where('incident_id', $incident_id)->count_all();
    $category = ORM::Factory('category')->join('incident_category', 'category_id', 'category.id')
            ->where('incident_id', $incident_id)
            ->where('category_visible', 1)
            ->find();



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

        <?php
        echo View::factory('reports/report-summary', array(
            'incident_id' => $incident_id,
            //'incident_location' => $incident_location,
            'incident_title' => $incident_title,
            'incident_thumb' => $incident_thumb,
            'incident_date' => $incident_date,
            'comment_count' => $comment_count,
            'incident_url' => $incident_url,
            'incident_description' => $incident_description,
            'category' => $category,
            'incident_verified' => $incident->incident_verified,
                )
        )->render();
        ?>    
        <?php
    }
    ?>
<a class="more" href="<?php echo url::site() . 'reports/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
