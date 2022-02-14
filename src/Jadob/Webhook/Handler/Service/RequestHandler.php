<?php
declare(strict_types=1);

namespace Jadob\Webhook\Handler\Service;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestHandler
{
    protected const CHANNELS_REQUEST_ATTR = 'webhook_channels';

    public function __construct(
        protected EventDispatcherInterface $eventDispatcher,
        protected ProviderRegistry $providerRegistry,
        protected LoggerInterface $logger
    ) {
    }


    public function handle(Request $request)
    {
        $channels = $request->attributes->get(self::CHANNELS_REQUEST_ATTR);

        $this->logger->info('New webhook request had arrived!', [
            'payload' => $request->getContent(),
            'headers' => $request->headers->all()
        ]);

        foreach ($channels as $channel) {
            $provider = $this->providerRegistry->getProvider($channel);
            $requestValidator  = $provider->getRequestValidator();
            $extractor = $provider->getEventExtractor();
            
            if($requestValidator !== null) {
                $requestValidator->validate($request);
            }

            if(!$extractor->canProcess($request)) {
                #TODO: continue to another provider
            }

            $event = $extractor->extractEvent($request);

        }
    }
}