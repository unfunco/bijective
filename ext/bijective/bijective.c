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

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_bijective.h"
#include "ext/standard/php_smart_string.h"

static const char elements[] =
	"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

#define BIJECTIVE_ELEMENTS_COUNT 62

void bijective_reverse(char *s)
{
	char *r = s;

	while (*r) {
        	++r;
	}

	for (--r; s < r; ++s, --r) {
		*s = *s ^ *r;
		*r = *s ^ *r;
		*s = *s ^ *r;
	}
}

ZEND_BEGIN_ARG_INFO_EX(arginfo_bijective_encode, 0, 0, 1)
	ZEND_ARG_INFO(0, input)
ZEND_END_ARG_INFO()

ZEND_BEGIN_ARG_INFO_EX(arginfo_bijective_decode, 0, 0, 1)
	ZEND_ARG_INFO(0, input)
ZEND_END_ARG_INFO()

/* {{{ bijective_functions[]
 * Each function must have an entry in bijective_functions[].
 */
static const zend_function_entry bijective_functions[] = {
	PHP_FE(bijective_encode, arginfo_bijective_encode)
	PHP_FE(bijective_decode, arginfo_bijective_decode)
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

	ZEND_PARSE_PARAMETERS_START(1, 1)
		Z_PARAM_LONG(input)
	ZEND_PARSE_PARAMETERS_END();

	smart_string encoded = {};
	uint8_t modulus;

	do {
		modulus = input % BIJECTIVE_ELEMENTS_COUNT;
		smart_string_appendc(&encoded, elements[modulus]);
		input = (input - modulus) / BIJECTIVE_ELEMENTS_COUNT;
	} while (input > 0);

	smart_string_0(&encoded);
	bijective_reverse(encoded.c);
	RETVAL_STRING(encoded.c);
	smart_string_free(&encoded);
}
/* }}} */

/* {{{ proto int bijective_decode(string input)
 * Decodes a string into a corresponding integer. */
PHP_FUNCTION(bijective_decode)
{
	zend_string *input;

	ZEND_PARSE_PARAMETERS_START(1, 1)
		Z_PARAM_STR(input)
	ZEND_PARSE_PARAMETERS_END();

	zend_long decoded = 0;
	size_t len = ZSTR_LEN(input), i, pos;
	char *chr;

	for (i = len; i--;) {
		chr = strchr(elements, ZSTR_VAL(input)[i]);
		pos = (int) (chr - elements);
		decoded = pos * (int) pow((double) BIJECTIVE_ELEMENTS_COUNT, len - i - 1) + decoded;
	}

	RETURN_LONG(decoded);
}
/* }}} */
