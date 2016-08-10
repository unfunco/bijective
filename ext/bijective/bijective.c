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
 */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_bijective.h"

ZEND_BEGIN_ARG_INFO_EX(arginfo_bijective_encode, 0, 0, 1)
        ZEND_ARG_INFO(0, input)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_bijective_decode, 0, 0, 1)
        ZEND_ARG_INFO(0, input)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO(arginfo_bijective_expression, 0)
ZEND_END_ARG_INFO()

/* {{{ bijective_functions[]
 * Each function must have an entry in bijective_functions[].
 */
static const zend_function_entry bijective_functions[] = {
        PHP_FE(bijective_encode,     arginfo_bijective_encode)
        PHP_FE(bijective_decode,     arginfo_bijective_decode)
        PHP_FE(bijective_expression, arginfo_bijective_expression)
        PHP_FE_END
};
/* }}} */

/* {{{ bijective_module_entry
 */
zend_module_entry bijective_module_entry = {
        STANDARD_MODULE_HEADER,
        "bijective",
        bijective_functions,
        PHP_MINIT(bijective),
        PHP_MSHUTDOWN(bijective),
        NULL,
        NULL,
        PHP_MINFO(bijective),
        BIJECTIVE_VERSION,
        STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_BIJECTIVE
ZEND_GET_MODULE(bijective)
#endif

/* {{{ PHP_MINIT_FUNCTION
 */
PHP_MINIT_FUNCTION(bijective)
{
        return SUCCESS;
}
/* }}} */

/* {{{ PHP_MSHUTDOWN_FUNCTION
 */
PHP_MSHUTDOWN_FUNCTION(bijective)
{
        return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION
 */
PHP_MINFO_FUNCTION(bijective)
{
        php_info_print_table_start();
        php_info_print_table_header(2, "Bijective functions", "enabled");
        php_info_print_table_row(2, "Version", BIJECTIVE_VERSION);
        php_info_print_table_end();
}
/* }}} */

/* {{{ proto string bijective_encode(int input)
 * Encodes an integer into a corresponding string. */
PHP_FUNCTION(bijective_encode)
{
        zend_long input;

#ifndef FAST_ZPP
        if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "l", &input) == FAILURE) {
                return;
        }
#else
        ZEND_PARSE_PARAMETERS_START(1, 1)
                Z_PARAM_LONG(input)
        ZEND_PARSE_PARAMETERS_END();
#endif
}
/* }}} */

/* {{{ proto int bijective_decode(string input)
 * Decodes a string into a corresponding integer. */
PHP_FUNCTION(bijective_decode)
{
        zend_string *input;

#ifndef FAST_ZPP
        if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "S", &input) == FAILURE) {
                return;
        }
#else
        ZEND_PARSE_PARAMETERS_START(1, 1)
                Z_PARAM_STR(input)
        ZEND_PARSE_PARAMETERS_END();
#endif
}
/* }}} */

/* {{{ proto string bijective_expression(void)
 * Returns a string representation of a regular expression for recognising encoded strings. */
PHP_FUNCTION(bijective_expression)
{
#ifndef FAST_ZPP
        if (zend_parse_parameters_none() == FAILURE) {
                return;
        }
#else
        ZEND_PARSE_PARAMETERS_START(0, 0)
        ZEND_PARSE_PARAMETERS_END();
#endif

        RETURN_STRING("/^[a-z0-9]+$/i");
}
/* }}} */
