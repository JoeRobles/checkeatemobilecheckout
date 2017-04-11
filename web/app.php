<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Culqi\Culqi;

$app->get('/', function() use($app) {
    return
  "<!DOCTYPE html>\n" .
  "<html>\n" .
  "    <head>\n" .
  "        <title>Hello</title>\n" .
  "    </head>\n" .
  "    <body>\n" .
  "        <p>Hello</p>\n" .
  "\n" .
  "        <form id=\"pagar\" method=\"post\" action=\"/verify\" class=\"hidden\">\n" .
  "            <input id=\"token\" type=\"hidden\" name=\"token\" value=\"\">\n" .
  "            <input id=\"datos\" type=\"hidden\" name=\"datos\" value=\"\">\n" .
  "        </form>" .
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
  "            var datos = {\n" .
  "                nombre: 'Checkeate Store',\n" .
  "                moneda: 'USD',\n" .
  "                guardar: false\n" .
  "            };\n" .
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
  "                    console.log('Se ha creado un token:', token);\n" .
  "                } else {\n" .
  "                    console.log(Culqi.error);\n" .
  "                    console.log('Culqi error', Culqi.error.mensaje);\n" .
  "                }\n" .
  "            };\n" .
  "\n" .
  "            function culqi() {\n" .
  "                if (Culqi.token) {\n" .
  "                } else {\n" .
  "                    alert(Culqi.error.mensaje);\n" .
  "                }\n" .
  "\n" .
  "                if (Culqi.error){\n" .
  "                    alert(Culqi.error.mensaje);\n" .
  "                } else {\n" .
  "                    datos.email = Culqi.token.email;\n" .
  "\n" .
  "                    fillForm(Culqi, datos);\n" .
  "\n" .
  "                    function fillForm(Culqi, datos) {\n" .
  "                         $('#token').val(Culqi.token.id);\n" .
  "                         $('#datos').val(JSON.stringify(datos));\n" .
  "                         setTimeout(function(){\n" .
  "                             $('#pagar').submit();\n" .
  "                         }, 500);\n" .
  "                     }\n" .
  "                 }\n" .
  "             }\n" .
  "        </script>\n" .
  "    </body>\n" .
  "</html>";
});

$app->post('/verify', function(Request $request) use($app) {
    $culqi = new Culqi(array(
        'api_key' => 'sk_test_q6u17xfqYdKaE44q'
    ));

    $token = $request->get('token');
    $datos = json_decode($request->get('datos'));

    $charge = $culqi->Charges->create(
        array(
            "amount" => 1000,
            "capture" => true,
            "currency_code" => $datos->moneda,
            "description" => "Venta de prueba",
            "email" => $datos->email,
            "installments" => 0,
            "source_id" => "$token"
        )
    );

//    return new JsonResponse(array('token' => $token, 'datos' => $datos));
    return new JsonResponse(array('token' => $token, 'datos' => $datos, 'charge' => $charge));
});

$app->get('/verify', function() use($app) {
    $culqi = new Culqi(array(
        'api_key' => 'sk_test_q6u17xfqYdKaE44q'
    ));

    $token = 'tkn_test_MLqEPMjpZWBZrBIe';
    $datos = '{"nombre":"Checkeate Store","moneda":"USD","guardar":false,"email":"zero@set.com"}';
    $datos = json_decode($datos);

    $charge = $culqi->Charges->create(
        array(
            "amount" => 1000,
            "capture" => true,
            "currency_code" => $datos->moneda,
            "description" => "Venta de prueba",
            "email" => $datos->email,
            "installments" => 0,
            "source_id" => "$token"
        )
    );

//    return new JsonResponse(array('token' => $token, 'datos' => $datos));
    return new JsonResponse(array('token' => $token, 'datos' => $datos, 'charge' => $charge));
});

$app['debug'] = true;

$app->run();
