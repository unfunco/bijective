<?php

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

namespace test\Bijective;

use function Bijective\{
    bijective_encode,
    bijective_decode,
    bijective_expression
};

class BijectiveTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the `Bijective\bijective_encode` function.
     *
     * @param int    $input    The input to be encoded.
     * @param string $expected The expected encoded version of `$input`.
     *
     * @dataProvider bijectionSetProvider
     *
     * @return void
     */
    public function testBijectiveEncode($input, $expected)
    {
        $this->assertEquals($expected, bijective_encode($input));
    }

    /**
     * Tests the <code>Bijective\bijective_decode</code> function.
     *
     * @dataProvider bijectionSetProvider
     *
     * @return void
     */
    public function testBijectiveDecode($expected, $input)
    {
        $this->assertEquals($expected, bijective_decode($input));
    }

    /**
     * Tests the <code>bijective_expression</code> function with recognised strings.
     *
     * @param string $recognisedEncodedString Recognisable encoded string.
     *
     * @dataProvider recognisedEncodedStringProvider
     *
     * @return void
     */
    public function testRecognisedEncodedString($recognisedEncodedString)
    {
        $returned = preg_match(bijective_expression(), $recognisedEncodedString);

        $this->assertEquals(1, $returned);
    }

    /**
     * Tests the <code>bijective_expression</code> function with unrecognised strings.
     *
     * @param string $unrecognisedEncodedString Unrecognised encoded string.
     *
     * @dataProvider unrecognisedEncodedStringProvider
     *
     * @return void
     */
    public function testUnrecognisedEncodedString($unrecognisedEncodedString)
    {
        $returned = preg_match(bijective_expression(), $unrecognisedEncodedString);

        $this->assertEquals(0, $returned);
    }

    /**
     * Returns an array of mappings between integers and strings.
     *
     * @return array
     */
    public function bijectionSetProvider()
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

    /**
     * Returns an array of recognised encoded strings.
     *
     * @return array
     */
    public function recognisedEncodedStringProvider()
    {
        return [
            ['a'],
            ['aB'],
            ['aB1'],
            ['ab78'],
            ['82727'],
            ['2837a9'],
        ];
    }

    /**
     * Returns an array of unrecognised encoded strings.
     *
     * @return array
     */
    public function unrecognisedEncodedStringProvider()
    {
        return [
            ['!'],
            ['a!'],
            ['9@£'],
            ['udf^'],
            ['#0123'],
        ];
    }
}
