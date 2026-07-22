<?php

namespace App\Helpers;

class HtmlSanitizer
{
    /**
     * Sanitasi HTML rich text untuk mencegah Stored XSS
     * sambil mempertahankan format teks (bold, italic, list, link, dsb).
     */
    public static function clean(?string $html): string
    {
        if (empty($html)) {
            return '';
        }

        // Tag HTML yang diperbolehkan untuk formatting compro
        $allowedTags = '<p><br><b><strong><i><em><ul><ol><li><a><h1><h2><h3><h4><h5><h6><img><iframe><blockquote><table><thead><tbody><tr><th><td><span><div>';

        // 1. Filter tag di luar daftar yang diperbolehkan
        $cleaned = strip_tags($html, $allowedTags);

        // 2. Hapus inline event handler (seperti onerror=, onload=, onclick=)
        $cleaned = preg_replace('/on[a-z]+\s*=\s*(?:["\'][^"\']*["\']|[^\s>]+)/i', '', $cleaned);

        // 3. Hapus skema javascript: di dalam atribut href/src
        $cleaned = preg_replace('/(href|src)\s*=\s*["\']?\s*javascript:[^"\'>]*["\']?/i', '$1="#"', $cleaned);

        return $cleaned;
    }
}
