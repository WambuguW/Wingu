<?php
namespace App\Modules\Finance\Helpers;
use App\Modules\Core\Helpers\UserAccounts;
use App\Modules\Core\Helpers\StudentsDetails;
use App\Modules\Finance\Models\Accountdivisions;
use App\Modules\Finance\Models\Accountfunctions;
use App\Modules\Finance\Models\Accounts;
use App\Modules\Finance\Models\Accounttypes;
use App\Modules\Finance\Models\Incomes;
use App\Modules\Finance\Models\Invoices;
use App\Modules\Finance\Models\Termfees;
use App\Modules\Finance\Models\Feepayment;
use App\Modules\Finance\Models\Banks;
use Illuminate\Http\Request;

class FinanceFunctions
{
    public static function print_fees_receipt($chequeno, $admno)
    {
        $payments = Feepayment::where('receiptno', '=', $chequeno)->get();
        $systemno = self::receipt_system_no($chequeno);
        return view('finance::finance.feereceipt', ['payments' => $payments, 'admno' => $admno, 'success' => 'Payment successful', 'systemno' => $systemno]);
    }
    
    
    /**
     * Check if a student has overpaid for a given account.
     * 
     * @param string $admno
     * @param string $receiptno
     * @param string $systemno
     * @param int $term
     * @param int $year
     * @param int $account_id
     * @return boolean
     */
    public static function account_overpaid($admno, $receiptno, $systemno, $term, $year, $account_id)
    {
        if($term >= 2){
            $theterm = $term - 1;
            $theyear = $year;
        } else{
            $theterm = $term + 2;
            $theyear = $year - 1;
        }
        $payments = Feepayment::where('admno', '=', $admno)->where('receiptno', '=', $receiptno)
                                ->where('term', '=', $theterm)->where('year', '=', $theyear)
                                ->where('account_id', '=', $account_id)->get();
//        
        if(count($payments) > 0){
            return true;
        } else{
            return false;
        }
    }
    
    
    public static function post_studentss_fees($admno, $bank, $chequeno, $term, $year, $paid_on, $amount_paid)
    {             
        $systemno = $systemno = "RCT" . date('y').date('m').date('d').$admno.rand(0,99);
        $class = StudentsDetails::get_student_current_class($admno);
        
        $term_fee_accounts = Termfees::where('class', '=', $class)->where('term', '=', $term)
                                        ->where('year', '=', $year)->get();        
        if(count($term_fee_accounts) < 1){//fees for the term has not been set.
        //pay the push the whole amount to tuition vote head assuming the id is 1
        //alternatively, call this method again with new term and year parameters so that the amount is distributed to
        //the various voteheads for the next semester.
            //return false;
            $feepayment = Feepayment::firstOrCreate(['admno' => $admno, 'receiptno' => $chequeno, 'systemno' => $systemno,
                                'bank_id' => $bank, 'term' => $term, 'year' => $year, 'account_id' => 1, 
                                'amount' => $amount_paid, 'paid_on' => $paid_on]);
            
            $action = "Added Ksh. " . $amount_paid . " as school fees for adm " . $admno . ""
                    . " for term " . $term . ", " . $year;
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            return true;
        }
        $remaining_amt = $amount_paid;
        
        foreach($term_fee_accounts as $term_fee_account){
            //check if amount for given account is paid
            if((self::fee_acc_paid_amount($admno, $term, $year, $term_fee_account->account_id)) < $term_fee_account->amount){
                //deduct balance for this account if it is not cleared
                $acc_balace = $term_fee_account->amount - self::fee_acc_paid_amount($admno, $term, $year, $term_fee_account->account_id);
                
                if($remaining_amt >= $acc_balace && $remaining_amt != 0 && $acc_balace != 0){//amount is greater than the balance for this votehead
                    //post fees
                    $acc_deposit = $acc_balace;
                    $remaining_amt = $remaining_amt - $acc_balace;
                    
                    $feepayment = Feepayment::firstOrCreate(['admno' => $admno, 'receiptno' => $chequeno, 'systemno' => $systemno,
                                    'bank_id' => $bank, 'term' => $term, 'year' => $year, 'account_id' => $term_fee_account->account,
                                    'amount' => $acc_deposit, 'paid_on' => $paid_on]);
                    
                    $feepayment->save();
                    
                } else if($remaining_amt == 0){
                    //amount posted is finished. All accounts might have already been paid for or otherwise
                    $action = "Added Ksh. " . $amount_paid . " as school fees for adm " . $admno . ""
                    . " for term " . $term . ", " . $year;
                    UserAccounts::system_audit(auth()->user()->id, $action);
                    
                    return true;
                } else{//amount is less than the balance for this votehead
                    //deposit the whole amount to this votehead
                    $feepayment = Feepayment::firstOrCreate(['admno' => $admno, 'receiptno' => $chequeno, 'systemno' => $systemno, 
                                        'bank_id' => $bank, 'term' => $term, 'year' => $year, 'account_id' => $term_fee_account->account_id, 
                                        'amount' => $remaining_amt, 'paid_on' => $paid_on]);
                    
                    $remaining_amt = 0;
                }
            } else{
                
            }
        }
        if($remaining_amt > 0){//some money remained after paying for all the voteheads
            //push the balance to the next term/year
            //call this function recursively with new term, year and amount values
            if($term <= 2){
                $newterm = $term + 1;
                $newyear = $year;
            } else{
                $newterm = 1;
                $newyear = $year + 1;
            }
            return self::post_studentss_fees($admno, $bank, $chequeno, $newterm, $newyear, $paid_on, $remaining_amt);
        } else{
            
            $action = "Added Ksh. " . $amount_paid . " as school fees for adm " . $admno . ""
                    . " for term " . $term . ", " . $year;
            UserAccounts::system_audit(auth()->user()->id, $action);
            
            return true;
        }        
    }
    
