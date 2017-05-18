                SIMPLE-PHP-EXAMPLE
https://simple-php-example.herokuapp.com/index.php

This is my local working repo, where I mix and mash and change things as needed
to troubleshoot both customer issues and to test functionality that I want to push
to my herokuapp.

#What is it?
-----------

SIMPLE-PHP-EXAMPLE is just a quick and dirty tool which HelloSign
API Support Engineers could use to test some of HelloSign's embedded API
functionality.

#How can I use it?
-----------
To run this locally:
1. download this repo (and remember the location)
2. Create an environment variable as your API Key called  `HS_APIKEY_PROD`
3. Create another environment variable as one of your client ids as
`HS_CLIENT_ID_LOCAL`
4. spin up a webserver from this location
something like `$ php -S localhost:8080`
(you could choose another port if you're already using 8080).

Then you could modify this code locally for any of your tests,
and submit a PR if you want to contribute to this repo.

#Contacts
-----------

If you have any questions about this project, feel free to email
me at alex@alexgriffen.com
