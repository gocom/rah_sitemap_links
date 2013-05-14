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

class rah_sitemap__links
{
	/**
	 * Constructor.
	 */

	public function __construct()
	{
		register_callback(array($this, 'urlset'), 'rah_sitemap.urlset');
	}

	/**
	 * Adds links to the sitemap.
	 */

	public function urlset()
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
				rah_sitemap::get()->url($a['url'], $a['date']);
			}
		}
	}
}

new rah_sitemap__links();