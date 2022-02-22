<?php
declare(strict_types=1);

namespace Jadob\Webhook\Provider\Telegram;


use Jadob\FixtureHelper;
use Jadob\Typed\Telegram\Chat;
use Jadob\Typed\Telegram\Update;
use Jadob\Webhook\Provider\Telegram\Event\TelegramEvent;
use LogicException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class TelegramEventExtractorTest extends TestCase
{

    public function testEventWrappingWillNotAcceptAnyOtherClassThanATelegramUpdate(): void
    {

        $evp = new TelegramEventExtractor();

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('TelegramEventProcessor#wrapEvent allows only Update event.');

        $evp->wrapEvent(new Chat());
    }

    public function testEventWrappingWillHandleUpdateAndReturnWrappedEvent(): void
    {

        $evp = new TelegramEventExtractor();
        $update = Update::fromArray(FixtureHelper::getJson('telegram-update-message'));

        /** @var TelegramEvent $wrapped */
        $wrapped = $evp->wrapEvent($update);

        self::assertInstanceOf(TelegramEvent::class, $wrapped);
        self::assertSame($update, $wrapped->getUpdate());
    }

    public function testExtractorWillDisallowToProcessAnRequestThatDoesNotContainAnUpdateKey(): void
    {

        $evp = new TelegramEventExtractor();

        $req = Request::create('/', 'POST', content: '{"hello": 1}');
        self::assertFalse($evp->canProcess($req));
    }

    public function testExtractorWillDisallowToProcessAnEmptyRequest(): void
    {

        $evp = new TelegramEventExtractor();

        $req = Request::create('/', 'POST', content: '{}');
        self::assertFalse($evp->canProcess($req));
    }

    public function testExtractorWillDisallowToProcessAnRequestThatHasSomeText(): void
    {

        $evp = new TelegramEventExtractor();

        $req = Request::create('/', 'POST', content: 'well hello there');
        self::assertFalse($evp->canProcess($req));
    }
}