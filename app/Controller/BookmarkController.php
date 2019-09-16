<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Exception\NotFoundUserException;
use Bow\Http\Request;
use App\Model\User;

class BookmarkController extends Controller
{
    /**
     * Start point
     *
     * GET /bookmarks
     *
     * @return void
     */
    public function index()
    {
        return $user->bookmarks;
    }

    /**
     * Add a new resource in the information base
     *
     * POST /bookmarks
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $user = $this->currentUser();

        $bookmark = Bookmark::create([
            'link' => $request->link,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'tags' => $request->tags,
            'user_id' => $user->id
        ]);
    }

    /**
     * Allows you to retrieve specific information with an identifier.
     *
     * GET /bookmarks/:id
     *
     * @param mixed $id
     * @return void
     */
    public function show($id)
    {
        $user = $this->currentUser();

        $bookmark = $user->bookmarks()->where('id', $id)->first();

        return $bookmark;
    }

    /**
     * Updating a resource
     *
     * PUT /bookmarks/:id
     *
     * @param Request $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $user = $this->currentUser();

        $bookmark = $user->bookmarks()->where('id', $id)->first();

        $bookmark->setAttribute([
            'link' => $request->link,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'tags' => $request->tags,
        ]);

        $bookmark->touch();
    }

    /**
     * Delete a resource
     *
     * DELETE /bookmarks/:id
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $user = $this->currentUser();

        $bookmark = $user->bookmarks()->where('id', $id)->first();

        $bookmark->delete();
    }

    /**
     * Get the current user
     * 
     * @return User
     */
    public function currentUser()
    {
        $token = policier()->getDecodeToken();

        $data = $token['claims'];

        $user = User::where('id', $data['id'])->first();

        if (is_null($user)) {
            throw new NotFoundUserException('Undefined user');
        }

        return $user;
    }
}
