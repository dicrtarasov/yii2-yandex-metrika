<?php
/*
 * @copyright 2019-2020 Dicr http://dicr.org
 * @author Igor A Tarasov <develop@dicr.org>
 * @license MIT
 * @version 08.12.20 23:29:38
 */

declare(strict_types = 1);

namespace dicr\tests\report;

use dicr\tests\AbstractTest;
use dicr\yandex\metrika\Metrika;
use dicr\yandex\metrika\report\PivotRequest;
use yii\base\Exception;

/**
 * Class PivotRequest Test.
 */
class PivotRequestTest extends AbstractTest
{
    /**
     * Test
     *
     * @throws Exception
     */
    public function testSend() : void
    {
        /** @var PivotRequest $req */
        $req = self::client()->createRequest([
            'class' => PivotRequest::class,
            'ids' => [Metrika::TEST_COUNTER_ID],
            'metrics' => ['ym:s:pageviews']
        ]);

        $res = $req->send();
        self::assertNotEmpty($res->totalRows);
        self::assertIsArray($res->query);
        self::assertNotEmpty($res->query);
        self::assertIsArray($res->data);
        self::assertNotEmpty($res->data);

        echo 'Результатов: ' . $res->totalRows . "\n";
    }
}
