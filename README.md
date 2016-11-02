"A Programming Podcast" Website
================================

hosted at [aprogrammingpodcast.com](https://aprogrammingpodcast.com) (coming soon)

In-dev can be found at [bleeding.aprogrammingpodcast.com](https://bleeding.aprogrammingpodcast.com) [![Build Status](https://build.nclf.net/job/AppWebsite-Alpha/badge/icon)](https://build.nclf.net/job/AppWebsite-Alpha)

Submission guidelines
=====================
* All submissions to this repo must follow the general style of the code, PSR standards are encouraged but not enforced
* All commits *must* be signed by a [Github recognized PGP key](https://help.github.com/articles/signing-commits-using-gpg/) 
  (I like the verified check box and the traceability)

Build Requirements
==================
* PHP 7.1
    * Extensions: mysql, xml, mcrypt, zip
* [Any required Symfony dependencies not listed here](https://symfony.com/doc/3.1.5/setup.html)
* You are running MariaDB 10.1 or a compatible mysql database that understands utf8mb4_unicode_ci encoding

Other setups may work but I'm not testing against them