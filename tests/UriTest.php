<?php

namespace PhpDto\Uri;

use PhpDto\Uri\Exception\UriException;
use PHPUnit\Framework\TestCase;

class UriTest extends TestCase
{

    public function validUriDataProvider(): array
    {
        return [
            ['http://example.com'],
            ['mailto:mail@example.com'],
            ['callto:88002000600'],
        ];
    }

    /**
     * @dataProvider validUriDataProvider
     * @param string $value
     * @throws UriException
     */
    public function testConstruct(string $value): void
    {
        $uri = new Uri($value);
        $this->assertSame($value, $uri->get());
        $this->assertSame($value, (string)$uri);
    }

    /**
     * @dataProvider validUriDataProvider
     * @param string $value
     * @throws UriException
     */
    public function testConstructWithSchemes(string $value): void
    {
        $uri = new Uri($value, ['http', 'mailto', 'callto']);
        $this->assertSame($value, (string)$uri);
    }

    /**
     * @dataProvider validUriDataProvider
     * @param string $value
     * @throws UriException
     */
    public function testConstructWithRestrictedSchemes(string $value): void
    {
        $this->expectException(UriException::class);
        $this->expectExceptionCode(21);
        new Uri($value, ['https']);
    }

    public function invalidUriDataProvider(): array
    {
        return [
            [' http://example.com', 10],
            ['http://example.com ', 10],
            ['http:// example.com', 10],
            ['http://example .com', 10],
            ['example/com', 20],
            ['http://', 30],
        ];
    }

    /**
     * @dataProvider invalidUriDataProvider
     * @param string $value
     * @param int $code
     * @throws UriException
     */
    public function testConstructInvalidData(string $value, int $code): void
    {
        $this->expectException(UriException::class);
        $this->expectExceptionCode($code);
        new Uri($value);
    }

}
