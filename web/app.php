<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/', function() use($app) {
    return
  "<!DOCTYPE html>\n" .
  "<html>\n" .
  "    <head>\n" .
  "        <title>Hello</title>\n" .
  "    </head>\n" .
  "    <body>\n" .
  "        <p>Hello</p>\n" .
  "        <button id=\"buyButton\" type=\"button\">Click Me!</button>\n" .
  "        <script src=\"https://checkout.culqi.com/v2\"></script>\n" .
  "        <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>\n" .
  "        <script>\n" .
  "            Culqi.publicKey = 'pk_test_X2C9QTAE7YI256cM';\n" .
  "\n" .
  "            Culqi.settings({\n" .
  "                title: 'Culqi Store',\n" .
  "                currency: 'PEN',\n" .
  "                description: 'Polo Culqi lover',\n" .
  "                amount: 3500\n" .
  "            });\n" .
  "\n" .
  "            $('#buyButton').on('click', function(e) {\n" .
  "                console.log('clicked');\n" .
  "                Culqi.open();\n" .
  "                e.preventDefault();\n" .
  "            });\n" .
  "\n" .
  "            function culqi() {\n" .
  "                console.log('culqi executed')\n" .
  "                if (Culqi.token) {\n" .
  "                    var token = Culqi.token.id;\n" .
  "                    alert('Se ha creado un token:'.token);\n" .
  "                } else {\n" .
  "                    console.log(Culqi.error);\n" .
  "                    alert(Culqi.error.mensaje);\n" .
  "                }\n" .
  "            };\n" .
  "        </script>\n" .
  "    </body>\n" .
  "</html>";
});

$app['debug'] = true;

$app->run();
