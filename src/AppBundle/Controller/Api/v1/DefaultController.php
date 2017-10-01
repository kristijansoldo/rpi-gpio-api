<?php
/**
 * Created by PhpStorm.
 * User: kristijan
 * Date: 01/10/2017
 * Time: 10:18
 */

namespace AppBundle\Controller\Api\v1;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class DefaultController
 *
 * @since      1.0.0
 * @author     Kristijan Soldo <soldokristijan@yahoo.com>
 * @package    AppBundle\Controller\Api\v1
 */
class DefaultController extends Controller {

	/**
	 * Json response.
	 *
	 * @param $response
	 *
	 * @return Response
	 */
	public function jsonResponse($response) {
		// Json encoded response
		$json_response = json_encode($response);

		// Returns response
		return new Response($json_response);
	}
}