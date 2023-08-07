<?php

declare(strict_types=1);
/**
 * This file is part of joyqhs/captcha.
 *
 * @link     https://github.com/qiaohengshan/captcha
 * @contact  qiaohengshan@gmail.com
 * @license  https://github.com/qiaohengshan/captcha/blob/master/LICENSE
 */
namespace Joyqhs\Captcha;

use Carbon\Carbon;
use Hyperf\Utils\Contracts\Arrayable;

class Captcha implements Arrayable
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $text;

    /**
     * @var \HyperfExt\Captcha\Blob
     */
    private $blob;

    /**
     * @var \Carbon\Carbon
     */
    private $expiresAt;

    public function __construct(string $key, string $text, Blob $blob, int $expiresAt)
    {
        $this->key = $key;
        $this->text = $text;
        $this->blob = $blob;
        $this->expiresAt = Carbon::createFromTimestamp($expiresAt);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getBlob(): Blob
    {
        return $this->blob;
    }

    public function getExpiresAt(): Carbon
    {
        return $this->expiresAt;
    }

    public function getTtl(): int
    {
        return $this->expiresAt->timestamp - time();
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'blob' => $this->blob->toDataUrl(),
            'ttl' => $this->getTtl(),
        ];
    }
}
