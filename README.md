Dinkly Event Log Plugin v1.00
=============================

SKeep track of what users are up to in your Dinkly application.


Installation
------------

  1. Move the `event_log` folder into your dinkly project's `plugins` folder.

  2. Place these lines under the `databases` section of your `config/config.yml` file and tweak as needed:

    ```yaml
    event_log:
            host: localhost
            user: root
            pass: root
            name: dinkly_app   #Change this to point to an existing database
    ```

  3. Build the models - at the command line: `php tools/gen_models.php -s event_log -p event_log -i`


Usage
-----

Populating the log is easy. In any controller add the following code (and change the event description and user id call as needed):

  ```php
  EventLog::log($this->db, $this->getContext(), "Successful sign-in", $user->getId());
  ```

Passing the context information is key. The log will populate with the current app, module, view, GET parameters, user id, and session id.

License
-------

The Dinkly Event Log plugin is open-sourced software licensed under the MIT License.


Contact
-------

  - lewsid@lewsid.com (github.com/lewsid)
