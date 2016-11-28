<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function add(){
    	if(IS_POST)
    	{
    		//接值
    		$data = I('post.');

    		//判断确认密码与密码
    		if($data['user_pwd'] != $data['repwd'])
    		{
    			$this->error('密码两次输入不一致，请重新输入！');
    		}else{
    			$data['user_pwd']  = md5($data['user_pwd']);
    			$data['user_time'] = date('Y-m-d H:i:s',time());
    			unset($data['repwd']);

    			//添加入库
    			$res               = M('user')->data($data)->add();
    			if($res)
    			{
    				$this->success('添加管理员成功',U('Admin/info'));
    			}else{
	    			$this->error('添加管理员失败！');
    			}
    		}
    	}else{
	        $this->display();
    	}
    }

    public function info(){
    	$user = M('user')->select();
    	$this->assign('user',$user);
	    $this->display();
    }

    public function del(){
		//接值
		$data = I('post.');
		if($data['mode'] == 1)
		{
			$res    = M('User')->where("user_id=".$data['user_id'])->delete();
			//返回
			$result = array();
			if($result){
				$result['error'] = "0";
				echo json_encode($result);
			}else{
				$result['error'] = "1";
				$result['msg']   = "sorry,删除用户失败!";
			// p(json_encode($result));
				echo json_encode($result);
			}
		}else{
			$result = array();
			$result['error'] = "1";
			$result['msg']   = "sorry,接值失败!";
			echo json_encode($result);
		}
    }
}