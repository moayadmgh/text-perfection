<?php

namespace Moayadmgh\TextPerfection\Contracts;

interface ContentRewriter
{
    /**
     * Rewrite the content and return the rewritten version.
     *
     * @param string $content The content to be rewritten.
     * @return ContentRewriter object with The rewritten content as a property.
     */
    public function rewrite(string $content): self;
}