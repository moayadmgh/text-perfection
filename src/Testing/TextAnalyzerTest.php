<?php

namespace Moayadmgh\TextPerfection\Testing;

use Moayadmgh\TextPerfection\TextAnalyzer;
use PHPUnit\Framework\TestCase;

class TextAnalyzerTest extends TestCase
{
    private TextAnalyzer $textAnalyzer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->textAnalyzer = new TextAnalyzer();
    }

    public function testEmptyContent(): void
    {
        $content = "";
        $this->textAnalyzer->analyze($content);
        $this->assertEquals(0, $this->textAnalyzer->getWordCount());
        $this->assertEquals(0, $this->textAnalyzer->getSentencesCount());
        $this->assertEquals(0, $this->textAnalyzer->getAverageWordLength());
        $this->assertEquals([], $this->textAnalyzer->getKeywordDensity());
        $this->assertEquals(0, $this->textAnalyzer->getUniqueWordCount());
    }

    public function testWordCount(): void
    {
        $content = "This is a sample text.";
        $this->textAnalyzer->analyze($content);
        $this->assertEquals(5, $this->textAnalyzer->getWordCount());
    }

    public function testSentencesCount(): void
    {
        $content = "This is a sample sentence. This is another sentence.";
        $this->textAnalyzer->analyze($content);
        $this->assertEquals(2, $this->textAnalyzer->getSentencesCount());
        echo $this->textAnalyzer->getSentencesCount();
    }

    public function testAverageWordLength(): void
    {
        $content = "This is a sample text.";
        $this->textAnalyzer->analyze($content);
        $this->assertEquals(3.4, $this->textAnalyzer->getAverageWordLength());
    }

    public function testUniqueWordCountLowerAndUpperCase(): void
    {
        $content = "This is a sample text with duplicate words. Sample text.";
        $this->textAnalyzer->analyze($content);
        $this->assertEquals(9, $this->textAnalyzer->getUniqueWordCount());
    }

    public function testUniqueWordCountSameCase(): void
    {
        $content = "this is a sample text with duplicate words. sample text.";
        $this->textAnalyzer->analyze($content);
        $this->assertEquals(8, $this->textAnalyzer->getUniqueWordCount());
    }

    public function testKeywordDensityLowerAndUpperCase(): void
    {
        $content = "This is a sample text with keyword density lower AND upper Text.";
        $this->textAnalyzer->analyze($content);
        $keywordDensity = $this->textAnalyzer->getKeywordDensity();
        $expectedDensity = [
            urlencode('This') => 8.33,
            urlencode('is') => 8.33,
            urlencode('a') => 8.33,
            urlencode('sample') => 8.33,
            urlencode('text') => 8.33,
            urlencode('with') => 8.33,
            urlencode('keyword') => 8.33,
            urlencode('density') => 8.33,
            urlencode('lower') => 8.33,
            urlencode('AND') => 8.33,
            urlencode('upper') => 8.33,
            urlencode('Text') => 8.33,
        ];
        $this->assertEquals($expectedDensity, $keywordDensity);
    }

    public function testKeywordDensitySameCase(): void
    {
        $content = "this is a sample text with keyword density. same text case";
        $this->textAnalyzer->analyze($content);
        $keywordDensity = $this->textAnalyzer->getKeywordDensity();
        $expectedDensity = [
            urlencode('this') => 9.09,
            urlencode('is') => 9.09,
            urlencode('a') => 9.09,
            urlencode('sample') => 9.09,
            urlencode('text') => 18.18,
            urlencode('with') => 9.09,
            urlencode('keyword') => 9.09,
            urlencode('density') => 9.09,
            urlencode('same') => 9.09,
            urlencode('case') => 9.09,
        ];
        $this->assertEquals($expectedDensity, $keywordDensity);
    }
}