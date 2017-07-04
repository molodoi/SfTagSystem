TagSystem
========================

Technologies & versions:
- Symfony 3.3.3

Content
========================
- Create a system of Tags that can be associated with different contents. This will be the opportunity to discover the ManyToMany relationship, but also to see the creation of a custom form type. The goal is to allow the user to enter the tags as a simple list of words separated by a comma.


Install
========================
- Clone project
- Make composer install
- Make php app/console doctrine:database:create
- Make php app/console doctrine:schema:update --force
- Get http://yourdomain.local/app_dev.php/post