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
 * Links.
 */
// phpcs:ignore
class Rah_Sitemap_Links_Record_LinkRecord extends Rah_Sitemap_Record_AbstractRecord implements Rah_Sitemap_RecordInterface
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'link';
    }

    /**
     * {@inheritdoc}
     */
    public function getPages(): int
    {
        $items = (int) safe_count(
            'txp_link',
            $this->getWhereStatement()
        );

        return $this->countPages($items);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrls(int $page): array
    {
        $urls = [];

        $rs = safe_rows_start(
            'url, unix_timestamp(date) as posted',
            'txp_link',
            sprintf(
                '%s order by date asc limit %s, %s',
                $this->getWhereStatement(),
                $this->getOffset($page),
                $this->getLimit()
            )
        );

        if ($rs) {
            while ($a = nextRow($rs)) {
                $urls[] = new Rah_Sitemap_Url(
                    $a['url'],
                    (int) $a['posted']
                );
            }
        }

        return $urls;
    }

    /**
     * Gets SQL where statement.
     *
     * @return string
     */
    private function getWhereStatement(): string
    {
        $local = str_replace(
            ['%', '_'],
            ['\\%', '\\_'],
            doSlash(hu)
        );

        return "category = 'rah_sitemap' or url like '".$local."_%' or url like '/_%'";
    }
}
