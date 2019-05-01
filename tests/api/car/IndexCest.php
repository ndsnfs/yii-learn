<?php
namespace car;


use ApiTester;

class IndexCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    public function checkCars(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->sendPOST('/cars', [
            'gov_number' => 'Г555ГГ163',
            'uuid' => '99999ц999'
        ]);
        $I->seeResponseCodeIs(201);
//        $I->sendGET('/car');
//        $I->seeResponseCodeIs(200);
//        $I->seeResponseIsJson();
//        $I->seeResponseContainsJson(["gov_number" => "Д555ДД163","uuid" => "6881b000-a3fd-4e3a-90f4-346ac7f9b404"]);
    }
}
