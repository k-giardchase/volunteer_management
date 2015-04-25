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
     if (empty($_SESSION['admin_stat'])) {
         $_SESSION['admin_stat'] = null;
     };

    $app->get("/", function() use ($app) {
        $volunteer = Volunteer::find($_SESSION['volunteer_id']);
        $supervisor = Supervisor::find($_SESSION['supervisor_id']);

        if($volunteer) {
            $volunteer_admin_stat = $volunteer->getAdminStat();
        } else {
            $volunteer_admin_stat = null;
        }
        if($supervisor) {
            $supervisor_admin_stat = $supervisor->getAdminStat();
        } else {
            $supervisor_admin_stat = null;
        }
        return $app['twig']->render('index.twig', array('events' => Event::getAll(),
                                                        'committees' => Committee::getAll(),
                                                        'volunteer' => $volunteer,
                                                        'supervisor' => $supervisor,
                                                        'supervisor_admin_stat' => $supervisor_admin_stat,
                                                        'volunteer_admin_stat' => $volunteer_admin_stat));
    });

    $app->get('/supervisor-login', function() use ($app) {

        return $app['twig']->render('supervisor-login.twig');
    });

    $app->get('/volunteer-login', function() use ($app) {
        return $app['twig']->render('volunteer-login.twig');
    });

    $app->get('/create-volunteer', function() use ($app) {
        $available = 1;
        return $app['twig']->render('create-volunteer.twig', array('available' => $available));
    });

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
        return $app['twig']->render('create-volunteer-success.twig', array('volunteer' => $new_volunteer,
                                                                            'volunteer_id' => $_SESSION['volunteer_id'],
                                                                            'supervisor_id' => $_SESSION['supervisor_id'],
                                                                            'admin_stat' => $_SESSION['admin_stat']));
    });

    return $app;

?>
