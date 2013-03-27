<br/>
<div class="span12">
    <ul class="nav nav-tabs "  id="myTab">
        <li class="active"><a href="#latest">آخدث التقارير  <i class="icon-list"></i></a></li>
        <li><a href="#hot">تقارير مصورة <i class="icon-camera"></i></a></li>
    </ul>

    <div class="tab-content">

        <div class=" tab-pane active" id="latest">
            <table class=" table table-striped">

                <tbody>
                    <?php
                    if ($incidents_latest->count() == 0) {
                        ?>
                        <tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_reports'); ?></td></tr>
                        <?php
                    }
                    foreach ($incidents_latest as $incident) {
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
                            <td>
                                <a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>" class="fonty"> <?php echo html::specialchars($incident_title) ?></a>
                                <p></p><?php echo html::specialchars($incident_location) ?></p>
                            </td>
                            <td><?php echo $incident_date; ?></td>
                            <td><img  class="img-rounded" alt="<?php echo htmlentities($incident_title, ENT_QUOTES); ?>" src="<?php echo $incident_thumb; ?>" style="max-width:89px;max-height:59px;" /></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <a class="more" href="<?php echo url::site() . 'reports/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
        </div>
        <div class=" tab-pane" id="hot">
            <table class="table table-striped">

                <tbody>
                    <?php
                    if ($incidents_hot->count() == 0) {
                        ?>
                        <tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_reports'); ?></td></tr>
                        <?php
                    }
                    foreach ($incidents_hot as $incident) {
                        $incident_id = $incident->id;
                        $incident_title = text::limit_chars(strip_tags($incident->incident_title), 100, '...', True);
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
                            <td>
                                <a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>" class="fonty"> <?php echo html::specialchars($incident_title) ?></a>
                                <br /><?php echo html::specialchars($incident_location) ?>
                            </td>
                            <td><?php echo $incident_date; ?></td>
                            <td><img  class="img-rounded" alt="<?php echo htmlentities($incident_title, ENT_QUOTES); ?>" src="<?php echo $incident_thumb; ?>" style="max-width:89px;max-height:59px;" /></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            $('#myTab a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            })
        </script>

    </div>

</div>