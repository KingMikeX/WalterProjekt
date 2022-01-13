#!/bin/bash

php72 -n \
  -d extension=bcmath.so \
  -d extension=ctype.so \
  -d extension=curl.so \
  -d extension=dom.so \
  -d extension=gd.so \
  -d extension=igbinary.so \
  -d extension=iconv.so \
  -d extension=intl.so \
  -d extension=json.so \
  -d extension=mbstring.so \
  -d extension=pdo.so \
  -d extension=pdo_sqlite.so \
  -d extension=phar.so \
  -d extension=redis.so \
  -d extension=simplexml.so \
  -d extension=tokenizer.so \
  -d extension=xml.so \
  -d extension=xmlreader.so \
  -d extension=xmlwriter.so \
  -d extension=zip.so \
  "$@"
