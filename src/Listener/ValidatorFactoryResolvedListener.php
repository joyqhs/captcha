<?php

declare(strict_types=1);
/**
 * This file is part of joyqhs/captcha.
 *
 * @link     https://github.com/qiaohengshan/captcha
 * @contact  qiaohengshan@gmail.com
 * @license  https://github.com/qiaohengshan/captcha/blob/master/LICENSE
 */
namespace Joyqhs\Captcha\Listener;

use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Validation\Event\ValidatorFactoryResolved;
use Joyqhs\Captcha\CaptchaFactory;

class ValidatorFactoryResolvedListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            ValidatorFactoryResolved::class,
        ];
    }

    public function process(object $event)
    {
        /** @var \Hyperf\Validation\Contract\ValidatorFactoryInterface $validatorFactory */
        $validatorFactory = $event->validatorFactory;

        $validatorFactory->extend('captcha', function ($attribute, $value, $parameters, $validator) {
            if (is_string($value) && strpos($value, ',') !== false) {
                [$ket, $text] = array_pad(explode(',', $value), 2, '');
                return ApplicationContext::getContainer()->get(CaptchaFactory::class)->validate($ket, $text);
            }
            return false;
        });
    }
}
