<?php /** @noinspection PhpDocSignatureInspection */

/*
 * Copyright © 2013 Daniel Morris
 * https://unfun.co
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at:
 *
 * https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

declare(strict_types=1);

namespace test\Bijective;

use function Bijective\bijective_encode;
use function Bijective\bijective_decode;

use PHPUnit\Framework\TestCase;

final class BijectiveTest extends TestCase
{
    /** @dataProvider bijectionSetProvider */
    public function testBijectiveEncode(int $input, string $expected): void
    {
        $this->assertEquals($expected, bijective_encode($input));
    }

    /** @dataProvider bijectionSetProvider */
    public function testBijectiveDecode(int $expected, string $input): void
    {
        $this->assertEquals($expected, bijective_decode($input));
    }

    /**
     * Returns an array of mappings for testing.
     */
    public function bijectionSetProvider(): array
    {
        return [
            [0,        'a'],
            [1,        'b'],
            [10,       'k'],
            [100,      'bM'],
            [1000,     'qi'],
            [10000,    'cLs'],
            [100000,   'Aa4'],
            [1000000,  'emjc'],
            [10000000, 'P7Cu'],
        ];
    }
}
