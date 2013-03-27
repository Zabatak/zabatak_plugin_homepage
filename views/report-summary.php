<td>
    <a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>" class="fonty"> 
        <?php echo html::specialchars($incident_title) ?>
    </a>
    <p><?php echo html::specialchars($incident_location) ?></p>
</td>
<td><?php echo $incident_date; ?></td>
<td><img  class="img-polaroid" alt="<?php echo htmlentities($incident_title, ENT_QUOTES); ?>" src="<?php echo $incident_thumb; ?>" style="max-width:89px;max-height:59px;" /></td>
