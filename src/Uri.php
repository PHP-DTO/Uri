<?php

namespace PhpDto\Uri;

use Exception;
use League\Uri\UriString;
use PhpDto\Uri\Exception\UriException;

class Uri
{
    private string $uri;

    /**
     * Uri constructor.
     * @param string $uri
     * @param array $schemes
     * @throws UriException
     */
    public function __construct(string $uri, array $schemes = [])
    {
        try {
            $components = UriString::parse($uri);
        } catch (Exception $exception) {
            throw new UriException($exception->getMessage(), 10, $exception);
        }

        if (empty($components['scheme'])) {
            throw new UriException('Uri scheme should not be empty', 20);
        }

        if (!empty($schemes) && !in_array($components['scheme'], $schemes)) {
            throw new UriException('Uri scheme is not allowed. Can be one of ' . implode(', ', $schemes), 21);
        }

        if (empty($components['host']) && empty($components['path'])) {
            throw new UriException('Uri host or path should be not empty', 30);
        }

        $this->uri = $uri;
    }

    public function getComponents(): array
    {
        return UriString::parse($this->uri);
    }

    public function get(): string
    {
        return $this->uri;
    }

    public function __toString(): string
    {
        return $this->uri;
    }

}