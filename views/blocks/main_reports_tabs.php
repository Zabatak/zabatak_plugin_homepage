<br/>
<div class="span8 report-tabs" >
    <ul class="nav nav-tabs "  id="myTab">
        <li class="active"><a href="#latest"><i class="icon-list"></i> <?php echo Kohana::lang('block_main.reports_latest'); ?>  </a></li>
        <li><a href="#hot"><i class="icon-camera"></i> <?php echo Kohana::lang('block_main.reports_hot'); ?> </a></li>
    </ul>

    <div class="tab-content">

        <div class=" tab-pane active" id="latest">
            <?php echo View::factory('report_list', array('incidents' => $incidents_latest))->render(); ?>    
        </div>
        <div class=" tab-pane" id="hot">
            <?php echo View::factory('report_list', array('incidents' => $incidents_hot))->render(); ?>  
        </div>

        <script>
            $('#myTab a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            })
        </script>

    </div>

</div>