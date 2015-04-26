<?php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Event.php';
    require_once __DIR__.'/../src/Volunteer.php';
    require_once __DIR__.'/../src/Committee.php';
    require_once __DIR__.'/../src/Supervisor.php';

    $app = new Silex\Application();

    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=volunteer_management');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    session_start();
     if (empty($_SESSION['volunteer_id'])) {
         $_SESSION['volunteer_id'] = null;
     };
     if (empty($_SESSION['supervisor_id'])) {
         $_SESSION['supervisor_id'] = null;
     };

     /*
     **********************************
      READ - HOME PAGE
     **********************************
     */

    $app->get("/", function() use ($app) {
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer_events = null;
        $volunteer_committees = null;
        $supervisor_events = null;
        $supervisor_committees = null;
        if(!(empty($supervisor))) {
            $supervisor_committees = $supervisor->getCommittees();
            $volunteer_events = null;
            $volunteer_committees = null;
        }

        if(!(empty($volunteer))) {
            $volunteer_events = $volunteer->getEvents();
            $volunteer_committees = $volunteer->getCommittees();
            $supervisor_events = null;
            $supervisor_committees = null;
        }

        return $app['twig']->render('index.twig', array('events' => Event::getAll(),
                                                        'committees' => Committee::getAll(),
                                                        'supervisor' => $supervisor,
                                                        'volunteer' => $volunteer,
                                                        'supervisor_events' =>  $volunteer_events,
                                                        'supervisor_committees'=>
                                                        $supervisor_committees,
                                                        'volunteer_committees' =>
                                                        $volunteer_committees));
    });

    /*
    **********************************
    READ - LOGINS
    **********************************
    */





    /*
    **********************************
    CREATE - LOGINS
    **********************************
    */
    $app->get('/volunteer-login', function() use ($app) {
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        return $app['twig']->render('volunteer-login.twig');
    });

    $app->post('/volunteer-login', function() use ($app) {
        $login_success = 1;
        $inputted_username = $_POST['username'];
        $inputted_password = $_POST['password'];
        $volunteer = Volunteer::authenticateLogin($inputted_username, $inputted_password);
        if(!empty($volunteer)) {
            $volunteer_id = $volunteer->getId();
            $_SESSION['volunteer_id'] = $volunteer_id;
            $volunteer_events = $volunteer->getEvents();
            $volunteer_committees = $volunteer->getCommittees();
            $supervisor = Supervisor::find($_SESSION['supervisor_id']);
            $volunteer = Volunteer::find($_SESSION['volunteer_id']);
            $supervisor_committees = null;
            $supervisor_events = null;
            return $app['twig']->render('index.twig', array('volunteer' => $volunteer,
                                                            'volunteer_events' => $volunteer_events,
                                                            'supervisor_events' => $supervisor_events,
                                                            'volunteer_committees' => $volunteer_committees,
                                                            'supervisor_committees' => $supervisor_committees,
                                                            'supervisor' => $supervisor));
        } else {
            $login_success = 0;
            return $app['twig']->render('volunteer-login.twig', array('login_success' => $login_success));
        }
    });

    $app->get('/supervisor-login', function() use ($app) {
        $login_success = 1;
        return $app['twig']->render('supervisor-login.twig', array('login_success' => $login_success));
    });

    $app->post('/supervisor-login', function() use ($app) {
        $login_success = 1;
        $inputted_username = $_POST['username'];
        $inputted_password = $_POST['password'];
        $supervisor= Supervisor::authenticateLogin($inputted_username, $inputted_password);
        if(!empty($supervisor)) {
            $events = Event::getAll();
            $committees = Committee::getAll();
            $supervisor_id = $supervisor->getId();
            $_SESSION['supervisor_id'] = $supervisor_id;
            $volunteer = Volunteer::find($_SESSION['volunteer_id']);
            $supervisor = Supervisor::find($_SESSION['supervisor_id']);
            $supervisor_committees = $supervisor->getCommittees();
            return $app['twig']->render('index.twig', array('supervisor_committees'=>
                                                            $supervisor_committees,
                                                            'events' => $events,
                                                            'supervisor' => $supervisor,
                                                            'events' => $events,
                                                            'volunteer' => $volunteer,
                                                            'committees' => $committees));

        } else {
            $login_success = 0;
            return $app['twig']->render('supervisor-login.twig', array('login_success' => $login_success));
        }
    });

    /*
    **********************************
    READ - CREATE ACCOUNTS
    **********************************
    */

    $app->get('/create-volunteer', function() use ($app) {
        $available = 1;
        return $app['twig']->render('create-volunteer.twig', array('available' => $available));
    });

    /*
    **********************************
    CREATE - CREATE ACCOUNTS
    **********************************
    */

    $app->post('/create-volunteer', function() use ($app) {
        $available = 1;
        $username_exists = Volunteer::checkUsernameExists($_POST['username']);

        if($username_exists === 0) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $admin_stat = 0;
            $new_volunteer = new Volunteer($first_name, $last_name, $email, $phone, $username, $password, $admin_stat);
            $new_volunteer->save();
            $new_volunteer_id = $new_volunteer->getId();
            $_SESSION['volunteer_id'] = $new_volunteer_id;
        } else {
            $available = 0;
            return $app['twig']->render('create-volunteer.twig', array('available' => $available));
        }
        return $app['twig']->render('create-volunteer-success.twig', array('volunteer' => $new_volunteer));
    });

    /*
    **********************************
    READ - LOGOUT PAGE
    **********************************
    */
    $app->get('/logout', function() use ($app) {
        return $app['twig']->render('logout.twig');
    });

    $app->post('/logout', function() use ($app) {
        $_SESSION['volunteer_id'] = null;
        $_SESSION['supervisor_id'] = null;
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        return $app['twig']->render('index.twig', array('committees' => Committee::getAll(), 'events' => Event::getAll(), 'volunteer' => $volunteer, 'supervisor' => $supervisor));
    });

    /*
    **********************************
    READ - ALL EVENTS
    **********************************
    */

    $app->get('/events', function() use ($app) {
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        $events = Event::getAll();
        $committees = Committee::getAll();
        if($volunteer && (empty($supervisor))) {
            $volunteer_events = $volunteer->getEvents();
        } elseif ($supervisor && (empty($volunteer))) {
            $volunteer_events = null;
            $supervisor_committees = $supervisor->getCommittees();
        } else {
            $volunteer_events = null;
        }

        return $app['twig']->render('events.twig', array('events' => $events,
                                                        'supervisor' => $supervisor,
                                                        'volunteer' => $volunteer,
                                                        'volunteer_events' => $volunteer_events,
                                                        'committees' => $committees));
    });

    $app->post('/create-event', function() use ($app) {
        $event_name = $_POST['event_name'];
        $event_date = $_POST['event_date'];
        $location = $_POST['location'];
        $new_event = new Event($event_name, $event_date, $location);
        $new_event->save();
        //Grab all checked committees
        $checked = [];
        $committees = $_POST['committees'];
        foreach($committees as $committee_id) {
            $new_committee = Committee::find($committee_id);
            array_push($checked, $new_committee);
        }
        //For each checked committee, add the event to them.
        foreach($checked as $committee) {
            $new_event->addCommittee($committee);
        }
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        return $app['twig']->render('create-event-success.twig', array('event' => $new_event,
                                                                        'supervisor' => $supervisor));
    });

    $app->get('/event/{id}', function($id) use ($app) {
        $event = Event::find($id);
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        return $app['twig']->render('event.twig', array('event' => $event, 'supervisor' => $supervisor, 'volunteer' => $volunteer));
    });

    $app->get('/edit/event/{id}', function($id) use ($app) {
        $event = Event::find($id);
        $all_committees = Committee::getAll();
        $committees = $event->getCommittees();
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        return $app['twig']->render('event-edit.twig', array('event' => $event, 'supervisor' => $supervisor, 'volunteer' => $volunteer, 'committees' => $committees, 'all_committees' => $all_committees));
    });

    $app->patch('/event/{id}', function($id) use ($app) {
        $event = Event::find($id);
        $new_event_name = $_POST['event_name'];
        $new_event_date = $_POST['event_date'];
        $new_location = $_POST['location'];
        $event->update($new_event_name, $new_event_date, $new_location);

        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);

        return $app['twig']->render('event.twig', array('event' => $event, 'supervisor' => $supervisor, 'volunteer' => $volunteer));
    });

    $app->delete('/delete/event/{id}', function($id) use ($app) {
        //delete event
        $selected_event = Event::find($id);
        $selected_event->delete();

        //gather info to route to index.twig
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer_events = null;
        $volunteer_committees = null;
        $supervisor_events = null;
        $supervisor_committees = null;
        if(!(empty($supervisor))) {
            $supervisor_committees = $supervisor->getCommittees();
        }

        if(!(empty($volunteer))) {
            $volunteer_events = $volunteer->getEvents();
            $volunteer_committees = $volunteer->getCommittees();
        }

        return $app['twig']->render('index.twig', array('events' => Event::getAll(),
                                                        'committees' => Committee::getAll(),
                                                        'supervisor' => $supervisor,
                                                        'volunteer' => $volunteer,
                                                        'supervisor_events' =>  $volunteer_events,
                                                        'supervisor_committees'=>
                                                        $supervisor_committees,
                                                        'volunteer_committees' =>
                                                        $volunteer_committees));
    });

    /*
    **********************************
    READ - ALL COMMITTEES
    **********************************
    */
    $app->get('/committees', function() use ($app) {
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        if($volunteer && (empty($supervisor))) {
            $volunteer_committees = $volunteer->getCommittees();
            $supervisor_committees = null;
        } elseif ($supervisor && (empty($volunteer))) {
            $volunteer_committees = null;
            $supervisor_committees = $supervisor->getCommittees();
        } else {
            $volunteer_committees = null;
            $supervisor_committees = null;
        }
        $committees = Committee::getAll();
        return $app['twig']->render('committees.twig', array('committees' => $committees,
                                                        'supervisor' => $supervisor,
                                                        'volunteer' => $volunteer,
                                                        'volunteer_committees' => $volunteer_committees,
                                                        'supervisor_committees' => $supervisor_committees));
    });

    /*
    **********************************
    READ - INDIVIDUAL COMMITTEE
    **********************************
    */
    $app->get('/committee/{id}', function($id) use ($app) {
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);

        $selected_committee = Committee::find($id);
        $volunteers_associated = $selected_committee->getVolunteers();
        $supervisors_associated = $selected_committee->getSupervisors();
        $events_associated = $selected_committee->getEvents();
        return $app['twig']->render('committee.twig', array('supervisor' => $supervisor,
                                                            'volunteer' => $volunteer,
                                                            'selected_committee' => $selected_committee,
                                                            'volunteers_associated' => $volunteers_associated,
                                                            'supervisors_associated'=>
                                                            $supervisors_associated,
                                                            'events_associated'=>
                                                            $events_associated));
    });

    $app->get('/volunteer/{id}', function($id) use ($app) {
        $selected_volunteer = Volunteer::find($id);
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        return $app['twig']->render('volunteer.twig', array('selected_volunteer' => $selected_volunteer, 'supervisor' => $supervisor, 'volunteer' => $volunteer));
    });

    $app->delete('/delete/volunteer/{id}', function($id) use ($app) {
        $selected_volunteer = Volunteer::find($id);
        $selected_volunteer->delete();
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        return $app['twig']->render('admin.twig', array('volunteers' => Volunteer::getAll()));
    });

    $app->get('/edit/volunteer/{id}', function($id) use ($app) {
        $selected_volunteer = Volunteer::find($id);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        return $app['twig']->render('volunteer-edit.twig', array('selected_volunteer' => $selected_volunteer, 'volunteer' => $volunteer, 'supervisor' => $supervisor));
    });

    $app->patch('/volunteer/{id}', function($id) use ($app) {
        $selected_volunteer = Volunteer::find($id);
        $new_first_name = $_POST['first_name'];
        $new_last_name = $_POST['last_name'];
        $new_email = $_POST['email'];
        $new_phone = $_POST['phone'];
        $new_username = $_POST['username'];
        $new_password = $_POST['password'];
        $admin_stat = 0;
        $selected_volunteer->update($new_first_name, $new_last_name, $new_email, $new_phone, $new_username, $new_password, $admin_stat);
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        return $app['twig']->render('volunteer.twig', array('selected_volunteer' => $selected_volunteer, 'supervisor' => $supervisor, 'volunteer' => $volunteer));
    });

    $app->get('/admin', function() use ($app) {
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        return $app['twig']->render('admin.twig', array('volunteers' => Volunteer::getAll()));
    });

    return $app;

?>
