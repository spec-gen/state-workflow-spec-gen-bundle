<?php

namespace SpecGen\StateWorkflowSpecGenBundle\Test\Domain;

use SpecGen\StateWorkflowSpecGenBundle\Domain\IntrospectedState;
use SpecGen\StateWorkflowSpecGenBundle\Domain\IntrospectedTransition;
use Gmorel\StateWorkflowBundle\StateEngine\StateWorkflow;
use SpecGen\StateWorkflowSpecGenBundle\Domain\IntrospectedWorkflow as SUT;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateA;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateB;
use SpecGen\StateWorkflowSpecGenBundle\Test\Stub\StateC;

/**
 * @author Guillaume MOREL <github.com/gmorel>
 */
class IntrospectedWorkflowTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_should_introspect_workflow_states()
    {
        // Given
        $stateWorkflow = $this->createValidStateWorkflow();
        $expected = $this->createExpectedStates();

        $expected['a']->setIsRoot();
        $expected['c']->setIsLeaf();

        // When
        $introspectedWorkflow = new SUT($stateWorkflow);
        $actual = $introspectedWorkflow->getIntrospectedStates();

        // Then
        $this->assertEquals($expected, $actual, 'State are not well introspected anymore.');
    }

    public function test_it_should_introspect_workflow_transitions()
    {
        // Given
        $stateWorkflow = $this->createValidStateWorkflow();

        $expectedStates = $this->createExpectedStates();

        $expectedStates['a']->setIsRoot();
        $expectedStates['c']->setIsLeaf();

        $expectedTransitions = array(
            'setToB_from_a' => new IntrospectedTransition(
                'setToB',
                $expectedStates['a'],
                $expectedStates['b']
            ),
            'setToC_from_b' => new IntrospectedTransition(
                'setToC',
                $expectedStates['b'],
                $expectedStates['c']
            ),
        );

        // When
        $introspectedWorkflow = new SUT($stateWorkflow);
        $actual = $introspectedWorkflow->getIntrospectedTransitions();

        // Then
        $this->assertEquals($expectedTransitions, $actual, 'Transitions are not well introspected anymore.');
    }

    /**
     * @return StateWorkflow
     */
    private function createValidStateWorkflow()
    {
        $stateA = new StateA();
        $stateB = new StateB();
        $stateC = new StateC();

        $stateWorkflow = new StateWorkflow('Booking Workflow', 'key');
        $stateWorkflow->addAvailableState($stateA);
        $stateWorkflow->addAvailableState($stateB);
        $stateWorkflow->addAvailableState($stateC);

        $stateWorkflow->setStateAsDefault($stateA->getKey());

        return $stateWorkflow;
    }

    /**
     * @return IntrospectedState[]
     */
    private function createExpectedStates()
    {
        return array(
            'a' => new IntrospectedState('a', 'A'),
            'b' => new IntrospectedState('b', 'B'),
            'c' => new IntrospectedState('c', 'C'),
        );
    }
}
