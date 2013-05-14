<?php

/**
 * Links module for rah_sitemap.
 *
 * @author  Jukka Svahn
 * @license GNU GPLv2
 * @link    http://rahforum.biz/plugins/rah_sitemap_links
 *
 * Copyright (C) 2013 Jukka Svahn http://rahforum.biz
 * Licensed under GNU General Public License version 2
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

register_callback('rah_sitemap_links_urlset', 'rah_sitemap.urlset');

/**
 * Adds links to the sitemap.
 *
 * @param string $event
 * @param string $step
 * @param string $void
 * @param array  $urls
 */

function rah_sitemap_links_urlset($event, $step, $void, $urls)
{
	$local = str_replace(array('%', '_'), array('\\%', '\\_'), doSlash(hu));

	$rs = safe_rows_start(
		'url, date',
		'txp_link',
		"category = 'rah_sitemap' or url like '".$local."_%' or url like '/_%'"
	);

	if ($rs)
	{
		while ($a = nextRow($rs))
		{
			$urls[$a['url']] = $a['date'];
		}
	}
}