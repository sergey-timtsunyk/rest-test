<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 23.07.17
 * Time: 12:05
 */

namespace RestBundle\Services\Subscriber\Logging;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LogginRestSubscriber implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Router
     */
    private $router;

    /**
     * LogginRestSubscriber constructor.
     *
     * @param LoggerInterface $logger
     * @param Router $router
     */
    public function __construct(LoggerInterface $logger, Router $router)
    {
        $this->logger = $logger;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => [
                ['onKernelResponse'],
            ],
        ];
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();

        if ($this->isWrittenLog($request->getPathInfo())) {
            $response = $event->getResponse();
            $code = uniqid('re');

            $this->writtenLog('request', 'headers', $code, $request->headers);
            $this->writtenLog('request', 'params', $code, $request->getQueryString());
            $this->writtenLog('request', 'content', $code, $request->getContent());
            $this->writtenLog('response', 'content', $code, $response->getContent());
        }
    }

    /**
     * @param string $typeRecourse
     * @param string $typeContent
     * @param string $code
     * @param string $content
     */
    private function writtenLog(string $typeRecourse, string $typeContent, string $code, string $content)
    {
        $this->logger->info('[{typeRecourse}][{typeContent}][{code}]:',
            [
                'typeRecourse' => $typeRecourse,
                'typeContent' => $typeContent,
                'code' => $code,
                'content' => $content
            ]
        );
    }
    /**
     * @param string $pathInfo
     *
     * @return bool
     */
    private function isWrittenLog(string $pathInfo) :bool
    {
        return preg_match('/^\/api\//', $pathInfo);
    }
}