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

declare(strict_types = 1);

/**
 * Functions for creating a one-to-one mapping between integers and strings.
 *
 * @package Honest\Bijective
 * @author  Daniel Morris <daniel@honestempire.com>
 */
namespace Honest\Bijective
{
    /**
     * Array of elements used for encoding and decoding.
     *
     * @var array
     */
    const ELEMENTS = [
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
        'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B',
        'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
        'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3',
        '4', '5', '6', '7', '8', '9',
    ];

    /**
     * Encodes an integer into a corresponding string.
     *
     * @param int $input The integer to encode.
     *
     * @return string
     */
    function bijective_encode(int $input): string
    {
        $encoded = '';

        do {
            $modulus = $input % 62;
            $encoded = ELEMENTS[$modulus] . $encoded;

            $input = ($input - $modulus) / 62;
        } while ($input > 0);

        return $encoded;
    }

    /**
     * Decodes a string into a corresponding integer.
     *
     * @param string $input The string to decode.
     *
     * @return int
     */
    function bijective_decode(string $input): int
    {
        $decoded = 0;
        $elements = array_flip(ELEMENTS);

        for ($i = $length = strlen($input); $i--;) {
            $decoded = $elements[$input{$i}] * 62 ** ($length - $i - 1) + $decoded;
        }

        return $decoded;
    }
}
