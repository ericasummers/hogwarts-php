# _Hogwarts University_

#### _This web page allows a user to enter students and courses at Hogwarts University, 28 February 2017_

#### By _**Erica Wright & Leah Sherrell**_

## Description

_This web page allows a user to input a new student, update, or remove them, and add courses to them. It also allows a user to enter courses and enroll students._

## Setup/Installation Requirements

* Ensure [composer](https://getcomposer.org/) is installed on your computer.

* In terminal run the following commands:

1. _Fork and clone this repository from_ [gitHub]https://github.com/ericaw21/hogwarts-php.
2. Navigate to the root directory of the project in which ever CLI shell you are using and run the command: `composer install`.
3. To run tests enter `composer test` in terminal.
4. Create a local server in the /web directory within the project folder using the command: php -S localhost:8000 (assuming you are using a mac), or php -S localhost:8888 (if using windows).
5. Open the directory http://localhost:8000/ (if on a mac) or http://localhost:8888/ (if on windows pc) in any standard web browser.
6. Start server with MAMP and make sure your mySQL server is set to 3306.
7. Open phpMyAdmin and import the database zip files named hogwarts.sql.zip and hogwarts_test.sql.zip located in the project folder to import the databases needed.

## Specifications

|    *Behavior*   |    *Input*    |     *Output*    |
|-----------------|---------------|-----------------|
|View student list|Click view students|Student list ex: "Harry Potter, 2-02-2000"|
|Enter a student|Type ex: "Hermione Granger, 4-2-2000" click submit|Student list "Harry Potter, 2-02-2000, Hermione Granger, 4-2-2000"|
|View all courses|Click view courses|ex: "Defense Against the Dark Arts, Potions"|
|Enter a course|Type ex: "Herbology"|ex: "Defense Against the Dark Arts, Potions, Herbology"|
|Add student to course|Select student ("Hermione"), click Add to course|Course Student List: "Hermione"|
|View houses|Click view houses|ex: "Gryffindor, Ravenclaw, Slytherin, Hufflepuff"|
|Add student to house|Select student ("Harry"), click Add to house|Gryffindor students: Harry Potter|


## Known Bugs

_None so far._

## Support and contact details

_Please contact ericaw21@gmail.com or leahsherrell@gmail.com with concerns or comments._

## Technologies Used

* _Composer_
* _CSS_
* _HTML_
* _MySQL_
* _PHP_
* _PHPUnit_
* _Silex_
* _Twig_

### License

*MIT license*

Copyright (c) 2017 **Leah Sherrell & Erica Wright** All Rights Reserved.
