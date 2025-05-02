<?php

declare (strict_types=1);

namespace App\Service\Common;

use App\Repository\OptionsRepository;

class OptionsService
{
    public function __construct(
        private readonly OptionsRepository $optionsRepository,
    ) {}

    public function getOption(string $optionName): string
    {
        $optionValue = '';

        $option = $this->optionsRepository->findOneBy(['name' => $optionName]);
        if (null !== $option) {
            $optionValue = $option->getValue();
        }

        return $optionValue;
    }
}
