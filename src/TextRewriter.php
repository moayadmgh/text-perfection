<?php

namespace Moayadmgh\TextPerfection;

use Moayadmgh\TextPerfection\Contracts\ContentRewriter;
use Moayadmgh\TextPerfection\Traits\OpenAITrait;

class TextRewriter implements ContentRewriter
{
    use OpenAITrait;

    private string $newContent;

    public function __construct()
    {
        $this->newContent = '';
        $this->promptPrefix = "Refactor the following in a well formatted shape like article that contains heading, paragraphs, and bullet lists (be creative): \n\n";
    }

    public function rewrite(string $content): TextRewriter
    {
        if ($content !== '') {
            $this->initializeOpenAI();
            $response = $this->openAI->completions()->create($this->buildOptions($content));
            $this->newContent = $response['choices'][0]['text'] ?? $this->newContent;
        }
        return $this;
    }

    public function getNewContent(): ?string
    {
        return $this->newContent;
    }
}