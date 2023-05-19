<?php

namespace Moayadmgh\TextPerfection;

use Moayadmgh\TextPerfection\Contracts\ContentFormatter;
use Moayadmgh\TextPerfection\Helpers\TextCleaner;

class TextFormatter implements ContentFormatter
{
    private string $formattedText;

    public function __construct()
    {
        $this->formattedText = '';
    }

    public function format(string $text): TextFormatter
    {
        if ($text !== '') {
            $this->generateFormattedContent($text);
        }
        return $this;
    }

    public function getFormattedText(): string
    {
        return $this->formattedText;
    }

    private function generateFormattedContent(string $generatedText): void
    {
        $formattedContent = '';

        // Split the generated text into paragraphs
        $paragraphs = preg_split('/\R{2,}/u', $generatedText);

        foreach ($paragraphs as $paragraph) {
            $formattedContent .= $this->formatParagraph($paragraph);
        }


        $this->formattedText = $formattedContent;
    }

    private function formatParagraph(string $paragraph): string
    {
        // Remove leading and trailing whitespaces
        $paragraph = trim($paragraph);

        if ($this->startsWith($paragraph, '#')) {
            // Format headings
            $headingLevel = $this->getHeadingLevel($paragraph);
            $headingText = $this->extractHeadingText($paragraph);

            return "<h$headingLevel>$headingText</h$headingLevel>";
        }

        if ($this->startsWith($paragraph, '-')) {
            // Format lists
            $lines = explode("\n", $paragraph);
            $listItems = array_map(function ($line) {
                $listItemContent = $this->trimListItem($line);
                return "<li>$listItemContent</li>";
            }, $lines);

            return "<ul>" . implode("", $listItems) . "</ul>";

        } else {
            // Format regular paragraphs
            // Clean and sanitize the paragraph content
            $sanitizedContent = TextCleaner::clean($paragraph);

            return "<p>$sanitizedContent</p>";
        }
    }

    private function startsWith(string $haystack, string $needle): bool
    {
        return str_starts_with($haystack, $needle);
    }

    private function getHeadingLevel(string $heading): int
    {
        return min(substr_count($heading, '#'), 6);
    }

    private function extractHeadingText(string $heading): string
    {
        return strtok(trim($heading, "# \t\n\r\0\x0B"), "\n");
    }

    private function trimListItem(string $line): string
    {
        return trim(substr($line, strpos($line, '-') + 1));
    }
}