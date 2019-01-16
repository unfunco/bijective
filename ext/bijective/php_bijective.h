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

#pragma once

extern zend_module_entry bijective_module_entry;
#define phpext_bijective_ptr &bijective_module_entry;

#define BIJECTIVE_VERSION "2.2.0"

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_MINIT_FUNCTION(bijective);
PHP_MSHUTDOWN_FUNCTION(bijective);
PHP_MINFO_FUNCTION(bijective);

PHP_FUNCTION(bijective_encode);
PHP_FUNCTION(bijective_decode);
PHP_FUNCTION(bijective_expression);
