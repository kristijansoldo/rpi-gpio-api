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
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\InputPinInterface;


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
	 * @var
	 */
	public $gpio;

	/**
	 * GpioController constructor.
	 */
	public function __construct() {
		$this->gpio = new GPIO();
	}

	/**
	 * @Route("/{pin}")
	 * @Method("POST")
	 *
	 * @param         $pin
	 * @param Request $request
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function postAction( $pin, Request $request ) {
		// Get pin value
		$value = intval( $request->query->get( 'value' ) );
		// Parse to integer pin
		$pin = intval( $pin );
		// Retrieve $pin and configure it as an output pin
		$gpioPin = $this->gpio->getOutputPin( 16 );
		// Set the value of the pin high (turn it on)
		$gpioPin->setValue( 1 );

		// Returns
		return $this->jsonResponse( ['value' => $value, 'pin' => $pin]);
	}

	/**
	 * @Route("/{pin}")
	 * @Method("GET")
	 *
	 * @param $pin
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function getAction( $pin ) {
		// Parse to integer pin
		$pin = intval( $pin );
		// Retrieve $pin and configure it as an input pin
		$gpioPin = $this->gpio->getInputPin( $pin );
		// Configure interrupts for both rising and falling edges
		$gpioPin->setEdge( InputPinInterface::EDGE_BOTH );
		// Sets data
		$data = $gpioPin->getValue();

		// Returns
		return $this->jsonResponse( $data );
	}

}