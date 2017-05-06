<?php declare(strict_types = 1);

namespace PHPStan\Rules\Comparison;

use PHPStan\Rules\RuleLevelHelper;

class StrictComparisonOfDifferentTypesRuleTest extends \PHPStan\Rules\AbstractRuleTest
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new StrictComparisonOfDifferentTypesRule(new RuleLevelHelper(true), true);
	}

	public function testUselessCast()
	{
		$this->analyse(
			[__DIR__ . '/data/strict-comparison.php'],
			[
				[
					'Strict comparison using === between int and string will always evaluate to false.',
					11,
				],
				[
					'Strict comparison using !== between int and string will always evaluate to true.',
					12,
				],
				[
					'Strict comparison using === between int and null will always evaluate to false.',
					14,
				],
				[
					'Strict comparison using === between StrictComparison\Bar and int will always evaluate to false.',
					15,
				],
				[
					'Strict comparison using === between int and StrictComparison\Foo[]|bool|StrictComparison\Collection will always evaluate to false.',
					19,
				],
				[
					'Strict comparison using === between true and false will always evaluate to false.',
					30,
				],
				[
					'Strict comparison using === between false and true will always evaluate to false.',
					31,
				],
			]
		);
	}

}
