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

declare(strict_types=1);

namespace Bijective;

const ELEMENTS = [
    'a' =>  0, 'b' =>  1, 'c' =>  2, 'd' =>  3, 'e' =>  4, 'f' =>  5, 'g' =>  6, 'h' =>  7, 'i' =>  8, 'j' =>  9,
    'k' => 10, 'l' => 11, 'm' => 12, 'n' => 13, 'o' => 14, 'p' => 15, 'q' => 16, 'r' => 17, 's' => 18, 't' => 19,
    'u' => 20, 'v' => 21, 'w' => 22, 'x' => 23, 'y' => 24, 'z' => 25, 'A' => 26, 'B' => 27, 'C' => 28, 'D' => 29,
    'E' => 30, 'F' => 31, 'G' => 32, 'H' => 33, 'I' => 34, 'J' => 35, 'K' => 36, 'L' => 37, 'M' => 38, 'N' => 39,
    'O' => 40, 'P' => 41, 'Q' => 42, 'R' => 43, 'S' => 44, 'T' => 45, 'U' => 46, 'V' => 47, 'W' => 48, 'X' => 49,
    'Y' => 50, 'Z' => 51, '0' => 52, '1' => 53, '2' => 54, '3' => 55, '4' => 56, '5' => 57, '6' => 58, '7' => 59,
    '8' => 60, '9' => 61,
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
    $elements = array_flip(ELEMENTS);

    do {
        $modulus = $input % 62;
        $encoded = $elements[$modulus] . $encoded;

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

    for ($i = $length = strlen($input); $i--;) {
        $decoded = ELEMENTS[$input{$i}] * 62 ** ($length - $i - 1) + $decoded;
    }

    return $decoded;
}