    /**
     * Get the system number corresponding to a given receipt number
     * 
     * @param string $receiptno
     * @return string
     */
    public static function receipt_system_no($receiptno)
    {
        $systemno = Feepayment::where('receiptno', '=', $receiptno)->first();
        return $systemno->systemno;
    }
    
    /**
     * Get the total fees paid by a student for a given term of the year
     * 
     * @param string $admno
     * @param int $term
     * @param int $year
     * @return int
     */
    public static function std_total_fees_paid($admno, $term, $year)
    {
        $paid_amts = Feepayment::where('admno', '=', $admno)->where('term', '=', $term)->where('year', '=', $year)->get();
        $total_paid = 0;
        if(count($paid_amts) > 0){
            foreach($paid_amts as $paid_amt){
                $total_paid += $paid_amt->amount;
            }
            return $total_paid;
        } else{
            return $total_paid;
        } 
    }
    
    /**
     * Get the amount payable towards a given account
     * in a given term of the year for a given class
     * 
     * @param int $term
     * @param int $year
     * @param int $class
     * @param int $account_id
     * @return int
     */
    public static function term_fee_acc_amt($term, $year, $class, $account_id)
    {
        $acc_totals = Termfees::where('class', '=', $class)->where('term', '=', $term)->where('year', '=', $year)
                                ->where('account_id', '=', $account_id)->first();
        return $acc_totals->amount;
    }
    
    public static function get_account_name($id)
    {
        $account = Accounts::where('id', '=', $id)->first();
        return $account->name;
    }
    
    public static function get_account_type($id)
    {
        $type = Accounttypes::where('id', '=', $id)->first();
        return $type->name;
    }
    
    public static function get_acc_type_function($id)
    {
        $func = Accountfunctions::where('id', '=', $id)->first();
        return $func->name;
    }
    
    public static function get_function_division($id)
    {
        $div = Accountdivisions::where('id', '=', $id)->first();
        return $div->name;
    }
    
