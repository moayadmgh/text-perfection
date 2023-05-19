<?php

namespace Moayadmgh\TextPerfection\Testing;

use Moayadmgh\TextPerfection\TextFormatter;
use Moayadmgh\TextPerfection\TextRewriter;
use PHPUnit\Framework\TestCase;

class TextRewriterTest extends TestCase
{
    protected TextRewriter $textRewriter;

    protected function setUp(): void
    {
        // Create an instance of TextRewriter
        $this->textRewriter = new TextRewriter();
    }

    public function testRewrite(): void
    {
        // Sample content
        $content = "This is a sample content.";

        // Call the rewrite method with the sample content
        $this->textRewriter->rewrite($content);

        // Get the new content
        $newContent = $this->textRewriter->getNewContent();

        // Assert that the new content is not null
        $this->assertNotNull($newContent);

        // Assert that the new content is a string
        $this->assertIsString($newContent);

        // Assert that the new content is different from the original content
        $this->assertNotEquals($content, $newContent);
    }

    public function testRewriteWithEmptyContent(): void
    {
        // Call the rewrite method with an empty content
        $this->textRewriter->rewrite('');

        // Get the new content
        $newContent = $this->textRewriter->getNewContent();

        // Assert that the new content is null
        $this->assertEmpty($newContent);
    }

    public function testRewriteWithLongParagraphs(): void
    {
        // Content with long paragraphs
        $content = "This is a title for the following:\n\nThis is a sample content with long paragraphs.\n\n" .
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur gravida, " .
            "mauris in pulvinar tristique, nisl ex varius est, sit amet consequat diam " .
            "felis id nunc. Nullam condimentum tortor nec velit consequat, in ultricies " .
            "nisi auctor. Morbi vitae nunc nec purus pulvinar egestas. Proin auctor luctus " .
            "risus, non sollicitudin mauris fringilla eu. Sed posuere, arcu eget feugiat " .
            "eleifend, odio ligula aliquam sem, et iaculis ex dui ut nunc.\n\n" .
            "Sed posuere, arcu eget feugiat eleifend, odio ligula aliquam sem, et iaculis " .
            "ex dui ut nunc. In et venenatis sem, in dapibus dolor. Mauris at purus arcu. " .
            "In elementum felis sed ligula lacinia, id finibus nunc vestibulum. Nullam " .
            "sed fringilla tellus. Nulla a pharetra dui. Vestibulum vulputate nisi quis " .
            "vehicula tincidunt. Duis vel nunc eu nunc feugiat volutpat.\n\n" .
            "Etiam facilisis urna sed mi faucibus, id volutpat nisi aliquet. In " .
            "hac habitasse platea dictumst. Nunc ut ex vitae lectus egestas condimentum. " .
            "Aenean egestas mauris odio, nec semper sem luctus a. Vivamus id volutpat " .
            "nulla, id tempus nibh.";

        // Call the rewrite method with the content
        $this->textRewriter->rewrite($content);

        // Get the new content
        $newContent = $this->textRewriter->getNewContent();

        // Assert that the new content is not null
        $this->assertNotNull($newContent);

        // Assert that the new content is a string
        $this->assertIsString($newContent);

        // Assert that the new content is different from the original content
        $this->assertNotEquals($content, $newContent);

        $TextFormatter = new TextFormatter();
        $TextFormatter->format($newContent);
        $newContent = $TextFormatter->getFormattedText();

        // Assert that the new content contains paragraphs
        $this->assertStringContainsString('<p>', $newContent);
        $this->assertStringContainsString('</p>', $newContent);

        // Assert that the new content contains headings
        $this->assertStringContainsString('<h1>', $newContent);
        $this->assertStringContainsString('</h1>', $newContent);
        $this->assertStringContainsString('<h2>', $newContent);
        $this->assertStringContainsString('</h2>', $newContent);

        // Assert that the new content contains bullet lists
        $this->assertStringContainsString('<ul>', $newContent);
        $this->assertStringContainsString('</ul>', $newContent);
        $this->assertStringContainsString('<li>', $newContent);
        $this->assertStringContainsString('</li>', $newContent);
    }

    public function testGetNewContentBeforeRewrite(): void
    {
        // Call the getNewContent method before calling the rewrite method
        $newContent = $this->textRewriter->getNewContent();

        // Assert that the new content is null
        $this->assertEmpty($newContent);
    }

    public function testGetNewContentAfterMultipleRewrites(): void
    {
        // Content that requires multiple rewrites
        $content = 'This is some content that needs to be rewritten.';

        // Call the rewrite method multiple times with the same content
        $this->textRewriter->rewrite($content);
        $this->textRewriter->rewrite($content);
        $this->textRewriter->rewrite($content);

        // Get the new content
        $newContent = $this->textRewriter->getNewContent();

        // Assert that the new content is not null
        $this->assertNotNull($newContent);

        // Assert that the new content is different from the original content
        $this->assertNotEquals($content, $newContent);
    }

    public function testRewriteWithLongContent(): void
    {
        // Long content that requires rewriting
        $content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non augue id sapien finibus tincidunt. Sed efficitur, lacus ut porttitor sagittis, mi leo vulputate mi, sit amet ultrices ex dui ac risus. In hac habitasse platea dictumst.';

        // Call the rewrite method with the long content
        $this->textRewriter->rewrite($content);

        // Get the new content
        $newContent = $this->textRewriter->getNewContent();

        // Assert that the new content is not null
        $this->assertNotNull($newContent);

        // Assert that the new content is different from the original content
        $this->assertNotEquals($content, $newContent);
    }
}