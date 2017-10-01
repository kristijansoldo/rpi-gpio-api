<?php
/**
 * Created by PhpStorm.
 * User: kristijan
 * Date: 01/10/2017
 * Time: 10:13
 */

namespace AppBundle\Controller\Api\v1;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class GpioController
 *
 * @since      1.0.0
 * @author     Kristijan Soldo <soldokristijan@yahoo.com>
 * @package    AppBundle\Controller\Api\v1
 * @Route("/api/v1/gpio");
 */
class GpioController extends DefaultController {


	/**
	 * @Route("/{pin}")
	 * @Method("POST")
	 *
	 * @param         $pin
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function postAction($pin, Request $request) {
		// Get pin value
		$value = $request->query->get('value');
		// Creates data
		$data = ['value' => $value, 'pin' => $pin];
		// Returns
		return $this->jsonResponse($data);
	}

	/**
	 * @Route("/{pin}")
	 * @Method("GET")
	 *
	 * @param $pin
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getAction($pin) {
		// Returns
		return $this->jsonResponse($pin);
	}

}