<?php

/*
 * Bijective
 *
 * Copyright © 2013 – 2016 Honest Empire Ltd
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * PHP version 7.0+
 */

namespace Honest\Bijective\Test;

use function Honest\Bijective\{
    bijective_encode,
    bijective_decode,
    bijective_expression
};

/**
 * Tests the bijection functions.
 *
 * @package Honest\Bijective
 * @author  Daniel Morris <daniel@honestempire.com>
 */
class BijectiveTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests the `Honest\Bijective\bijective_encode` function.
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
     * Tests the <code>Honest\Bijective\bijective_decode</code> function.
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
