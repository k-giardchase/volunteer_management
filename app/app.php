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

        return $app['twig']->render('index.twig', array('events' => Event::getAll(),
                                                        'committees' => Committee::getAll(),
                                                        'supervisor' => $supervisor,
                                                        'volunteer' => $volunteer));
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
            $SESSION['volunteer_id'] = $volunteer_id;
            $events = $volunteer->getEvents();
            $committees = $volunteer->getCommittees();
        } else {
            $login_success = 0;
            return $app['twig']->render('volunteer-login.twig', array('login_success' => $login_success));
        }
        return $app['twig']->render('index.twig', array('volunteer' => $volunteer,
                                                        'events' => $events,
                                                        'committees' => $committees,
                                                        'supervisor' => $supervisor));
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
            $supervisor_id = $supervisor->getId();
            $_SESSION['supervisor_id'] = $supervisor_id;
            $committees = $supervisor->getCommittees();
            $events = Event::getAll();
            $volunteer = Volunteer::find($_SESSION['volunteer_id']);

        } else {
            $login_success = 0;
            return $app['twig']->render('supervisor-login.twig', array('login_success' => $login_success));
        }
        return $app['twig']->render('index.twig', array('committees' => $committees,
                                                        'supervisor' => $supervisor,
                                                        'events' => $events,
                                                        'volunteer' => $volunteer));
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

    $app->get('/events', function() use ($app) {
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);
        if($volunteer) {
            $volunteer_events = $volunteer->getEvents();
        } else {
            $volunteer_events = null;
        }
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        $events = Event::getAll();
        return $app['twig']->render('events.twig', array('events' => $events,
                                                        'supervisor' => $supervisor,
                                                        'volunteer' => $volunteer,
                                                        'volunteer_events' => $volunteer_events));
    });

    return $app;

?>
