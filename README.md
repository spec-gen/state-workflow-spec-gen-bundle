SpecGen - State Workflow Bundle
===============================

[![Build Status](https://travis-ci.org/spec-gen/state-workflow-spec-gen-bundle.svg?branch=master)](https://travis-ci.org/spec-gen/state-workflow-spec-gen-bundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/spec-gen/state-workflow-spec-gen-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/spec-gen/state-workflow-spec-gen-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/spec-gen/state-workflow-spec-gen-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/spec-gen/state-workflow-spec-gen-bundle/?branch=master)
[![Dependency Status](https://www.versioneye.com/user/projects/55460de92405490d1f000002/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55460de92405490d1f000002)
[![Latest Stable Version](https://poser.pugx.org/spec-gen/state-workflow-spec-gen-bundle/v/stable.svg)](https://packagist.org/packages/spec-gen/state-workflow-spec-gen-bundle)
[![License](https://poser.pugx.org/gmorel/state-workflow-bundle/license)](https://packagist.org/packages/gmorel/state-workflow-bundle)
<img src ="https://avatars3.githubusercontent.com/u/12191789?v=3&s=200" alt="Spec Gen logo" align="right"/>

Ease complex workflow readability by generating its specification from your code base
---------------------------------------------

Keywords : Workflow, Finite State Machine, Symfony2, Specification Generation

**Specification Generator** for [StateWorkflowBundle](https://github.com/gmorel/StateWorkflowBundle).

> The worst specifications are **not updated** specifications..

<img src ="https://raw.githubusercontent.com/spec-gen/state-workflow-spec-gen-bundle/master/doc/symfony.png" alt="Symfony 2" align="right"/>
Aim is to have your `Workflow Specification` (Available states and transitions) always up to date in order to ease your Domain readability.
Hence **avoiding misunderstandings** and allow new comers to assist you **quicker** in your project.
**Saving you valuable time** since you no more have to make sure your specs are up to date.

Generated specification for simple workflow 
![Demo Booking Workflow simple](https://raw.githubusercontent.com/spec-gen/state-workflow-spec-gen-bundle/master/doc/demo-booking-workflow.png "Demo Booking Workflow simple")





Generated specification for more complex workflow
![Demo Quote Workflow complex](https://raw.githubusercontent.com/spec-gen/state-workflow-spec-gen-bundle/master/doc/demo-quote-workflow-complex.png "Demo Quote Workflow complex")


Usage
=====

From a Symfony2 project

```cli
php app/console.php spec-gen:state-workflow:generate-specifications
```

Workflow specification files will be generated in `{PROJECT ROOT}/specification/workflow/`

Example : {PROJECT ROOT}/specification/workflow/demo.booking_engine.state_workflow.html


Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require spec-gen/state-workflow-spec-gen-bundle "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Gmorel\StateWorkflowBundle\GmorelStateWorkflowBundle(),
        );
        
        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            // ...
            $bundles[] = new SpecGen\StateWorkflowSpecGenBundle\SpecGenStateWorkflowSpecGenBundle();
        }

        // ...
    }

    // ...
}
```

Step 3: Implement your workflow
-------------------------------

Using [StateWorkflowBundle](https://github.com/gmorel/StateWorkflowBundle).

Credits
=======

- [Cytoscape](http://www.cytoscape.org) Javascript Engine used to generate workflow specs.

Licence
=======

MIT License (MIT)

Contributing
============

Wanting to ease understanding of your projects from yourself and team members ?

Wanting to contribute finding new ways of auto generating specifications from other SF2 project aspects ?
- Enhancing Micro service interactions readability ?
- DDD - Bounded Context - UML generation from application service ?
- Ubiquitous Language dictionary generator ?
- Other ideas ?

Join https://github.com/spec-gen
