<?php declare(strict_types=1);

use ApiClients\Tools\TestUtilities\TestCase;
use Psr\Log\LoggerInterface;
use React\EventLoop\LoopInterface;
use Recoil\Kernel;
use Recoil\React\ReactKernel;

/**
 * @internal
 */
final class DiTest extends TestCase
{
    public function testKernel(): void
    {
        $loop = $this->prophesize(LoopInterface::class);
        $logger = $this->prophesize(LoggerInterface::class);

        $root = \dirname(__DIR__);
        $path = $root . \DIRECTORY_SEPARATOR . 'etc' . \DIRECTORY_SEPARATOR . 'di' . \DIRECTORY_SEPARATOR . 'kernel.php';
        $kernel = (require $path)[Kernel::class]($loop->reveal(), $logger->reveal());

        self::assertInstanceOf(Kernel::class, $kernel);
        self::assertInstanceOf(ReactKernel::class, $kernel);
    }
}
