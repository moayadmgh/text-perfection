<?php

namespace Moayadmgh\TextPerfection\Traits;

use Dotenv\Dotenv;
use OpenAI;
use OpenAI\Client;

trait OpenAITrait
{
    private Client $openAI;
    private array $options;
    private string $promptPrefix;

    protected function initializeOpenAI(): void
    {
        // Load the environment variables from .env file
        $dotenv = Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();

        $apiKey = $_ENV['OPENAI_API_KEY'];
        $organization = $_ENV['OPENAI_ORGANIZATION'];
        $this->openAI = OpenAI::client($apiKey, $organization);
        $this->setDefaultOptions();
    }

    public function setModel(string $model): self
    {
        $this->options['model'] = $model;
        return $this;
    }

    public function setMaxTokens(int $maxTokens): self
    {
        $this->options['max_tokens'] = $maxTokens;
        return $this;
    }

    public function setTemperature(float $temperature): self
    {
        $this->options['temperature'] = $temperature;
        return $this;
    }

    public function setOption(string $name, $value): self
    {
        $this->options[$name] = $value;
        return $this;
    }

    public function setPromptPrefix(string $value): self
    {
        $this->promptPrefix = $value;
        return $this;
    }

    private function setDefaultOptions(): void
    {
        $this->options = [
            'model' => 'text-davinci-003',
            'max_tokens' => 500,
            'temperature' => 0.9,
        ];
    }

    private function buildOptions(string $content): array
    {
        return array_merge($this->options, [
            'prompt' => $this->promptPrefix . $content,
        ]);
    }

}