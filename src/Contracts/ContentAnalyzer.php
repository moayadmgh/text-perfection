<?php

namespace Moayadmgh\TextPerfection\Contracts;

interface ContentAnalyzer
{
    /**
     * Analyze the content and return the analysis results.
     *
     * @param string $content The content to be analyzed.
     * @return ContentAnalyzer The analysis results.
     */
    public function analyze(string $content): self;
}