<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\App;
use App\Models\GuestBooksModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GuestAccessFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('is_admin') == 0){
            $requestedId = $request->getUri()->getSegments()[1];
            
            $guestBookModel = new GuestBooksModel();
            $allowedIds = $guestBookModel->getIdGuests(session()->get('email'));

            if(!in_array($requestedId, $allowedIds)){
                throw PageNotFoundException::forPageNotFound();
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
