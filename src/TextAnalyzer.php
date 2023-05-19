<?php

namespace Moayadmgh\TextPerfection;

use Moayadmgh\TextPerfection\Contracts\ContentAnalyzer;
use Moayadmgh\TextPerfection\Helpers\TextCleaner;

class TextAnalyzer implements ContentAnalyzer
{
    private int $wordCount;
    private int $sentenceCount;
    private float $averageWordLength;
    private int $uniqueWordCount;
    private array $keywordDensity;
    private string $content;
    private string $cleanedText;
    private array $textWords;
    private array $textSentences;

    public function analyze(string $content): TextAnalyzer
    {
        return $this->setContent($content)
            ->cleanText()
            ->splitTextToWords()
            ->splitTextToSentences()
            ->countWords()
            ->countSentences()
            ->calculateAverageWordLength()
            ->countUniqueWords()
            ->calculateKeywordDensity();
    }

    public function getWordCount(): int
    {
        return $this->wordCount;
    }

    public function getSentencesCount(): int
    {
        return $this->sentenceCount;
    }

    public function getAverageWordLength(): float
    {
        return $this->averageWordLength;
    }

    public function getUniqueWordCount(): int
    {
        return $this->uniqueWordCount;
    }

    public function getKeywordDensity(): array
    {
        return $this->keywordDensity;
    }

    private function setContent(string $content): TextAnalyzer
    {
        $this->content = $content;
        return $this;
    }

    private function cleanText(): TextAnalyzer
    {
        $this->cleanedText = TextCleaner::clean($this->content);
        return $this;
    }

    private function splitTextToWords(): TextAnalyzer
    {
        $this->textWords = preg_split('/[^\w]+/', $this->cleanedText, -1, PREG_SPLIT_NO_EMPTY);
        return $this;
    }

    private function splitTextToSentences(): TextAnalyzer
    {
        $this->textSentences = preg_split('/[.!?]+/', $this->cleanedText, -1, PREG_SPLIT_NO_EMPTY);
        return $this;
    }

    private function countWords(): TextAnalyzer
    {
        $this->wordCount = count($this->textWords);
        return $this;
    }

    private function countSentences(): TextAnalyzer
    {
        $this->sentenceCount = count($this->textSentences);
        return $this;
    }

    private function calculateAverageWordLength(): TextAnalyzer
    {
        $wordCount = count($this->textWords);

        $totalWordLength = array_reduce($this->textWords, function ($carry, $word) {
            return $carry + mb_strlen(preg_replace('/[^a-zA-Z0-9]+/', '', $word));
        }, 0);

        $this->averageWordLength = 0.0;
        if ($wordCount > 0) {
            $this->averageWordLength = round($totalWordLength / $wordCount, 2);
        }
        return $this;
    }

    private function countUniqueWords(): TextAnalyzer
    {
        $uniqueWords = array_count_values($this->textWords);
        $this->uniqueWordCount = count($uniqueWords);

        return $this;
    }

    private function calculateKeywordDensity(): TextAnalyzer
    {
        $wordCount = count($this->textWords);
        $uniqueWords = array_count_values($this->textWords);
        $this->keywordDensity = [];

        foreach ($uniqueWords as $word => $count) {
            $density = ($count / $wordCount) * 100;
            $this->keywordDensity[urlencode($word)] = round($density, 2);
        }
        return $this;
    }
}