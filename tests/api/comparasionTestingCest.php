<?php


class comparasionTestingCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    // tests
    private function getParse($api_link, $json_path) {
            $this->I->sendGET($api_link);
            $this->I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
            $this->I->seeResponseIsJson();
            return $this->I->grabDataFromResponseByJsonPath($json_path);

    }   

    // tests
    public function tryToTest(ApiTester $I)
    {
        $this->I = $I;

        function array_counter($array) {
            $length = count($array);
            $counter = 0;
            for ($i = 0; $i < $length; $i++) {
                $counter = $counter + (int)$array[$i];
            }
            return $counter;
        }

        $totalViews_arr = $this->getParse('/dashboard.json', '$.dashboard.totalViews');
        $totalReaders_arr = $this->getParse('/dashboard.json', '$.dashboard.totalReaders');
        $involvement_arr = $this->getParse('/dashboard.json', '$.dashboard.involvement');
        $views_arr = $this->getParse('/books.json', '$..views');
        $readers_arr = $this->getParse('/books.json', '$..readers');

        $booksTotalViews = array_counter($views_arr);
        $booksTotalReaders = array_counter($readers_arr);
        $testInvolmet = (100*($booksTotalReaders/$booksTotalViews));

        $this->I->assertEquals($totalViews_arr[0], $booksTotalViews, 'totalViews numbers do not match');
        $this->I->assertEquals($totalReaders_arr[0], $booksTotalReaders, 'totalReaders numbers do not match');
        $this->I->assertEquals($involvement_arr[0], $testInvolmet, 'involvement numbers do not match', 0,01);
    }
}