<?php

namespace Bug2676;

use DoctrineIntersectionTypeIsSupertypeOf\Collection;
use function PHPStan\Analyser\assertType;

class BankAccount
{

}

/**
 * @ORM\Table
 * @ORM\Entity
 */
class Wallet
{
	/**
	 * @var Collection<BankAccount>
	 *
	 * @ORM\OneToMany(targetEntity=BankAccount::class, mappedBy="wallet")
	 * @ORM\OrderBy({"id" = "ASC"})
	 */
	private $bankAccountList;

	/**
	 * @return Collection<BankAccount>
	 */
	public function getBankAccountList(): Collection
	{
		return $this->bankAccountList;
	}
}

function (Wallet $wallet): void
{
	$bankAccounts = $wallet->getBankAccountList();
	assertType('DoctrineIntersectionTypeIsSupertypeOf\Collection<Bug2676\BankAccount>', $bankAccounts);
};
