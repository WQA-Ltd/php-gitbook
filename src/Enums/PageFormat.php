<?php

namespace WQA\Gitbook\Enums;

class PageFormat
{
    const Document = 'document';
    const Markdown = 'markdown';

    public static function isValid(string $format): bool
    {
        return in_array($format, [
            self::Document,
            self::Markdown,
        ]);
    }
}
