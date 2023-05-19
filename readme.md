# TextPerfection Plugin

TextPerfection is a powerful content rewriting and enhancement plugin for **PHP** that helps you achieve text perfection.

With advanced algorithms and linguistic analysis, TextPerfection offers intelligent suggestions and optimizations to transform your written content into a refined and professional masterpiece. 

Elevate the quality of your text, enhance readability, and ensure impeccable grammar and structure with TextPerfection. 

Whether you're a writer, blogger, or content creator, TextPerfection empowers you to produce compelling and flawless text that captivates your audience and leaves a lasting impression. 

Experience the art of text perfection with this essential tool for every wordsmith and communicator

## Features

- Content analysis: Analyze text content and generate metrics such as word count, character count, unique words density, and average word length.
- Content rewriting: Rewrite text content using `OpenAI API`.
- Text formatting: Format text content generated from the `OpenAI API` response into HTML-compatible paragraphs, headings, and lists.

## Installation

Install the TextPerfection plugin using Composer:

```shell
composer require moayadmgh/text-perfection
```

## Usage

### - Full Usage

```php
use Moayadmgh\TextPerfection\TextPerfection;

$content = 'TextPerfection is a powerful text analysis and manipulation plugin for PHP. It provides various functionalities to analyze, format, and detect plagiarism in text content.';
$TextPerfectionObj = new TextPerfection($content);

$textPerfectionResult = $TextPerfectionObj->get();
```

the above code example will store the following response in the ``$textPerfectionResult`` variable

```php
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
```
It is also possible to access each functionality separately

### - Content Analysis

```php
use Moayadmgh\TextPerfection\ContentAnalyzer;

$content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

$analyzer = new ContentAnalyzer();
$result = $analyzer->analyze($content);

echo "Word Count: " . $result->getWordCount() . PHP_EOL;
echo "Character Count: " . $result->getCharacterCount() . PHP_EOL;
echo "Average Word Length: " . $result->getAverageWordLength() . PHP_EOL;
echo "UniqueWordCount: " . $result->getUniqueWordCount() . PHP_EOL;
echo "Sentences Count: " . $result->getSentencesCount() . PHP_EOL;
echo "Keyword Density: " . $result->getKeywordDensity() . PHP_EOL;
```

### - Content Rewriting

```php
use Moayadmgh\TextPerfection\ContentRewriter;

$content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

$rewriter = new ContentRewriter();
$rewriter->rewrite($content);
$rewrittenContent = $rewriter->getNewContent();

echo $rewrittenContent . PHP_EOL;
```

This new content will be rendered at first in the same format from the OpenAI API response

### - Content Reformatting

```php
use Moayadmgh\TextPerfection\TextFormatter;

$content = "# This is going to be H1\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit.\n\n- List item number 1\n- List item number 2";

$formatter = new TextFormatter();
$formatter->format($content);
$formattedContent = $formatter->getFormattedText();

echo $formattedContent . PHP_EOL;
```
## Configuration
The TextPerfection plugin can be configured by creating a `.env` file in the root of your project. Here's an example configuration:

```dotenv
OPENAI_API_KEY=__OPEN_AI_API_KEY__
OPENAI_ORGANIZATION=__OPEN_AI_ORGANIZATION_KEY__
```

Make sure to set the corresponding API keys in your environment variables or use the .env file.

## Contributing
Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.

## License
This plugin is open-source and released under the MIT License.