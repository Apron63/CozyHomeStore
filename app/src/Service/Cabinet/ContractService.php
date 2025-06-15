<?php

declare (strict_types=1);

namespace App\Service\Cabinet;

use App\Entity\Contract;
use App\Entity\User;
use App\Repository\ContractRepository;

class ContractService
{
    public function __construct(
        private readonly ContractRepository $contractRepository,
    ) {}

    /**
     * @return Contract[]
     */
    public function getContractData(User $user, string $reportPeriod): array
    {
        return $this->contractRepository->findBy([
            'loginPharma' => $user->getLogin(),
            'period' => $reportPeriod,
        ]);
    }
}
