<?php

/*
 * rah_sitemap_links - Links module for rah_sitemap
 * https://github.com/gocom/rah_sitemap_links
 *
 * Copyright (C) 2022 Jukka Svahn
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

/**
 * Plugin class.
 */
final class Rah_Sitemap_Links
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        register_callback([$this, 'register'], 'rah_sitemap.sitemaps');
    }

    /**
     * Adds links to the sitemap index.
     *
     * @param string $event
     * @param string $step
     * @param string $void
     * @param array $sitemaps
     */
    public function register($event, $step, $void, &$sitemaps): void
    {
        $sitemaps[] = new Rah_Sitemap_Links_Record_LinkRecord();
    }
}
