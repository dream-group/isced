# ISCED
Tiny class to do conversions between ISCED field codes and names.

[![Build Status](https://travis-ci.org/dream-group/isced.svg?branch=master)](https://travis-ci.org/dream-group/isced)

## Usage

Simply utilise the static methods of the class.

```php
Isced::isCode('0841', Isced::VERSION_2013); // true
```

```php
Isced::fetchNameByCode('0841', Isced::VERSION_2013); // 'Veterinary'
```