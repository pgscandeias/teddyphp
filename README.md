# <a id="top"></a>TeDDy PHP

A use-case driven approach for TDD php.

* [Overview](#overview)
* [Test-driven development](#tdd)
* [Domain model and persistence](#model)
* [Delivery mechanism](#delivery)
* [Security](#security)
* [A word of warning](#warning)
* [Coding style](#style)
* [Documentation](#docs)
* [Licence](#licence)

<h2 id="overview">Overview</h2>

Teddy is a PHP pseudo-framework based on a use-case driven approach, which facilitates test-driven development by being fully delivery agnostic and somewhat database agnostic.

Teddy isn't designed to interface directly with the user, but rather with some sort of delivery mechanism - which can be anything from the command line to an MVC framework. Said delivery mechanism must simply call the application Use Cases, feeding them data and obtaining simple data structures in return. No entities, no models ever cross the borders of the application, only pure data.

Teddy was inspired by Robert Martin's talk entitled "Architecture the lost years": www.youtube.com/watch?v=WpkDN78P884

[&laquo; back to top](#top)

<h2 id="tdd">Test-driven development</h2>

TDD is the reason Teddy was developed. By moving application logic away from a traditional framework and employing in-memory SQLite databases for storage testing, code gets much lighter and testing speeds improve.

By being able to run a full test suite in a couple of seconds, rather than minutes or hours, test fatigue is prevented and TDD can be sustained for the duration of a project.

TDD is important because it gives the developers confidence that whenever they change the code, whether to fix a bug or program a new feature, the application won't break unexpectedly. As is well known, this can seriously speed up the latter stages of a project.

[&laquo; back to top](#top)


<h2 id="model">Domain model and persistence</h2>

Ideally, the application Entities should be simple classes and their persistence and retrieval should be completely deferred to an external storage layer. For practical reasons, though, Teddy uses the Doctrine2 ORM. Therefore, entity design is informed by the rules of Doctrine.

[&laquo; back to top](#top)


<h2 id="delivery">Delivery mechanism</h2>

An application built with Teddy is just plain PHP and is unburdened by concerns about how it interfaces with the user. It needs a delivery mechanism, which can be anything from a command line tool to a web framework.

If an MVC web framework is used, the application's Use Cases are typically called by that framework's controllers. Those controllers can therefore be very thin indeed:

    <?php
    namespace My\MainBundle\Controller;
    
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    
    class DossierController extends Controller
    {
        public function getDossierAction($slug)
        {
            $output = $this->getUseCase('Dossier\ReadDossier')->run(array(
                'slug' => $slug,
            ));
            if (!$output->data) {
                throw $this->createNotFoundException('no dossier found');
            }
            
            return $this->render('MyMainBundle:Dossier:show.html.twig', array(
                'dossier' => $output->data,
            ));
        }
        
        private function getUseCase($name)
        {
            ...
        }
    ?>

Use cases must simply be passed an instance of Doctrine's Entity Manager on construction, and a data structure must be provided to their run() method. This data structure (normally an array) holds all parameters necessary to performing the use case. Use cases return a very simple data structure object which holds some metadata like whether or not the operation was successful, validation errors, etc.

[&laquo; back to top](#top)


<h2 id="security">Security</h2>

Security concerns such as user account management, session management, and access control are best handled by the delivery mechanism as this time.

[&laquo; back to top](#top)


<h2 id="warning">A word of warning</h2>

Some applications have very little logic beyond CRUD operations. All of the most popular frameworks - Zend, Symfony2, Cake, CodeIgniter, etc - handle CRUD just fine. For those applications, the hassle of setting up Teddy may not be worth it.

[&laquo; back to top](#top)


<h2 id="style">Coding style</h2>

There are hardly any comments in the code. Instead, methods are broken down into smaller methods whose names are indicative of what they do. Variable names are also meaningful and classes try to adhere to the single responsibility principle as much as possible. This should make the code easier to understand than if it was peppered with comments which just go stale anyway.

Also, tests for use cases are the best possible documentation.

[&laquo; back to top](#top)


<h2 id="docs">Documentation, installation, etc</h2>

This repo isn't yet meant for the public. Sorry about the lack of documentation or installation instructions. This may change in the future.

[&laquo; back to top](#top)


<h2 id="licence">Licence</h2>

Copyright (C) 2012 Pedro Candeias

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

[&laquo; back to top](#top)