    /**
     * Get all the invoices sent out to a given student
     * 
     * @param string $admno
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function std_invoices($admno)
    {
        $invoices = Invoices::where('admno', '=', $admno)->get();
        return $invoices;
    }
    
    /**
     * Get the payments made for invoices made to a given
     * student in a given term of the year
     * 
     * @param string $admno
     * @param int $term
     * @param int $year
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function invoice_amt_paid($admno, $term, $year)
    {
        $feepayment = Incomes::where('paid_by', '=', $admno)->where('term', '=', $term)
                                    ->where('year', '=', $year)->where('status', '=', 'Complete')->get();
        return $feepayment;
    }
    
    public static function fee_acc_paid_amount($admno, $term, $year, $account_id)
    {
        $paid_amts = Feepayment::where('admno', '=', $admno)->where('term', '=', $term)->where('year', '=', $year)
                                ->where('account_id', '=', $account_id)->get();
        $f_ac_pd_amt = 0;
        if(count($paid_amts) > 0){
            foreach($paid_amts as $paid_amt){
                $f_ac_pd_amt += $paid_amt->amount;
            }
            return $f_ac_pd_amt;
        } else{
            return $f_ac_pd_amt;
        }
    }
    
    
    public static function get_bank_name($id)
    {
        $bank = Banks::where('id', '=', $id)->first();
        return $bank->name;
    }
    
    public static function students_with_balance(Request $request)
    {
            $std_balance_array[] = 0;
            foreach(StudentsDetails::get_allstudents() as $student){
                $currclass = StudentsDetails::get_student_current_class($student->admno);
                $balance = self::get_student_balance($student->admno, $request->input('bterm'), $request->input('byear'), $currclass);
                if($balance > 0){                    
                    $std_balance_array[] = array('admno' => $student->admno, 'balance' => $balance, 'currentclass' => $currclass);
                }
            }            
            
            foreach ($std_balance_array as $key => $value) {
                $admno[$key] = $value['admno'];
                $bal[$key] = $value['balance'];
                $currcl[$key] = $value['currentclass'];
            }
            if(count($std_balance_array) > 1){
                //remove the value the array had been initialised to 
                $std_balance_array = array_except($std_balance_array, 0);
                return $std_balance_array;
                
            } else{
                return $std_balance_array;
            }
    }
        
    public static function get_student_balance($admno, $term, $year, $class)
    {
        $termfees = self::term_total_fees($class, $term, $year);

        $feespaid = Feepayment::where('admno', '=', $admno)->where('term', '=', $term)
                                ->where('year', '=', $year)->get();
        $total_paid = 0;
        if(count($feespaid) > 0){
            foreach($feespaid as $feepaid){
                $total_paid += $feepaid->amount;
            }
        }
        $balance = $termfees - $total_paid;
        return $balance;
    }
    
    public static function term_total_fees($class, $term, $year)
    {
        $termfs = Termfees::where('class', '=', $class)->where('term', '=', $term)->where('year', '=', $year)->get();
        $total = 0;
        if(count($termfs) > 0){
            foreach($termfs as $termf){
                $total += $termf->amount;
            }
            return $total;
        } else{
            return $total;
        }
    }
    
    public static function get_semester_fees($term, $year, $class)
    {
        $total = 0;
        $fees = Termfees::where('term', '=', $term)->where('year', '=', $year)
                            ->where('class', '=', $class)->get();
        if(count($fees) > 0){
            foreach($fees as $fee){
                $total += $fee->amount;
            }
            return $total;
        } else{
            return 0;
        }

    }
    
    public static function student_fees_paid($admno, $term, $year)
    {
        $total = 0;
        $feespaid = Feepayment::where('admno', '=', $admno)->where('term', '=', $term)
                                ->where('year', '=', $year)->get();
        if(count($feespaid) > 0){
            foreach($feespaid as $fee){
                $total += $fee->amount;
            }
            return $total;
        } else{
            return $total;
        }
    }
}