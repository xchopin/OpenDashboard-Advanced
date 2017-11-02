<?php

/*
 * @author  Xavier Chopin <xavier.chopin@univ-lorraine.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Security\Controller;

use Respect\Validation\Validator as V;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Controller\Controller;
use phpCAS;

class AuthController extends Controller
{

    public function login(Request $request, Response $response)
    {
        $cas = $this->container['parameters']['cas'];
        phpCAS::client(CAS_VERSION_2_0, $cas['host'], $cas['port'], '');
        phpCAS::setNoCasServerValidation();
        phpCAS::forceAuthentication();
        phpCAS::getUser();

        return $this->redirect($request, $response, 'home');
    }


    public function logout(Request $request, Response $response)
    {
        $cas = $this->container['parameters']['cas'];
        phpCAS::client(CAS_VERSION_2_0, $cas['host'], $cas['port'], '');
        phpCAS::setServerLogoutURL('http://' . $request->getUri()->getHost());
        phpCAS::logout();
    }
}
