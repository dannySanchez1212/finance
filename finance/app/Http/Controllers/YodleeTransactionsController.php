<?php

namespace App\Http\Controllers;

use App\Tenancy;
use App\YodleeTransaction;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YodleeTransactionsController extends Controller
{
    public function index()
    {
	    $transactions = YodleeTransaction::all();
        return view('yodlee.index', compact('transactions'));
    }
    public function edit(YodleeTransaction $yodlee)
    {   
        $tenancies = Tenancy::pluck('id','id');
        return view('yodlee.edit', compact('yodlee','tenancies'));
    }
    public function deleteTenancy(YodleeTransaction $yodlee)
    {
        try {
            $yodlee->tenancy_id = null;
            $yodlee->save();
            flash(trans('messages.success'), 'success');
        } catch (\Exception $e) {
            flash(trans('messages.exception'), 'danger');
        }
        return back();
    }
    public function update(YodleeTransaction $yodlee, Request $request)
    {
        try {
            $yodlee->tenancy_id = $request->get('tenancy');
            $yodlee->save();
            flash(trans('messages.success'), 'success');
        } catch (\Exception $e) {
            flash(trans('messages.exception'), 'danger');
        }

        return redirect(route('yodlee.index'));
    }
    public function refresh(){
    	$client = new GuzzleClient();
        $res = $client->post(getenv('YODLEEAPI_URL').'/v1/cobrand/login', 
        ['json' => ["cobrand" => [
            'cobrandLogin' => getenv('YODLEEAPI_COBRAND_LOGIN'),
            'cobrandPassword' => getenv('YODLEEAPI_COBRAND_PASSWORD'),
        ]]])->getBody();

        $cobSession = json_decode($res)->session->cobSession;

        $res2 = $client->post(getenv('YODLEEAPI_URL').'/v1/user/login', [
        'headers' => [
            'Authorization' => '{cobSession='.$cobSession.'}',
        ],'json' => ["user" => [
            'loginName' => getenv('YODLEEAPI_USER_LOGIN'),
            'password' => getenv('YODLEEAPI_USER_PASSWORD'),
        ]]])->getBody();

        $userSession = json_decode($res2)->user->session->userSession;

        $res3 = $client->get(getenv('YODLEEAPI_URL').'/v1/transactions', [
        'headers' => [
            'Authorization' => '{cobSession='.$cobSession.',userSession='.$userSession.'}',
        ]])->getBody();

        $yodlees = json_decode($res3);

        print_r($yodlees);
         //echo('<br>');
        //print_r($userSession);

        /*foreach ($yodlees->transaction as  $key => $yodlee) {

            $tenancy_id = Tenancy::select('id')
            ->WhereRaw("? LIKE concat('%',rent_payment_reference,'%')", $yodlee->description->original)
            ->orWhereRaw("? LIKE concat('%',deposit_payment_reference,'%')", $yodlee->description->original)
            ->orWhereRaw("? LIKE concat('%',holding_deposit_payment_reference,'%')", $yodlee->description->original)
            ->orWhereRaw("? LIKE concat('%',REPLACE(rent_payment_reference, '-', ''),'%')", $yodlee->description->original)
            ->orWhereRaw("? LIKE concat('%',REPLACE(deposit_payment_reference, '-', ''),'%')", $yodlee->description->original)
            ->orWhereRaw("? LIKE concat('%',REPLACE(holding_deposit_payment_reference, '-', ''),'%')", $yodlee->description->original)
            ->first();

            $db_yodlee = YodleeTransaction::UpdateOrcreate(
				[	"id"  => $yodlee->id],
		        [
		          	"container" => $yodlee->CONTAINER,
		          	"amount" => json_encode ($yodlee->amount),
					"baseType" => $yodlee->baseType,
					"categoryType" => $yodlee->categoryType,
					"categoryId" => $yodlee->categoryId,
					"category" => $yodlee->category,
					"categorySource" => $yodlee->categorySource,
					"createdDate" => $yodlee->createdDate,
					"lastUpdated" => $yodlee->lastUpdated,
					"description" => $yodlee->description->original,
					"type" => $yodlee->type,
					"subType" => $yodlee->subType,
					"isManual" => $yodlee->isManual,
					"date" => $yodlee->date,
					"transactionDate" => $yodlee->transactionDate,
					"postDate" => $yodlee->postDate,
					"status" => $yodlee->status,
					"accountId" => $yodlee->accountId,
					"runningBalance" => json_encode ($yodlee->runningBalance),
					"highLevelCategoryId" => $yodlee->highLevelCategoryId,
                    "tenancy_id" => $tenancy_id ? $tenancy_id->id : null
		        ]
		     );
	    }*/
	    return view('admin.refresh');
    }
}
