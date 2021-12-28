[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]

[comment]: <> ([![LinkedIn][linkedin-shield]][linkedin-url])



<!-- PROJECT LOGO -->
<br />
<p align="center">

  <h1 align="center">php-mail</h1>

  <p align="center">
      A library for sending mail !
      <br />
      <!--<a href="https://github.com/sofiakb/php-mail"><strong>Explore the docs »</strong></a>-->
      <br />
      <br />
      <a href="https://github.com/sofiakb/php-mail/issues">Report Bug</a>
      ·
      <a href="https://github.com/sofiakb/php-mail/issues">Request Feature</a>
  </p>

</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About the library</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#usage">Usage</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgements">Acknowledgements</a></li>
  </ol>
</details>



<!-- ABOUT THE PROJECT -->

## About The Library

Cette librairie permet d'envoyer des e-mails simplement.

### Built With

* [PHP](https://php.net)

<!-- GETTING STARTED -->

### Prerequisites

- php >= 7.4
# Installation

```shell
composer require sofiakb/php-mail
```

Then, in your .env file
```dotenv
MAIL_HOST=
MAIL_PORT=
MAIL_USER=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
```

# Usage
```php
use Sofiakb\Mail\Facades\Mail;

Mail::create()
    ->setTo(RECIPIENT_EMAIL)
    ->text("email content"));

```

<!-- ROADMAP -->

## Roadmap

See the [open issues](https://github.com/sofiakb/php-mail/issues) for a list of proposed features (and known issues).


<!-- LICENSE -->

## License

Distributed under the MIT License. See `LICENSE` for more information.




<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[contributors-shield]: https://img.shields.io/github/contributors/sofiakb/php-mail.svg?style=for-the-badge

[contributors-url]: https://github.com/sofiakb/php-mail/graphs/contributors

[forks-shield]: https://img.shields.io/github/forks/sofiakb/php-mail.svg?style=for-the-badge

[forks-url]: https://github.com/sofiakb/php-mail/network/members

[stars-shield]: https://img.shields.io/github/stars/sofiakb/php-mail.svg?style=for-the-badge

[stars-url]: https://github.com/sofiakb/php-mail/stargazers

[issues-shield]: https://img.shields.io/github/issues/sofiakb/php-mail.svg?style=for-the-badge

[issues-url]: https://github.com/sofiakb/php-mail/issues

[license-shield]: https://img.shields.io/github/license/sofiakb/php-mail.svg?style=for-the-badge

[license-url]: https://github.com/sofiakb/php-mail/blob/main/LICENSE

[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555

[linkedin-url]: https://www.linkedin.com/in/sofiane-akbly/