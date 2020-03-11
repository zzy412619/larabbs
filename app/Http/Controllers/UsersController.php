<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
	public function __construct()
	{
		//除了以下动作不需要登录就能访问，其他都要登录
		$this->middleware('auth',[
			'except' =>['show']
		]);
	}
    public function show(User $user)
    {
    	return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
    	$this->authorize('update',$user);
    	return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
    	 $this->authorize('update', $user);
    	// 将用户输入的 姓名，密码等信息赋值给$data,以便对数据更新操作
    	$data = $request->all();

    	if ($request->avatar) {
    		$result = $uploader->save($request->avatar,'avatars',$user->id,416);
    		if($result) {
    			$data['avatar'] = $result['path'];
    		}
    	}

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
