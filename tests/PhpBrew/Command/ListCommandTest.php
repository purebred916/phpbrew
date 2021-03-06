<?php
use PhpBrew\Testing\CommandTestCase;

/**
 * @large
 * @group command
 */
class ListCommandTest extends CommandTestCase
{
    /**
     * @outputBuffering enabled
     */
    public function testListCommand() {
        ob_start();
        $this->assertTrue($this->runCommand("phpbrew list"));
        ob_end_clean();
    }


}
