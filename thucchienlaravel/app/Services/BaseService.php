<?php

namespace App\Services;

use App\Services\Interfaces\BaseServiceInterface;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;// dlanguagen de thiet lap date
use Illuminate\Support\Facades\Hash;//de // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu






class BaseService implements  BaseServiceInterface
{
	public function __construct(){

	}

	public function currentLanguage(){
		return 2;
	}

				


	}
	