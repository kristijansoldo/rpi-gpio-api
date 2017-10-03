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
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;
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
		// Create a GPIO object
		$gpio = new GPIO();
		// Retrieve $pin and configure it as an output pin
		$gpioPin = $gpio->getOutputPin( $pin );
		// Set the value of the pin high (turn it on)
		$gpioPin->setValue( $value );
		// Get value
		$data = $gpioPin->getValue();

		// Returns
		return $this->jsonResponse( $data );
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
		// Create a GPIO object
		$gpio = new GPIO();
		// Retrieve $pin and configure it as an input pin
		$gpioPin = $gpio->getInputPin( $pin );
		// Configure interrupts for both rising and falling edges
		$gpioPin->setEdge( InputPinInterface::EDGE_BOTH );
		// Sets data
		$data = $gpioPin->getValue();

		// Returns
		return $this->jsonResponse( $data );
	}

}