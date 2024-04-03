<?php

declare(strict_types=1);

namespace Axeptio\Integration\Services\Settings;

interface SettingInterface
{
    public function isActivated(): bool;

    public function getKey(): string;

    /**
     * @return int|float|string|array
     */
    public function getValue();
}
