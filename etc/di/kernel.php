<?php declare(strict_types=1);

use Psr\Log\LoggerInterface;
use React\EventLoop\LoopInterface;
use Recoil\Kernel;
use Recoil\React\ReactKernel;
use WyriHaximus\PSR3\CallableThrowableLogger\CallableThrowableLogger;
use WyriHaximus\PSR3\ContextLogger\ContextLogger;

return (function () {
    return [
        Kernel::class => function (LoopInterface $loop, LoggerInterface $logger) {
            $kernel = ReactKernel::create($loop);
            $kernel->setExceptionHandler(
                CallableThrowableLogger::create(
                    new ContextLogger(
                        $logger,
                        [],
                        'recoil'
                    )
                )
            );

            return $kernel;
        },
    ];
})();
