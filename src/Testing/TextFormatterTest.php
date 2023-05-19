<?php

namespace Moayadmgh\TextPerfection\Testing;

use Moayadmgh\TextPerfection\TextFormatter;
use PHPUnit\Framework\TestCase;

class TextFormatterTest extends TestCase
{
    private TextFormatter $textFormatter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->textFormatter = new TextFormatter();
    }

    public function testFormatRegularParagraph(): void
    {
        $text = 'This is a regular paragraph.';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<p>This is a regular paragraph.</p>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatHeadingLevel1(): void
    {
        $text = '# Heading 1';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<h1>Heading 1</h1>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatHeadingLevel2(): void
    {
        $text = '## Heading 2';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<h2>Heading 2</h2>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatHeadingLevel3(): void
    {
        $text = '### Heading 3';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<h3>Heading 3</h3>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatHeadingLevel4(): void
    {
        $text = '#### Heading 4';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<h4>Heading 4</h4>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatHeadingLevel5(): void
    {
        $text = '##### Heading 5';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<h5>Heading 5</h5>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatHeadingLevel6(): void
    {
        $text = '###### Heading 6';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<h6>Heading 6</h6>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatList(): void
    {
        $text = "- Item 1\n- Item 2\n- Item 3";

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<ul><li>Item 1</li><li>Item 2</li><li>Item 3</li></ul>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatEmptyText(): void
    {
        $text = '';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatParagraphWithLeadingAndTrailingSpaces(): void
    {
        $text = '   This is a paragraph with leading and trailing spaces.   ';

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<p>This is a paragraph with leading and trailing spaces.</p>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatParagraphWithLineBreaks(): void
    {
        $text = "This is a paragraph\nwith line breaks.";

        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<p>This is a paragraph<br/>with line breaks.</p>';
        $this->assertSame($expectedResult, $formattedText);
    }

    public function testFormatLongText(): void
    {
        $text = "# This is the H1:\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium alias blanditiis dolore dolores earum error excepturi fuga fugit molestiae repudiandae.\n\n## This is the H2:\n\n- Lorem ipsum dolor sit amet\n- Consectetur adipisicing elit\n- Accusantium alias blanditiis dolore\n- Ipsum consectetur adipisicing\n\n## This is the H2:\n\n- Adipisci aliquid recusandae similique totam? Maiores, reiciendis.\n- aliquid recusandae similique totam\n- similique totam? Maiores, reiciendis\n\n### This is the H3: \n\n- Ipsum consectetur adipisicing";
        $formattedText = $this->textFormatter->format($text)->getFormattedText();

        $expectedResult = '<h1>This is the H1:</h1><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium alias blanditiis dolore dolores earum error excepturi fuga fugit molestiae repudiandae.</p><h2>This is the H2:</h2><ul><li>Lorem ipsum dolor sit amet</li><li>Consectetur adipisicing elit</li><li>Accusantium alias blanditiis dolore</li><li>Ipsum consectetur adipisicing</li></ul><h2>This is the H2:</h2><ul><li>Adipisci aliquid recusandae similique totam? Maiores, reiciendis.</li><li>aliquid recusandae similique totam</li><li>similique totam? Maiores, reiciendis</li></ul><h3>This is the H3:</h3><ul><li>Ipsum consectetur adipisicing</li></ul>';
        $this->assertSame($expectedResult, $formattedText);
    }

}
