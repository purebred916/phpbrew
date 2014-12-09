<?php
namespace PhpBrew\Tasks;

use GetOptionKit\OptionResult;
use CLIFramework\Logger;
use PhpBrew\Buildable;

/**
 * @small
 */
class MakeTaskTest extends \PHPUnit_Framework_TestCase
{
    private $make;

    public function createLogger()
    {
        $logger = new Logger();
        $logger->setQuiet();
        return $logger;
    }

    public function setUp()
    {
        $this->make = new MakeTask($this->createLogger(), new OptionResult());
        $this->make->setQuiet();
    }

    public function testMakeInstall()
    {
        ok($this->make->install(new MakeTaskTestBuild()));
    }

    public function testMakeClean()
    {
        ok($this->make->clean(new MakeTaskTestBuild()));
    }

    public function testRunWithValidTarget()
    {
        $build = new MakeTaskTestBuild();
        ok($this->make->run($build));
    }

    public function testWhenThereIsNoMakefile()
    {
        // ignores error messages generated by make command
        ob_start();
        not_ok($this->make->install(new MakeTaskTestNoSuchFileBuild()));
        ob_end_clean();
    }

    public function testSetQuiet()
    {
        $make = new MakeTask($this->createLogger(), new OptionResult());

        not_ok($make->isQuiet());

        $make->setQuiet();

        ok($make->isQuiet());
    }
}

class MakeTaskTestBuild implements Buildable
{
    public function getSourceDirectory()
    {
        return __DIR__ . '/../../fixtures/make/';
    }
}

class MakeTaskTestNoSuchFileBuild implements Buildable
{
    public function getSourceDirectory()
    {
        return __DIR__ . '/../../fixtures/make/dummy';
    }
}
