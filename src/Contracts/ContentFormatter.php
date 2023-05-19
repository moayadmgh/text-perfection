<?php

namespace Moayadmgh\TextPerfection\Contracts;

interface ContentFormatter
{

    /**
     * Format the text with appropriate headings and paragraphs.
     *
     * @param string $text
     * @return ContentFormatter object with the new text formatted property
     */
    public function format(string $text): self;
}