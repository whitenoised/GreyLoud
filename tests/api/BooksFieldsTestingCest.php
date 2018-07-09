<?php


class TestJsonCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
        $I->sendGET('/books.json');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType([
            'id' => 'integer:!empty',
            'title' => 'string:!empty',
            'author' => 'string:!empty',
            'views' => 'integer:!empty',
            'readers' => 'integer:!empty'
        ]);
    }
}
