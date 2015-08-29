<?php
/**
 * Created by PhpStorm.
 *
 * User: Moaaz farag
 * Date: 22/7/2015
 * Time: 3:49 PM
 */

class SettleController extends BaseController {

    public function jsonData()
    {
        $data['items']= Items::with('cat')->get();
        $data['users']= User::get();
        return Response::make(json_encode($data));
    }

    /**
     * @return mixed
     * addItems Balances
     */
    public function addSettle($type)
    {
        $types = array('settleAdd','settleDiscount');
        if(in_array($type,$types) ){
            if($type == 'settleAdd')
            {
                $name = 'اضافة';
            }elseif($type == 'settleDiscount'){
                $name = 'خصم';
            }

            $data['title']      = " تسوية $name " ; // page title
            $data['name']       = $name; // page title
            $data['TransOpen']  = 'open' ;
            $data['co_info']    = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
            $data['branch']     = $this->isAllBranch();
            $data['pay_type']     = array('نقدى ','فيزا','اجل');
            $data['account_type'] = array('العملاء','الموردين','المصروفات','جارى الشركاء','ايرادات اخرى');
//            $data['newArray']    = $this->itemsToJson($invoiceId);
//            dd(json_encode($newArray));
            return View::make('dashboard.settle.index',$data,compact('type'));

        }else{

            return "that's not correct page : type check fail";

        }

    }

    /**
     * view all  invoices of settles
     * @param $invoiceId  edit invoice by id
     * @return string
     */
    public function viewSettles()
    {
        $trans = TransHeader::where('co_id',$this->coAuth())->where('invoice_type',Input::get('type'))->get();
        if($trans){
            $data['title']       = " تعديل تسوية اضافة " ; // page title
            $data['TransOpen']   = 'open' ;
            $data['invoices']    = $trans;
            return View::make('dashboard.settle.view_settles',$data);

        }else{

            return "that's not correct page : type check fail";

        }
    }
    /**
     * view one  invoice of settle
     * @param $invoiceId  edit invoice by id
     * @return string
     */
    public function viewSettle($invoiceId)
    {
        $trans = TransHeader::findOrFail($invoiceId);
        if($trans){
            $data['title']       = " تعديل تسوية اضافة " ; // page title
            $data['TransOpen']   = 'open' ;
            $data['co_info']     = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
            $data['newArray']    = $this->itemsToJson($invoiceId);
            $data['invoice']     = $trans;
            $data['type']        = $data['invoice']->invoice_type;
            return View::make('dashboard.settle.invoice',$data);

        }else{

            return "that's not correct page : type check fail";

        }
    }

    /**
     * store data into trans table
     * @param $type of trans
     * @return mixed
     */
    public function storeSettle($type)
    {

        $inputs = Input::all();

        $validation = Validator::make($inputs, TransDetails::rulesCreator($inputs));

        if($validation->fails())
        {

            $data['title']       = " تعديل تسوية اضافة " ; // page title
            $data['TransOpen']   = 'open' ;
            $data['type']        = 'type' ;
            $data['co_info']     = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
            $data['branch']      = $this->isAllBranch(); //
            $data['newArray']    = $this->itemsToJsonForError($inputs);
            $data['errors']      = $validation->messages();
//            dd($data['newArray']);
//            dd($validation->messages()   );
//            return   View::make('dashboard.settle.index',$data,compact('type'));
            Session::flash('error',' <strong>فشل في العملية</strong> بعض المدخلات تم ادخالها على نحو غير صحيح  ');
            return View::make('dashboard.settle.index',$data);


        }else {
            $newHeader                  = new TransHeader;
            $newHeader->co_id           = $this->coAuth();
            $newHeader->user_id         = Auth::id();
            $newHeader->br_code         = $inputs['branch_id'];
            $transHeaderId              = $newHeader->max('invoice_no')+1;
            $newHeader->invoice_no      = $transHeaderId;
            $newHeader->invoice_type    = $type;
            $newHeader->date            = $this->strToTime($inputs['date']) ;
            $newInvoiceItems = array();//create array to insert into database on save
            foreach (TransDetails::countOfInputs($inputs) as $k=>$v)
                {
                    $newInvoiceItems[] =   array
                    (
                        'trans_header_id'   => $transHeaderId,
                        'qty'               => isset($inputs['serial_'.$k])?1:$inputs['quantity_'.$k],
                        'item_id'           => $inputs['id_'.$k],
                        'avg_cost'          => Items::findOrFail($inputs['id_'.$k])->first()->avg_cost,
                        'serial_no'         => isset($inputs['serial_'.$k])?$inputs['serial_'.$k]:0,
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    );
                }
            $newHeader->save();
            TransDetails::insert($newInvoiceItems);
            Session::flash('success','تم اضافة التسوية بنجاح');
            return Redirect::route('viewSettle',array($transHeaderId));
//
//            echo "scusess";
//            dd(TransDetails::rulesCreator($inputs));


        }
//        dd(Input::get('id'));
//        dd(Request::format());
//        dd(Input::json()->all());
//
//        return Response::json(array('success' => true));

    }

    /**
     * get items in invoice and convert to json to pass it  to view
     * @param $invoiceId
     * @return array
     */
    private function itemsToJson($invoiceId)
    {
        $invoiceItems      = TransDetails::where('trans_header_id','=',$invoiceId)->get(); //  get all item of this trans to view in table
        $newArray = array();
        foreach($invoiceItems as $invoiceItem ){
            $newArray[] = array
            (
                'name'=> Items::find($invoiceItem['item_id'])->item_name,
                'id'=> $invoiceItem['item_id'],
                'quantity'=> $invoiceItem['qty'],
                'serial'=> $invoiceItem['serial_no'],
//                'cost'=> $invoiceItem['cost']/$invoiceItem['qty']
            ) ;
        }
        return $newArray;
    }

    private function itemsToJsonForError($inputs)
    {
        $count = TransDetails::countOfInputs($inputs);
        foreach($count as $k =>$v ){
            $newArray[] = array
            (
                'name'     => $inputs['name_'.$k],
                'id'       => intval($inputs['id_'.$k]),
                'quantity' => intval($inputs['quantity_'.$k]),
                'serial'   => $inputs['serial_'.$k],
            ) ;
        }
//        dd($newArray);
        return $newArray;
    }
public function test(){

//
//    $moaaz->invoice_type = Input::get('id_0');
//    $moaaz->save();
    $tests = Request::all();
   dd($tests);
foreach($tests as $test){
    $moaaz = new TransHeader;
   $moaaz->invoice_type =  $test['acc_type'];
    $moaaz->save();
}
return  Response::json(Request::all());

}
}