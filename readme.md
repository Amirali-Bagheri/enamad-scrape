# enamad-scrape

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/amirali-bagheri/enamad-scrape.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/amirali-bagheri/enamad-scrape.svg?style=flat-square)](https://packagist.org/packages/amirali-bagheri/enamad-scrape)

## Install
`composer require amirali-bagheri/enamad-scrape`

## Usage

### __Check Has Enamad__

```
$enamad = new \Enamad('domain.ir');

return $enamad->hasEnamad(); //bool

```

### __Get Information__

```
$enamad = new \Enamad('domain.ir');

return $enamad->get(); //array of data
```

|     Value     |     Type      |      Description      |
| ------------- | ------------- | ----------------------|
|     name      |    string     |     Manager Name      |
|   start_date  |      date     |    Date of Sign Up    |
|  expire_date  |    string     |    Date of Expire     |
|    address    |    string     |        Address        |
|     phone     |       int     |     Phone Number      |
|     email     |    string     |     Email Address     |
|   work_time   |    string     |      Working Time     |
|    history    |    string     |   Business History    |
|     star      |      int      |      Star Rating      |


### __Get Is Expired__

```
$enamad = new \Enamad('domain.ir');

return $enamad->isExpired(); //bool
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Amirali Bagheri](https://github.com/amirali-bagheri)
- [All Contributors](https://github.com/amirali-bagheri/enamad-scrape/contributors)

## Security
If you discover any security-related issues, please contact me.

## License
The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
