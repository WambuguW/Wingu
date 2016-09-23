<?php
namespace App\Modules\Finance\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Finance\Helpers\FinanceFunctions;
use App\Modules\Core\Helpers\UserAccounts;
use App\Modules\Core\Helpers\StudentsDetails;
use App\Modules\Finance\Models\Incomes;
use App\Modules\Finance\Models\Accounts;
use App\Modules\Finance\Models\Termfees;
use App\Modules\Finance\Models\Invoices;
use App\Modules\Finance\Models\Feepayment;
use App\Modules\Core\Models\Classes;
use App\Modules\Core\Models\Studentdetails;
use App\Modules\Core\Models\Banks;

class FeesController extends Controller
{
    //
    public function post_student_fees(Request $request)
    {
        if(FinanceFunctions::post_studentss_fees($request->input('admno'), $request->input('bank'), $request->input('chequeno'), $request->input('term'), $request->input('year'), $request->input('paydate'), $request->input('amount'))){
            
            $income = Incomes::firstOrCreate(['paid_by' => $request->input('admno'), 'receiptno' => $request->input('chequeno'), 'account_id' => 1,
                        'term' => $request->input('term'), 'year' => $request->input('year'), 'amount' => $request->input('amount'), 'bank_id' => $request->input('bank'),
                        'description' => 'School Fees', 'date' => $request->input('paydate'), 'status' => 'Complete']);
           
            //generate receipt 
            return FinanceFunctions::print_fees_receipt($request->input('chequeno'), $request->input('admno'));
            
        } else{
            //
            return $this->payform()->with('error', 'Failed! Ensure you have set the fees for this term.');
        }
    }
    
    public function payform()
    {
        $stude = Studentdetails::all();
        $banks = Banks::all();
        $classes = Classes::all();
        $feesaccounts = Accounts::where('votehead', '=', '1')->get();
        return view('finance::finance.feepayment', ['stude' => $stude, 'banks' => $banks, 
                                                        'feesaccounts' => $feesaccounts, 'classes' => $classes]);
    }
    
    public function payoutform()
    {
        return view('finance::finance.payout');
    }
    
    public function set_fees()
    {
        $fees_account = Accounts::where('type_id', '=', '1')->get();
        $classes = Classes::all();
        return view('finance::finance.setfees', ['fees_accounts' => $fees_account, 'classes' => $classes]);
    }
    
    public function set_semester_fees(Request $request)
    {
        $amounts = $request->input('accamounts');
        foreach($amounts as $amount){
            if($amount == ''){
                return $this->set_fees()->with('error', 'Please fill in all fields.');
            }
        }
        
        $selects = $request->input('accids');
        $amts = $request->input('accamounts');
        
        for($i = 0; $i < count($selects); $i++){
            $ifexists = Termfees::where('class', '=', $request->input('class'))->where('term', '=', $request->input('term'))
                    ->where('year', '=', $request->input('year'))->where('account_id', '=', $selects[$i])->first();
            if(count($ifexists) > 0){
                
            } else{
                $fees = Termfees::create(['class' => $request->input('class'), 'term' => $request->input('term'), 'year' => $request->input('year'), 
                                    'account_id' => $selects[$i], 'amount' => $amts[$i]]);

                $action = "Set school fees for class " . $request->input('class') . ", term " . $request->input('term') . ", " . $request->input('year') . ", account " . FinanceFunctions::get_account_name($selects[$i]);
                UserAccounts::system_audit(auth()->user()->id, $action);
            }
        }
        return $this->set_fees()->with('success', 'Success. Fees for the term set.');        
        
    }    
    
    /**
     * Create fees invoices for students in a given class for a given term of a given year.
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
    
    
    public function fees_paid()
    {
        return view('finance::finance.feespaid');
    }
    
    public function view_fees_paid(Request $request)
    {        
        $feespaid = Feepayment::where('term', '=', $request->input('term'))->where('year', '=', $request->input('year'))
                                ->groupBy('admno')->get();
        return view('finance::finance.viewfeespaid', ['feespaid' => $feespaid, 'term' => $request->input('term'), 'year' => $request->input('year')]);
    }  
    
    public function fee_balances()
    {
        return view('finance::finance.feebalances');
    }
    
    public function show_fee_balances(Request $request)
    {
        $students_with_balance = FinanceFunctions::students_with_balance($request);
        return view('finance::finance.viewfeebalances', ['term' => $request->input('bterm'), 'year'=> $request->input('byear'), 'students_with_balance' => $students_with_balance]);
    }
    
    public function fee_structure(){
        $classes = Classes::all();
        return view('finance::finance.feestruct', ['classes' => $classes]);
    }
    
    public function show_fee_structure(Request $request){
        $structure = Termfees::where('class', '=', $request->input('fclass'))->where('term', '=', $request->input('fterm'))
                                ->where('year', '=', $request->input('fyear'))->orderBy('account_id', 'asc')->get();
        if(count($structure) < 1){
            return $this->set_fees()->with('error', 'Fees not yet set.');
        }
        return view('finance::finance.feestructure', ['structure' => $structure, 'class' => $request->input('fclass'), 'term' => $request->input('fterm'), 'year' => $request->input('fyear')]);
    }
}
