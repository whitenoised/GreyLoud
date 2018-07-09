<?php


class DashboardFieldsTestingCest
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
        $I->sendGET('/dashboard.json');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();

        $I->seeResponseMatchesJsonType([
            'totalViews' => 'integer:!empty',
            'totalReaders' => 'integer:!empty',
            'involvement' => 'float:!empty'
        ], '$.dashboard');

        $totalViews = $I->grabDataFromResponseByJsonPath('$.dashboard.totalViews');
        $totalReaders = $I->grabDataFromResponseByJsonPath('$.dashboard.totalReaders');
        $involvement = $I->grabDataFromResponseByJsonPath('$.dashboard.involvement');

        $testInvolmet = (100*($totalReaders[0]/$totalViews[0]));

        $I->assertEquals($testInvolmet, $involvement[0], 'The values do not match', 0.01);
    }
}
