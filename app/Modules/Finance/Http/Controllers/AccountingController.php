<?php

namespace App\Modules\Finance\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Finance\Models\Accountdivisions;
use App\Modules\Finance\Models\Accountfunctions;
use App\Modules\Finance\Models\Accounts;
use App\Modules\Finance\Models\Accounttypes;
use App\Modules\Finance\Models\Incomes;
use App\Modules\Core\Helpers\UserAccounts;
use App\Modules\Core\Helpers\StudentsDetails;
use App\Modules\Finance\Models\Termfees;


class AccountingController extends Controller
{
    //
    
    /**
     * Send fees invoices to all students of a given
     * class for a give term of the year.
     * 
     * @param \Illuminate\Http\Request $request
     * @return method 
     */
    public function invoice_fees(Request $request)
    {
        $termfees = Termfees::where('class', '=', $request->input('invclass'))->where('year', '=', $request->input('invyear'))->where('term', '=', $request->input('invterm'))->get();
        if(count($termfees) < 1){
            return $this->payform()->with('error', 'First set the fees then invoice');
        }
        $total = 0;
        $desc = "FEES-TERM".$request->input('invterm');
        foreach($termfees as $fee){
            $total += $fee->amount;
        }
        
        foreach(StudentsDetails::get_class_students($request->input('invclass'), $request->input('invyear')) as $student){
            $inv_no = "IN". date('y') . $student->admno . rand(0, 100);            

            $invoice = Invoices::firstOrCreate(['admno' => $student->admno, 'invoice_no' => $inv_no, 'invoice_date' => date("d-M-Y"),
                                    'description' => $desc, 'invoice_amount' => $total, 'year' => $request->input('invyear'), 'term' => $request->input('invterm')]);
            
        }
        $action = "Invoiced class " . $request->input('invclass') . " term " . $request->input('invclass') . " Fees, amount: " . $total;
        UserAccounts::system_audit(auth()->user()->id, $action);
        
        return $this->payform()->with('success', 'Invoices added');
    }
    
    /**
     * Display the accounts view
     * 
     * @return \Illuminate\View\View
     */
    public function accounts()
    {
        $accounts = Accounts::all();
        $types = Accounttypes::all();
        $functions = Accountfunctions::all();
        $divisions = Accountdivisions::all();
        return view('finance::finance.accounts', ['accounts' => $accounts, 'divisions' => $divisions, 'types' => $types, 'functions' => $functions]);
    }
    
    /**
     * Create a new account
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function new_accounts(Request $request)
    {
        if(request()->ajax()){
            $typcode = Accounttypes::where('id', '=', $request->input('acctype'))->first();
            $tpcode = $typcode->code;
            //get the next ID to generate the correct account code
            $nxtidis = Accounts::orderBy('id', 'desc')->first();
            if(count($nxtidis) < 1){
                $nxtacc = 1;
            } else{
                $nxtacc = $nxtidis->id + 1;
            }
            $acccode = $tpcode.' 0'.$nxtacc;
            
            $acc = Accounts::firstOrCreate(['accode' => $acccode, 'name' => $request->input('accname'), 'division' => $typcode->division,
                                    'votehead' => $request->input('acctype'), 'status' => $request->input('accstatus')]);
            

            $action = "Added new account, code " . $acccode;
            UserAccounts::system_audit(auth()->user()->id, $action);

            $accounts = Accounts::all();
            return response()->json($accounts);
        }
    }
    
    
    /**
     * Create a new account function in the chart of accounts
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function new_accounts_functions(Request $request)
    {
        if(request()->ajax()){
            //div
            $acdiv = $request->input('funcaccdivision');
            //get the next ID to generate a suitable account code.
            $nxtidis = Accountfunctions::where('division_id', $acdiv)->orderBy('id', 'desc')->get();
            if(count($nxtidis)< 1){
                $nxtfunc = 1;
            } else{
                $nxtfunc = count($nxtidis) + 1;
            }
            $code = $acdiv. ' 0' .$nxtfunc;
            
            $func = Accountfunctions::firstOrCreate(['name' => $request->input('funcaccname'), 'code' => $code, 'division_id' =>$request->input('funcaccdivision')]);
                      
            $action = "Added new account function, code " . $code;
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            $functions = Accountfunctions::all();
            return response()->json($functions);
        }
    }
    
    /**
     * Create a new account type in the chart of accounts
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function new_accounts_types(Request $request)
    {
        if(request()->ajax()){
            
            $accfunc = Accountfunctions::where('id', '=', $request->input('accfunc'))->first();
            $accfun = $accfunc->code;
            //get the next ID to generate the correct account code
            $nxtidis = Accounttypes::orderBy('id', 'desc')->first();
            if(count($nxtidis) < 1){
                $nxttype = 1;
            } else{
                $nxttype = $nxtidis->id + 1;
            }
            $typecode = $accfun.' 0'.$nxttype;
            
            $typ = Accounttypes::firstOrCreate(['name' => $request->input('acctypename'), 'description' => $request->input('acctypedescription'), 'function' => $request->input('function'),
                                'division' => 1, 'code' => $typecode, 'status' => 'Active']);
            
            $action = "Added new account Type, " . Input::get('acctypename');
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            $types = Accounttypes::all();
            return response()->json($types);
        }
    }
    
    public function account_statement($admno){
        $invoices = \App\Modules\Finance\Helpers\FinanceFunctions::std_invoices($admno);
        return view('finance::finance.accountstatement', ['invoices' => $invoices, 'admno' => $admno]);
    }
}
