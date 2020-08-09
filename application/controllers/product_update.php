<?php
namespace Application\Controller;

use Concrete\Core\Controller\Controller;

use Concrete\Package\CommunityStore\Src\CommunityStore\Product\Product;
use Concrete\Package\CommunityStore\Src\Attribute\Key\StoreProductKey as StoreProductKey;
use Concrete\Package\CommunityStore\Src\CommunityStore\Product\ProductLocation as StoreProductLocation;
use Concrete\Package\CommunityStore\Src\CommunityStore\Product\ProductImage as StoreProductImage;
use Concrete\Package\CommunityStore\Src\CommunityStore\Group\Group as StoreGroup;
use Concrete\Package\CommunityStore\Src\CommunityStore\Product\ProductGroup;

use Concrete\Core\User\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Concrete\Core\Http\ResponseFactory;
//use Concrete\Controller\SinglePage\PageNotFound;

defined('C5_EXECUTE') or die('Access Denied.');

class ProductUpdate extends Controller {
    public function editProduct()
    {        
        $jsonObject= json_decode(file_get_contents('php://input'), FALSE);

        if ($this->validate($jsonObject, true)) {
//            $row['psku'] = $jsonObject['psku'];
//            $row['pprice'] = $jsonObject['pPrice'];
//            $row['pqty'] = $jsonObject['pQty'];
            
            $row['psku'] = $jsonObject->psku;
            $row['pprice'] = $jsonObject->pPrice;
            $row['pqty'] = $jsonObject->pQty;
            
            $p = Product::getBySKU($row['psku']);
            if ($p instanceof Product) {
                $this->update($p, $row);
            } else {
                 return new JsonResponse(t('Unknown Product'));
            }
            
            return new JsonResponse(t('Successfully Updated the product'));
        } else {
            return new JsonResponse(t('Invalid Creditionals', 401));
        }
    }
    
    protected function update($p, $row)
    {
        if ($row['psku']) $p->setSKU($row['psku']);
        if ($row['pqty']) $p->setQty($row['pqty']);
        if ($row['pprice']) $p->setPrice($row['pprice']);

        $p = $p->save();

        return $p;
    }    
    
    public function startHandshake()
    {

        $jsonObject = json_decode($this->get('data'), false);
        if ($this->validate1($jsonObject, false))    {
            $userID = $this->app->make('helper/validation/numbers')->integer($jsonObject->userID);
            $expires = time() + 500;

            $newToken = $this->generateValidToken($jsonObject->clientID, $userID, $expires);

            $jsonResponse = [
                'token' => $newToken,
                'expires' => $expires
            ];
            return new JsonResponse($jsonResponse, 200);

        } else {
            return new JsonResponse(t('Invalid Creditionals'),401);
        }

    }
    protected function validate($jsonObject, $containsToken = true){
        return true;
    }
    // Send our Json object and declare if it contains a token or not
    protected function validate1($jsonObject, $containsToken = true)
    {
        if (!is_object($jsonObject)) {
            // Simple if it isn't an object it is invalid
            return false;
        }
        // If it contains token we will need to verify its expiry and token
        if ($containsToken === true) {

            // Validate token
            if (!$this->validateToken($jsonObject)) {
                return false;
            }
            // Check if expired
            if ($jsonObject->expires < time()) {
                return false;
            }
        }
        // Validate Client ID
        if (!$this->validateClientID($jsonObject->clientID, $jsonObject->userID)) {
            return false;
        }
        // Validate Secret ID
        if ($jsonObject->secret !== $this->getSecret()) {
            return false;
        }
        // If we get to here then it is 100% valid
        return true;
    }
    
    protected function generateValidToken($clientID, $userID, $expires = 360)
    {
        return $this->app->make('token')->generate($clientID.':'.$userID.':'.$expires);
    }
    
    // Validate our token using concrete5's built in token class (returns true or false)
    protected function validateToken($jsonObject)
    {
        return $this->app->make('token')->validate($jsonObject->clientID.':'.$jsonObject->userID.':'.$jsonObject->expires, $jsonObject->token);
    }
    // Validate our clientID by generating a new one and comparing
    protected function validateClientID($clientID, $userID)
    {
        if ($clientID !== $this->generateClientID($userID)) { 
            return false;
        } else {
            return true;
        }
    }
    protected function generateClientID($userID)
    {
        $clientID = null;
         // Get User Object from userID
        $userObject = User::getByUserID($userID);
        if (is_object($userObject)) {
            // Get the user info object if userObject is a valid object
            $userInfo = $userObject->getUserInfoObject();
            if (is_object($userInfo)) {
                 // Get the user's email, displayname and the date they joined
                $part1 = $userInfo->getUserEmail();
                $part2 = $userInfo->getUserDisplayName();
                $part3 = 'null';
                 // combine these three into a hexadecimal string
                $clientID = bin2hex($part1.':'.$part3.':'.$userID.':'.$part2);
                // trim the string into a shorter string
                if (strlen($clientID > 64)) {
                    $clientID = substr($clientID, 0, 64);
                }
            }
            return $clientID;
        } else {
            return false;
        }
    } 
    protected function getSecret()
    {
        $secret = $this->app->make('config')->get('concrete.api.secret');
        if (empty($secret)) {
            $secret = bin2hex(openssl_random_pseudo_bytes(64));
            $this->app->make('config')->save('concrete.api.secret', $secret);
        }
        return $secret;
    }
    
    public function getDetails()
    {
        // Get the current user object
        $user = new User();
        if ($user->isSuperUser()) {
         // If the current user is a super then return our secret and clientID
            $jsonArray = [
                'secret'=> $this->getSecret(),
                'clientID' => $this->generateClientID($user->getUserID())
            ];
            return new JsonResponse($jsonArray, 200);
        } else {
            // If they are not a super user then make the route show a 404 page not found
            $content = $this->app->make(PageNotFound::class);
            return $this->app->make(ResponseFactory::class)->notFound($content);
        }
    }                   
}