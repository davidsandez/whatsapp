<?php 

namespace Usuario\Prueba\Workflow;

use Symfony\Component\Workflow\DefinitionBuilder;
use Symfony\Component\Workflow\MarkingStore\MethodMarkingStore;
use Symfony\Component\Workflow\Transition;

class Workflow
{

    protected $definitionBuilder;
    protected $definition;
    protected $singleState;
    protected $property;
    protected $marking;
    protected $workflow;    

    public function __construct()
    {
        
        try{
            
            $this->definitionBuilder = new DefinitionBuilder();
            $this->definition = $this->definitionBuilder->addPlaces(['draft', 'reviewed', 'rejected', 'published'])
                // Transitions are defined with a unique name, an origin place and a destination place
                ->addTransition(new Transition('to_review', 'draft', 'reviewed'))
                ->addTransition(new Transition('publish', 'reviewed', 'published'))
                ->addTransition(new Transition('reject', 'reviewed', 'rejected'))
                ->build()
            ;

            $this->singleState = true; // true if the subject can be in only one state at a given time
            $this->property = 'currentState'; // subject property name where the state is stored
            $this->marking = new MethodMarkingStore($this->singleState, $this->property);
            $this->workflow = new Workflow($this->definition, $this->marking);
            
        }
        catch(\Exception $e) {

            //echo $e->getMessage();
            var_dump($e->getTrace());
        }
    }

    public function apply()
    {

        var_dump($this->workflow);
    }
}

