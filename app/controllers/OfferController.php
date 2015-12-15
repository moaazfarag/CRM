<?php

/**
 * Created by PhpStorm.
 * User: moaaz
 * Date: 11/21/2015
 * Time: 12:51 PM
 */
class OfferController extends BaseController
{
    public function addOffer()
    {
        $data['table_name']= 'offer';
        $data['title'] = "اضف عرض جديد";
        $data['offers'] = Offer::company()->where('deleted', '0')->get();
        return View::make('dashboard.products.offer.index', $data);
    }

    public function storeOffer()
    {
        $validation = Validator::make(Input::all(), Offer::$store_rules,BaseController::$messages);

        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            $offer = new Offer;
            $offer->name = Input::get('name'); //offer name from input
            $offer->offer = Input::get('offer'); //offer name from input
            $offer->from = (Input::has('from'))?$this->strToTime(Input::get('from')):null; //offer date
            $offer->to  = (Input::has('to'))?$this->strToTime(Input::get('to')):null; //offer date
            $offer->co_id = Auth::user()->co_id; // company id
            $offer->user_id = Auth::id();// user who add this record
            if ($offer->save()) {
                Session::flash('success', BaseController::addSuccess(Lang::get('main.theOffer')));
            } else {

                Session::flash('error', BaseController::addError(Lang::get('main.theOffer')));
            }
            return Redirect::route('addOffer');
        }
    }

    public function editOffer($id)
    {
        $data['title'] = " تعديل عرض ";
        $data['offer'] = Offer::find($id);
        if ($data['offer']) {
            $data['offers'] = Offer::company()->where('deleted', '0')->get();
            return View::make('dashboard.products.offer.index', $data);
        }
        return View::make('errors.missing');
    }

    public function updateOffer($id)
    {
        $validation = Validator::make(Input::all(), Offer::$update_rules);

        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation->messages());
        } else {
            $offer = Offer::find($id);
            if ($offer) {
                $offer->name = Input::get('name'); //offer name from input
                $offer->offer = Input::get('offer'); //offer name from input
                $offer->from = (Input::has('from'))?$this->strToTime(Input::get('from')):null; //offer date
                $offer->to  = (Input::has('to'))?$this->strToTime(Input::get('to')):null; //offer date
                $offer->user_id = Auth::id();// user who add this record
                if ($offer->save()) {
                    Session::flash('success', BaseController::editSuccess(Lang::get('main.theOffer')));
                } else {

                    Session::flash('error', BaseController::editError(Lang::get('main.theOffer')));
                }
                return Redirect::route('addOffer');
            } else {
                return View::make('errors.missing');
            }

        }
    }

    public function deleteOffer($id)
    {

        $offer = Offer::company()->find($id);
        $items = Items::where('offer_id', '=', $id)->company()->first();


        if (!empty($offer)) {
            if (!empty($items)) {
                Session::flash('error', 'لا يمكن الحذف ... هناك أصناف تحمل اسم هذا العرض ');
                return Redirect::back();
            } else {
                $offer->deleted = 1;
                $offer->save();
                    Session::flash('success', 'تم حذف فئة الصنف بنجاح ');
                    return Redirect::route('addOffer');
            }//end else employees

        }
    }
}