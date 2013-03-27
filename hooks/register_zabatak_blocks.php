<?php

defined('SYSPATH') or die('No direct script access.');

class reports_z_block {

    public function __construct() {
        $block = array(
            "classname" => "reports_z_block",
            "name" => "Reports Tabs",
            "description" => "List the 10 latest reports in the system"
        );

        blocks::register($block);
    }

    public function block() {
        $content = new View('blocks/main_reports_tabs');

        // Get Reports
        $content->incidents_latest = ORM::factory('incident')
                ->with('location')
                ->where('incident_active', '1')
                ->limit('10')
                ->orderby('incident_date', 'desc')
                ->find_all();
        $r = 'select incident_id from (
          SELECT incident_id , count(incident_id) cc FROM
          media group by incident_id   order by cc desc)  dd
          ';

        $content->incidents_hot = ORM::factory('incident')
                ->with('location')
                ->where('incident_active', '1')
                ->in('incident.id', $r)
                ->limit('10')
                ->orderby('incident_date', 'desc')
                ->find_all();

        echo $content;
    }

}

new reports_z_block;


class Featured_News {

	public function __construct()
	{
		$block = array(
			"classname" => "Featured_News",
			"name" => "Feaured news",
			"description" => "List the 10 latest news items from available news feeds"
		);

		blocks::register($block);
	}

	public function block()
	{   
                $page_id = 3;
		$content = new View('blocks/featured_news');
		$page = ORM::factory('page',$page_id)->find($page_id);
		if ($page->loaded)
		{

			$page_title = $page->page_title;
			$page_description = $page->page_description;
                        
			$content->page_title = $page_title;
			$content->page_description = text::limit_chars($page_description, 800, '...', True);
			
		}
		

		echo $content;
	}
}

new Featured_News;