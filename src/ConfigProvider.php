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

use HyperfExt\Captcha\Listener\ValidatorFactoryResolvedListener;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'listeners' => [
                ValidatorFactoryResolvedListener::class,
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for hyperf-ext/captcha.',
                    'source' => __DIR__ . '/../publish/captcha.php',
                    'destination' => BASE_PATH . '/config/autoload/captcha.php',
                ],
                [
                    'id' => 'fonts',
                    'description' => 'The fonts for joyqhs-ext/captcha.',
                    'source' => __DIR__ . '/../publish/fonts',
                    'destination' => BASE_PATH . '/storage/fonts',
                ],
            ],
        ];
    }
}
