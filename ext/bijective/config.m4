dnl $Id$
dnl config.m4 for extension bijective

PHP_ARG_ENABLE(bijective, whether to enable bijective support,
[  --enable-bijective           Enable bijective support])

if test "$PHP_BIJECTIVE" != "no"; then
  PHP_NEW_EXTENSION(bijective, bijective.c, $ext_shared)
fi
