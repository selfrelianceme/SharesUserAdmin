<?php

namespace Selfreliance\SharesUserAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Shares;
use PaymentSystem;
use App\User;
use Balance;
class SharesUserAdminController extends Controller
{
	public function index(){
		$shares = Shares::get_list_user_shares_buy();
		// dd($shares);
		return view('sharesuseradmin::table')->with(compact('shares'));
	}

	public function create(){
		$shares = Shares::getSharesListSingle();
		return view('sharesuseradmin::create')->with(compact('shares'));
	}

	public function store(Request $request){
		$this->validate($request, [
			'user_email'  => 'required|exists:users,email',
			'shares'      => 'required|exists:shares,id',
			'amount'      => 'required',
			'transaction' => 'required|unique:users__histories,transaction'
        ]);
		$user = User::where('email', $request->input('user_email'))->first();
        $shares = Shares::getSharesListSingle();
        $find_shares = $shares->where('id', $request->input('shares'))->first();
        // dd($find_shares);
        Balance::actionBalance([
            'type'           => 'ADD_FUNDS',
            'user_id'        => $user->id,
            'payment_system' => $find_shares->payment_system,
            'amount'         => $request->input('amount'),
            'status'         => 'completed',
            'transaction'    => $request->input('transaction'),
            'is_balance'     => 0,
        ], 'buy');

        Shares::buyShares([
			'amount'         => $request->input('amount'),
			'payment_system' => $find_shares->payment_system,
        ], $user);

        \Session::flash('success','Токен успешно создан');
        return redirect()->back();
	}
}