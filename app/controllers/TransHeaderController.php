<?php
/**
 * Created by PhpStorm.
 *
 * User: Moaaz farag
 * Date: 22/7/2015
 * Time: 3:49 PM
 */

class TransHeaderController extends BaseController {



    /**
     * @return mixed
     * addItems Balances
     */
    public function addTransHeader($type)
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
            return View::make('dashboard.trans_header',$data,compact('type'));

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
    public function editTransHeader($invoiceId)
    {
        $trans = TransHeader::findOrFail($invoiceId);
        if($trans){
            $data['title']       = " تعديل تسوية اضافة " ; // page title
            $data['TransOpen']   = 'open' ;
            $data['co_info']     = CoData::where('id','=',$this->coAuth())->first();//select info models category seasons
            $data['branch']      = $this->isAllBranch(); //
            $data['newArray']    = $this->itemsToJson($invoiceId);

//            dd(json_encode( $data['newArray'] ));
            return View::make('dashboard.trans_header',$data,compact('type'));

        }else{

            return "that's not correct page : type check fail";

        }

    }




    /**
     * @return mixed
     * update Items Balances
     */
    public  function updateItemsBalances($id)
    {
        $validation = Validator::make(Input::all(), ItemsBalances::$update_rules);

        if($validation->fails())
        {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        }else {

            $itemsBalances  = ItemsBalances::where('id','=',$id)->where('co_id','=', $this->coAuth())->first();

            if($itemsBalances) {

                $itemsBalances->user_id      = Auth::id();
                $itemsBalances->item_id      = Input::get('item_id');
                $itemsBalances->bar_code     = Input::get('bar_code');
                $itemsBalances->qty          = Input::get('qty');
                $itemsBalances->cost         = Input::get('cost');
                $itemsBalances->serial_no    = Input::get('serial_no');

                $itemsBalances->update();

                return Redirect::route('addItemsBalances');
            }else{
                return "This Items Balances Not Found ";
            }
        }
    }

    /**
     * store data into trans table 
     * @param $type of trans
     * @return mixed
     */
    public function transJson($type)
    {

        $inputs = Input::all();

        $validation = Validator::make($inputs, TransDetails::rulesCreator($inputs));

        if($validation->fails())
        {
            echo "fail";
            dd(TransDetails::rulesCreator($inputs));

        }else {
            $newHeader                  = new TransHeader;
            $newHeader->co_id           = $this->coAuth();
            $newHeader->user_id         = Auth::id();
            $newHeader->br_code         = $inputs['branch_id'];
            $transHeaderId              = $newHeader->max('invoice_no')+1;
            $newHeader->invoice_no      = $transHeaderId;
            $newHeader->invoice_type    = $type;
            $newHeader->date            = $inputs['date'];
            foreach(TransDetails::countOfInputs($inputs) as $k => $v )
            {// foreach for save item into trans_details table 
                $newInvoiceHeader = new TransDetails;
                $newInvoiceHeader->trans_header_id   = $transHeaderId;
                $newInvoiceHeader->item_id           = $inputs['id_'.$k];
                $newInvoiceHeader->qty               = $inputs['quantity_'.$k];
                $newInvoiceHeader->save();
            }
            $newHeader->save();
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

} 