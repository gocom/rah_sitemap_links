<?php

/*
 * rah_sitemap_links - Links module for rah_sitemap
 * https://github.com/gocom/rah_sitemap_links
 *
 * Copyright (C) 2014 Jukka Svahn
 *
 * This file is part of rah_sitemap_links.
 *
 * rah_sitemap_links is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2.
 *
 * rah_sitemap_links is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with rah_sitemap_links. If not, see <http://www.gnu.org/licenses/>.
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

    if ($rs) {
        while ($a = nextRow($rs)) {
            $urls[$a['url']] = $a['date'];
        }
    }
}
