<?php

namespace Moayadmgh\TextPerfection;

class TextPerfection
{
    private TextAnalyzer $textAnalyzer;
    private TextRewriter $textRewriter;
    private TextFormatter $textFormatter;
    private string $content;

    public function __construct(string $content)
    {
        $this->textAnalyzer = new TextAnalyzer();
        $this->textRewriter = new TextRewriter();
        $this->textFormatter = new TextFormatter();
        $this->content = $content;
    }

    public function process(): TextPerfection
    {
        $this->textAnalyzer = $this->analyzeContent();
        $this->textRewriter = $this->rewriteContent();
        $this->textFormatter = $this->formatText();
        return $this;
    }

    public function get(): array
    {
        return [
            'input_content' => $this->content,
            'text_analyzer' => [
                'word_count' => $this->textAnalyzer->getWordCount(),
                'unique_word_count' => $this->textAnalyzer->getUniqueWordCount(),
                'sentences_count' => $this->textAnalyzer->getSentencesCount(),
                'keyword_density' => $this->textAnalyzer->getKeywordDensity(),
                'average_word_length' => $this->textAnalyzer->getAverageWordLength(),
            ],
            'text_rewriter' => [
                'new_content' => $this->textRewriter->getNewContent(),
            ],
            'text_formatter' => [
                'formatted_content' => $this->textFormatter->getFormattedText(),
            ]
        ];
    }

    private function analyzeContent(): TextAnalyzer
    {
        return $this->textAnalyzer->analyze($this->content);
    }

    private function rewriteContent(): TextRewriter
    {
        return $this->textRewriter->rewrite($this->content);
    }

    private function formatText(): TextFormatter
    {
        return $this->textFormatter->format($this->textRewriter->getNewContent());
    }
}