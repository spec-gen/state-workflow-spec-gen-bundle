<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Test\UI\Cli;

use SpecGen\StateWorkflowSpecGenBundle\UI\Cli\GenerateWorkflowSpecificationsCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
class GenerateWorkflowSpecificationsCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $mockSpecificationService = $this->mockSpecificationService();

        $application = new Application();
        $application->add(new GenerateWorkflowSpecificationsCommand($mockSpecificationService));

        $command = $application->find('spec-gen:state-workflow:generate-specifications');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));
    }

    /**
     * @return \SpecGen\StateWorkflowSpecGenBundle\App\SpecificationService
     */
    private function mockSpecificationService()
    {
        $mock = $this->getMockBuilder('SpecGen\StateWorkflowSpecGenBundle\App\SpecificationService')
            ->disableOriginalConstructor()
            ->getMock();
        $mock->method('renderSpecification')
            ->willReturn(null);
        $mock->method('getAvailableWorkflowIds')
            ->willReturn(array('booking'));

        return $mock;
    }
}
