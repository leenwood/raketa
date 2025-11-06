<?php

declare(strict_types=1);

namespace Raketa\BackendTestTask\Presentation\Http\Response;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class JsonResponse
{
    private array $headers = ['Content-Type' => ['application/json; charset=utf-8']];
    private string $body;
    private int $statusCode;

    public function __construct(array $data, int $statusCode = 200)
    {
        $this->body = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $this->statusCode = $statusCode;
    }

    public function getProtocolVersion(): string
    {
        return '1.1';
    }

    public function withProtocolVersion($version): ResponseInterface
    {
        $clone = clone $this;
        return $clone;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function hasHeader($name): bool
    {
        return isset($this->headers[$name]);
    }

    public function getHeader($name): array
    {
        return $this->headers[$name] ?? [];
    }

    public function getHeaderLine($name): string
    {
        return implode(', ', $this->getHeader($name));
    }

    public function withHeader($name, $value): ResponseInterface
    {
        $clone = clone $this;
        $clone->headers[$name] = (array)$value;
        return $clone;
    }

    public function withAddedHeader($name, $value): ResponseInterface
    {
        $clone = clone $this;
        $clone->headers[$name][] = $value;
        return $clone;
    }

    public function withoutHeader($name): ResponseInterface
    {
        $clone = clone $this;
        unset($clone->headers[$name]);
        return $clone;
    }

    public function getBody(): StreamInterface
    {
        return new class($this->body) implements StreamInterface {
            public function __construct(private string $content) {}

            public function __toString(): string { return $this->content; }
            public function close(): void {}
            public function detach() {}
            public function getSize(): ?int { return strlen($this->content); }
            public function tell(): int { return 0; }
            public function eof(): bool { return true; }
            public function isSeekable(): bool { return false; }
            public function seek($offset, $whence = SEEK_SET): void {}
            public function rewind(): void {}
            public function isWritable(): bool { return false; }
            public function write($string): int { return 0; }
            public function isReadable(): bool { return true; }
            public function read($length): string { return $this->content; }
            public function getContents(): string { return $this->content; }
            public function getMetadata($key = null): array|string|null { return null; }
        };
    }

    public function withBody(StreamInterface $body): ResponseInterface
    {
        $clone = clone $this;
        return $clone;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function withStatus($code, $reasonPhrase = ''): ResponseInterface
    {
        $clone = clone $this;
        $clone->statusCode = $code;
        return $clone;
    }

    public function getReasonPhrase(): string
    {
        return '';
    }
}