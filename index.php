<?php
// Basics
require_once($_SERVER["DOCUMENT_ROOT"].'/geos/lib/helpers.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/geos/lib/logger.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/geos/lib/control.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/geos/lib/model.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/geos/lib/view.php');

// Models & Views
require_once($_SERVER["DOCUMENT_ROOT"].'/pickpocket/model/pickpocketM.php');
require_once($_SERVER["DOCUMENT_ROOT"].'/pickpocket/view/pickpocketV.php');

/**
 * feed generator controller
 * ________________________________________________________________
 */
class pickpocket extends control
{
  public $appName = 'pickpocket';

  /**
   * Konstruktor
   * _________________________________________________________________
   */
  public function __construct()
  {
    parent::__construct();
  }

  /**
   * fetch
   * _________________________________________________________________
   */
  public function index()
  {
    $model = new pickpocketM();
    $view = new pickpocketV();
    $url = getReqVar('url');
    $xpath = getReqVar('xpath');

    $data = $model->fetchContent($url, $xpath);

    $view->draw($data);
  }
}

$app = new pickpocket();
$app->run();

?>
