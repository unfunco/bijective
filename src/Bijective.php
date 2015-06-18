<?php
/**
 * Copyright © 2013 – 2014 Honest Empire Ltd
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in the
 * Software without restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the
 * Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN
 * AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * PHP version 5.3+
 *
 * @category  Bijection
 * @package   Bijective
 * @author    Daniel Morris <daniel@honestempire.com>
 * @copyright 2013 – 2014 Honest Empire Ltd
 * @license   MIT License
 * @link      https://github.com/honestempire/bijective
 */

namespace Honest\Bijective
{

    /**
     * Perform an exact pairing between integers and strings using bijection, every
     * integer can be paired with exactly one string and vice-versa using the
     * <code>Bijective::encode()</code> and <code>Bijective::decode()</code> methods
     * made available in this class with zero unpaired elements. Practical
     * applications for this class unique mapping of database rows based on
     * automatically incrementing primary keys, which in turn can be used to create
     * URL shorteners.
     *
     * @category  Bijection
     * @package   Bijective
     * @author    Daniel Morris <daniel@honestempire.com>
     * @copyright 2013 – 2014 Honest Empire Ltd
     * @license   MIT License
     * @link      https://github.com/honestempire/bijective
     */
    class Bijective
    {

        /**
         * @static
         * @access private
         */
        static private $_chars = array(
            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n',
            'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B',
            'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P',
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3',
            '4', '5', '6', '7', '8', '9',
        );

        /**
         * Encode an integer into the corresponding bijective string
         *
         * Given an integer, this method computes the corresponding string bijective.
         * It is expected that <code>$_chars</code> will remain unchanged by persons
         * using this class, and therefore the length of <code>$_chars</code> has
         * been hardcoded in this method to avoid an additional function call to
         * compute the size of the <code>$_chars</code> array.
         *
         * @param integer $number The number to encode
         *
         * @static
         * @return string The encoded bijective
         * @author Daniel Morris <daniel@honestempire.com>
         * @access public
         */
        static public function encode($number)
        {
            $encoded = '';
            do {
                $modulus = $number % 62;
                $encoded = self::$_chars[$modulus].$encoded;
                $number = ($number - $modulus) / 62;
            } while ($number > 0);
            return $encoded;
        }

        /**
         * Decode a bijective string into the corresponding integer
         *
         * Given an encoded bijective string, this method will compute the
         * corresponding integer. It is expected that <code>$_chars</code> will
         * remain unchanged by persons using this class, and therefore the length of
         * <code>$_chars</code> has been hardcoded in this method to avoid an
         * additional function call to compute the size of the <code>$_chars</code>
         * array.
         *
         * @param string $encoded The encoded bijective
         *
         * @static
         * @return integer The decoded bijective
         * @author Daniel Morris <daniel@honestempire.com>
         * @access public
         */
        static public function decode($encoded)
        {
            $decoded = 0;
            $chars = array_flip(self::$_chars);
            for ($i = $length = strlen($encoded); $i--;) {
                $decoded = $chars[$encoded{$i}] * pow(62, $length - $i - 1)
                    + $decoded;
            }
            return $decoded;
        }

    }

}
