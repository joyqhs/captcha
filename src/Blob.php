<?php

declare(strict_types=1);
/**
 * This file is part of joyqhs/captcha.
 *
 * @link     https://github.com/joyqhs/captcha
 * @contact  qiaohengshan@gmail.com
 * @license  https://github.com/qiaohengshan/captcha/blob/master/LICENSE
 */
namespace Joyqhs\Captcha;

use finfo;

class Blob
{
    /**
     * @var string
     */
    private $raw;

    /**
     * @var string
     */
    private $mimetype;

    public function __construct(string $raw)
    {
        $this->raw = $raw;
        $this->mimetype = (new finfo(FILEINFO_MIME_TYPE))->buffer($raw);
    }

    public function getRaw(): string
    {
        return $this->raw;
    }

    public function getMimetype(): string
    {
        return $this->mimetype;
    }

    public function toString(): string
    {
        return $this->raw;
    }

    public function toDataUrl(): string
    {
        return 'data:' . $this->mimetype . ';base64,' . base64_encode($this->raw);
    }
}
