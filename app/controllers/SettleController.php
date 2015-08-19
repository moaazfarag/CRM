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
        $types = array('addItems','discountItems');
        if(in_array($type,$types) ){
            if($type == 'addItems')
            {
                $name = 'اضافة';
            }elseif($type == 'discountItems'){
                $name = 'خصم';
            }

            $data['title']    = " تسوية $name " ; // page title
            $data['TransOpen']   = 'open' ;
            $data['co_info']  = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
            $data['branch']      = $this->isAllBranch();
//            $data['newArray']    = $this->itemsToJson($invoiceId);
//            dd(json_encode($newArray));
            return View::make('dashboard.settle.index',$data,compact('type'));

        }else{

            return "that's not correct page : type check fail";

        }

    }

    /**
     * edit trans invoice
     * @param $type       type of trans
     * @param $invoiceId  edit invoice by id
     * @return string
     */
    public function editSettle($invoiceId)
    {
        $trans = TransHeader::findOrFail($invoiceId);
        if($trans){
            $data['title']       = " تعديل تسوية اضافة " ; // page title
            $data['TransOpen']   = 'open' ;
            $data['co_info']     = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
            $data['branch']      = $this->isAllBranch(); //
            $data['newArray']    = $this->itemsToJson($invoiceId);

//            dd(json_encode( $data['newArray'] ));
            return View::make('dashboard.settle.index',$data,compact('type'));

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
            $data['co_info']     = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
            $data['branch']      = $this->isAllBranch(); //
            $data['newArray']    = $this->itemsToJsonForError($inputs);
//            dd($data['newArray']);
//            return   View::make('dashboard.settle.index',$data,compact('type'));
            return Redirect::back()->with($data)->withInput()->withErrors($validation->messages());


        }else {
            $newHeader                  = new TransHeader;
            $newHeader->co_id           = $this->coAuth();
            $newHeader->user_id         = Auth::id();
            $newHeader->br_code         = $inputs['branch_id'];
            $transHeaderId              = $newHeader->max('invoice_no')+1;
            $newHeader->invoice_no      = $transHeaderId;
            $newHeader->invoice_type    = $type;
            $newHeader->date            = $inputs['date'];
            $newInvoiceItems = array();//create array to insert into database on save
            foreach (TransDetails::countOfInputs($inputs) as $k=>$v)
                {
                    $newInvoiceItems[] =   array
                    (
                        'trans_header_id'   => $transHeaderId,
                        'qty'               => $inputs['quantity_'.$k],
                        'item_id'           => $inputs['id_'.$k],
                        'serial_no'         => $inputs['serial_'.$k],
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    );
                }
            $newHeader->save();
            TransDetails::insert($newInvoiceItems);
            return Response::json(array('success' => true));
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
                'cost'=> $invoiceItem['cost']/$invoiceItem['qty']
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
                'id'       => $inputs['id_'.$k],
                'quantity' => $inputs['quantity_'.$k],
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