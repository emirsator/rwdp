<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Helpers\GridColumn;
use App\Helpers\GridHelper;
use App\Helpers\UserHelper;

use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\Interfaces\UserDocumentServiceInterface;

use App\Http\Requests\StoreUserRequest;

use App\Models\User;

use Lang;

class UserController extends Controller
{    
    protected $roleService;
    protected $userService;
    protected $userDocumentService;

    public function __construct(
        RoleServiceInterface $roleService, 
        UserServiceInterface $userService,
        UserDocumentServiceInterface $userDocumentService)
	{
        $this->roleService = $roleService;
        $this->userService = $userService;
        $this->userDocumentService = $userDocumentService;
    }
    
    // GET /user
    public function index(UserServiceInterface $userServiceInterface)
    {
        $columns = array();
        $url = url('user');

        $email = new GridColumn("email", Lang::get('label.email'), "", $url, "id");
        $email->IsSortable = true;
        $email->FilterColumnName = "email";
        array_push($columns, $email);

        $grid = GridHelper::generateGrid($userServiceInterface->getUserSelectQuery(), $columns, 15);

        return view('users.index', compact('grid'));
    }

    public function delete($userId)
    {
        $user = User::find($userId);
        
        $user->is_active = 0;

        $this->userService->storeUser($user);

        return redirect()->route('users');
    }

    // GET /user/{id}
    public function details($userId)
    {
        $user = $this->userService->selectById($userId);
        if (!isset($user))
        {
            abort(404);
        }

        $roles = $this->roleService->selectAll();
        $userRoles = $this->userService->getUserRoles($userId);

        $documents = $this->userDocumentService->getAllUserDocuments($userId);

        $userRoleModifyUrl = url('user/' . $userId . '/role');

        return View('users.details', compact('user', 'roles', 'userRoles', 'documents', 'userRoleModifyUrl'));
    }

    // GET /user/create
    public function createview()
    {
        $user = new User();

        return View('users.create', compact('user'));
    }

    // POST /user/create
    public function create(StoreUserRequest $request)
    {
        $password = Hash::make($request->password);
        
        $user = new User;
        $user->email = $request->email;
        $user->password = $password;

        $this->userService->storeUser($user);
        
        return redirect()->route('users.roles', [$user->id]);
    }

    // POST /user/{id}/role
    public function addRole(Request $request)
    {
        $request = request();

        $this->validate($request, [
            'parent_id' => 'required',
            'reference_id' => 'required'
        ]);

        $user = $this->userService->selectById($request->parent_id);

        if (!isset($user))
        {
            abort(404);
        }

        if($user->roles->contains('id', $request->reference_id))
        {
            abort(500);
        }

        $newRoleUserId = $this->userService->addRoleToUser($request->parent_id, $request->reference_id);

        return response()->json([
            'success' => 'true',
            'id' => $newRoleUserId
        ], 200);
    }

    // GET /user/{id}/roles
    public function roles($userId)
    {
        $user = $this->userService->selectById($userId);

        if (!isset($user))
        {
            abort(404);
        }

        $unassignedroles = $this->userService->getUnassignedRoles($userId)->pluck('description', 'id');

        return View('users.roles', compact('user', 'unassignedroles'));
    }

    // DELETE /user/{id}/role
    public function deleteRole($userId, $roleUserId)
    {
        $user = $this->userService->selectById($userId);

        if (!isset($user))
        {
            return response()->json(null, 404);
        }

        $roleUser = $this->roleService->selectRoleUserById($roleUserId);
        if (!isset($roleUser))
        {
            return response()->json("Role not found!", 404);
        }

        $this->userService->removeRoleFromUser($userId, $roleUser->role_id);

        return response()->json(null, 200);
    }

    // GET /user/edit/{id}
    public function editview($userId)
    {
        $user = $this->userService->selectById($userId);

        if (!isset($user))
        {
            abort(404);
        }

        return View('users.edit', compact('user'));
    }

    // PUT /user/edit
    public function edit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
        ]);
        
        $user = $this->userService->selectById($request->id);

        if(!isset($user))
        {
            abort(404);
        }

        $user->email = $request->email;

        $this->userService->storeUser($user);
        
        $user->save();

        return redirect()->route('users.details', [$user->id]);
    }

    // POST /user/{id}/document
    public function adddocument(Request $request, $userId)
    {
        if (!isset($request->document))
        {
            return redirect()->route('users.details', [$userId]);
        }

        $this->userDocumentService->createUserDocument('user'.DIRECTORY_SEPARATOR.'documents', $request->document, $userId);

        return redirect()->route('users.details', [$userId]);
    }
}
