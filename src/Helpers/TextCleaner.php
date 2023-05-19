<?php

namespace Moayadmgh\TextPerfection\Helpers;

class TextCleaner
{
    public static function clean(string $text): string
    {
        // Remove HTML tags
        $cleanedText = strip_tags($text);

        // Remove unwanted characters and symbols, including Unicode characters
        $cleanedText = preg_replace('/[^\p{L}\p{N}\s\p{L}\'\-.]/u', ' ', $cleanedText);

        // Convert special characters to HTML entities
        $cleanedText = htmlspecialchars($cleanedText, ENT_QUOTES, 'UTF-8');

        // Convert line breaks
        $cleanedText = preg_replace("/\n/", '<br/>', $cleanedText);

        // Trim extra spaces and line breaks
        return trim(preg_replace('/\s+/', ' ', $cleanedText));
    }
}