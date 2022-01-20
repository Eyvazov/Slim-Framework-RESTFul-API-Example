<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

// Bütün Kurs siyahısını gətir...
$app->get('/courses', function (Request $request, Response $response) {

    $db = new Db();
    try {
        $db = $db->connect();

        $courses = $db->query("SELECT * FROM courses")->fetchAll(PDO::FETCH_OBJ);

        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json')
            ->withJson($courses);

    } catch (PDOException $e) {
        return $response->withJson(
            [
                "error" => [
                    "text" => $e->getMessage(),
                    "code" => $e->getCode()
                ],
            ]
        );
    };


    $db = null;
});


// Kurs elementləri..
$app->get('/course/{id}', function (Request $request, Response $response) {

    $id = $request->getAttribute("id");
    $db = new Db();
    try {
        $db = $db->connect();

        $course = $db->query("SELECT * FROM courses WHERE id = $id")->fetch(PDO::FETCH_OBJ);

        return $response
            ->withStatus(200)
            ->withHeader("Content-Type", 'application/json')
            ->withJson($course);

    } catch (PDOException $e) {
        return $response->withJson(
            [
                "error" => [
                    "text" => $e->getMessage(),
                    "code" => $e->getCode()
                ],
            ]
        );
    };


    $db = null;
});


// Yeni kurs əlavə et..
$app->post('/course/add', function (Request $request, Response $response) {

    $title = $request->getParam("title");
    $couponCode = $request->getParam("couponCode");
    $price = $request->getParam("price");

    $db = new Db();


    try {
        $db = $db->connect();
        $statement = "INSERT INTO courses (title, couponCode, price) VALUES(:title, :couponCode, :price)";
        $prepare = $db->prepare($statement);
        $data = [
            "title" => $title,
            "couponCode" => $couponCode,
            "price" => $price
        ];

        $prepare->bindParam("title", $title);
        $prepare->bindParam("couponCode", $couponCode);
        $prepare->bindParam("price", $price);
        $course = $prepare->execute();

        if ($course) {
            return $response
                ->withStatus(200)
                ->withHeader("Content-Type", 'application/json')
                ->withJson([
                    "text" => "Kurs Müvəffəqiyyətlə Əlavə Edildi!"
                ]);
        } else {
            return $response
                ->withStatus(500)
                ->withHeader("Content-Type", 'application/json')
                ->withJson([
                    "error" => [
                        "text" => "Əlavə etmə prosesində bir problem yarandı!"
                    ]
                ]);
        }

    } catch (PDOException $e) {
        return $response->withJson(
            [
                "error" => [
                    "text" => $e->getMessage(),
                    "code" => $e->getCode()
                ],
            ]
        );
    };


    $db = null;
});

// Kurs redktə et..
$app->put('/course/update/{id}', function (Request $request, Response $response) {


    $id = $request->getAttribute('id');
    if ($id) {
        $title = $request->getParam("title");
        $couponCode = $request->getParam("couponCode");
        $price = $request->getParam("price");
        $db = new Db();


        try {
            $db = $db->connect();
            $statement = "UPDATE courses SET title= :title, couponCode= :couponCode, price= :price WHERE id = $id";
            $prepare = $db->prepare($statement);
            $data = [
                "title" => $title,
                "couponCode" => $couponCode,
                "price" => $price
            ];

            $prepare->bindParam("title", $title);
            $prepare->bindParam("couponCode", $couponCode);
            $prepare->bindParam("price", $price);
            $course = $prepare->execute();

            if ($course) {
                return $response
                    ->withStatus(200)
                    ->withHeader("Content-Type", 'application/json')
                    ->withJson([
                        "text" => "Kurs Müvəffəqiyyətlə Redaktə Edildi!"
                    ]);
            } else {
                return $response
                    ->withStatus(500)
                    ->withHeader("Content-Type", 'application/json')
                    ->withJson([
                        "error" => [
                            "text" => "Redaktə etmə prosesində bir problem yarandı!"
                        ]
                    ]);
            }
        } catch (PDOException $e) {
            return $response->withJson(
                [
                    "error" => [
                        "text" => $e->getMessage(),
                        "code" => $e->getCode()
                    ],
                ]
            );
        }

        $db = null;

    } else {
        return $response->withStatus(500)
            ->withJson([
                "error" => [
                    "text" => "ID məlumatı çatışmır!"
                ]
            ]);
    }


});



// Kursu sil..
$app->delete('/course/{id}', function (Request $request, Response $response) {

    $id = $request->getAttribute("id");

    $db = new Db();


    try {
        $db = $db->connect();
        $statement = "DELETE FROM courses WHERE id = :id";
        $prepare = $db->prepare($statement);

        $prepare->bindParam("id", $id);
        $course = $prepare->execute();

        if ($course) {
            return $response
                ->withStatus(200)
                ->withHeader("Content-Type", 'application/json')
                ->withJson([
                    "text" => "Kurs Müvəffəqiyyətlə Silindi!"
                ]);
        } else {
            return $response
                ->withStatus(500)
                ->withHeader("Content-Type", 'application/json')
                ->withJson([
                    "error" => [
                        "text" => "Silinmə prosesində bir problem yarandı!"
                    ]
                ]);
        }

    } catch (PDOException $e) {
        return $response->withJson(
            [
                "error" => [
                    "text" => $e->getMessage(),
                    "code" => $e->getCode()
                ],
            ]
        );
    };


    $db = null;
});