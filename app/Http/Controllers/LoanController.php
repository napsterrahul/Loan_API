<?php
namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\ScheduleRepayment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon;

use Auth;
class LoanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $todo = Auth::user()->loan()->get();
        return response()->json(['status' => 'success','result' => $todo]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'amount' => 'required',
        'term' => 'required',
         ]);
        
        // $request['user_id'] = Auth::user()->id;
        if($loan = Auth::user()->loan()->Create($request->all())){
       
            // $dueDate = date('Y-m-d');
            if($request->term > 1){
                foreach(range(1, $request->term) as $installment) {
                    // $date = date('Y-m-d', strtotime('+7 days', strtotime($dueDate)));
                    $data = new ScheduleRepayment();
                    if($installment == $request->term){
                        $data->amount = $request->amount - (ScheduleRepayment::where('loan_id',$loan->id)->sum('amount'));
                    }else{
                        $data->amount = round(( $request->amount / $request->term ),2);
                    }
                    $data->loan_id = $loan->id;
                    $data->save();
                }
            }else{
                
                $data = new ScheduleRepayment();
                $data->amount = $request->amount;
                $data->loan_id = $loan->id;
                $data->save();
            }

          
            return response()->json(['status' => 'success','message'=>'Payment created Successfully']);
        }else{
            return response()->json(['status' => 'fail']);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request)
    {
        if(!$request->loan_id){
            return response()->json(['message' => 'Parameter Mismatch','status'=>'fail'],200);
        }
        $isadmin = User::where('id',$request->user_id)->where('user_type',1)->first();
        if(!$isadmin){
            return response()->json(['message' => 'Unauthorize','status'=>'fail'], 401);
        }
     
        $loan = Loan::where('id', $request->loan_id)->first();
        if($loan && $loan->status = 'Approved'){
            return response()->json(['message' => 'Already approved','status'=>'success']);
        }
        if($loan){
            $loan->status = 'Approved';
            $loan->save();

            $todayDate = date('Y-m-d');
            $allloans = ScheduleRepayment::where('loan_id',$request->loan_id)->get();
            foreach($allloans as $loandetail){
                $newdate = date('Y-m-d', strtotime('+7 days', strtotime($todayDate)));
                $loandetail->date = $newdate;
                $loandetail->save();
                $todayDate = $newdate;
            }
        }
        return response()->json(['status' => 'success','message'=>'Loan Successfully Approved']);  
    }


    public function show(Request $request)
    {
       
        if(!$request->loan_id){
            return response()->json(['message' => 'Parameter Mismatch','status'=>'fail']);
        }
    
        $loan = Loan::where('id', $request->loan_id)->first();
       
        if($loan){
            $allloans = ScheduleRepayment::where('loan_id',$request->loan_id)->get();
            return response()->json(['status' => 'success','result' => $loan,'scheduleRepayment'=>$allloans]);
        }else{
            return response()->json(['message' => 'Not Found','status'=>'fail']);  
        }
        
    }

   
    public function repayment(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'repayment_id' => 'required',
        ]);
        $repayment = ScheduleRepayment::find($request->repayment_id);
        $todayDate = date('Y-m-d');
        if($repayment){
            if($repayment->status == 'Paid'){
                // return response()->json(['message' => 'Payment Already Done for this Week','status'=>'fail']);
            }
            $loan = Loan::find($repayment->loan_id);
            if($request->amount < $repayment->amount){
                return response()->json(['message' => 'Payment Should not be less than Scheduled Amount','status'=>'fail']);
            }else if($request->amount ==  $repayment->amount){
                $repayment->status = 'Paid';
                $repayment->payment_date = $todayDate;
                $repayment->save();

                $allremainigPaymentlist = ScheduleRepayment::where('status','Pending')->where('loan_id',$repayment->loan_id)->get();
                $count = count($allremainigPaymentlist);
                if($count==0){
                    $loan->status = 'Paid';
                    $loan->save();
                }
                return response()->json(['message' => 'Payment successfully Updated','status'=>'success']);
            }else{
                $repayment->amount = $request->amount;
                $repayment->status = 'Paid';
                $repayment->payment_date = $todayDate;
                $repayment->save();

                $allPaymentsDone = ScheduleRepayment::where('status','Paid')->where('loan_id',$repayment->loan_id)->sum('amount');
                $remainingPayment = $loan->amount - $allPaymentsDone; 
                $allremainigPaymentlist = ScheduleRepayment::where('status','Pending')->where('loan_id',$repayment->loan_id)->get();
                $count = count($allremainigPaymentlist);
                
                if($count > 1){
                    foreach($allremainigPaymentlist as $list){
                        $list->amount = round(( $remainingPayment / $count ),2);
                        $list->save();
                    }
                }else{
                    $loan->status = 'Paid';
                    $loan->save();
                }
                return response()->json(['message' => 'Payment successfully Updated','status'=>'success']);
            }
        }
        return response()->json(['status' => 'fail','message'=>'Details Not Found']);
    }
   
}