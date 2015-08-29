                     <!-- pop up  Structure -->
 <div id="addItem" class="modal">
     <div class="modal-content">
         <div class="alert blue lighten-2 white-text">
             <h5>هذا المنتج يحتاج الى ادخال سيريال</h5>
         </div>
         <div class="row">
         <div class="col s2 l3">
             <div class="input-field">
                 {{--<i class="fa fa-tag prefix"></i>--}}
                 {{ Form::radio('range','range',null,array('id'=>'range','ng-model'=>'range')) }}
                 {{ Form::label('range','من الى ') }}
                 <p class="parsley-required">{{ $errors ->first('range') }} </p>
             </div>
         </div>
         <div class="col s2 l2">
             <div class="input-field">
                 {{--<i class="fa fa-tag prefix"></i>--}}
                 {{ Form::radio('range','oneByone',null,array('id'=>'oneByone','ng-model'=>'range')) }}
                 {{ Form::label('oneByone','ادخال') }}

                 <p class="parsley-required">{{ $errors ->first('oneByone') }} </p>
             </div>
         </div>
             </div>
<div class="row">
         <div  ng-show="range == 'oneByone' " class="col s12 l4">
        <div class="input-field">
            <i class="fa fa-barcode prefix"></i>
            {{ Form::text('serial',null,array('ng-model'=>"new.serial",'ng-minlength'=>"1",'id'=>'serial')) }}
            <div ng-show="form.$submitted || form.serial.$touched">
                    <span ng-show="form.serial.$error.required">
                            هذا الحقل مطلوب
                    </span>
            </div>
            {{ Form::label('serial','السيريال') }}
        </div>
    </div> {{-- serial div--}}
    <div  ng-show="range == 'range' " class="row">

    <div class="col s12 l4">
        <div class="input-field">
            {{ Form::text('prefix',null,array('ng-model'=>"new.prefix",'ng-minlength'=>"1",'id'=>'prefix')) }}
            <div ng-show="form.$submitted || form.prefix.$touched">
                        <span ng-show="form.prefix.$error.required">
                                هذا الحقل مطلوب
                        </span>
            </div>
            {{ Form::label('prefix','بداية الرقم المسلسل') }}
        </div>
        </div>
    <div class="col s12 l4">
        <div class="input-field">
            {{ Form::number('form',null,array('ng-model'=>"new.form",'ng-minlength'=>"1",'id'=>'form')) }}
            <div ng-show="form.$submitted || form.from.$touched">
                        <span ng-show="form.serial.$error.required">
                                هذا الحقل مطلوب
                        </span>
            </div>
            {{ Form::label('form','من') }}
        </div>
        </div>
        <div class="col s12 l4">
        <div class="input-field">
            {{ Form::number('to',null,array('ng-model'=>"new.to",'ng-minlength'=>"1",'id'=>'to')) }}
            <div>
                        <span ng-show="new.to < new.form" >
يجب ادخال رقم اكبر
                        </span>
                <span ng-show="(new.to - new.form) >100" >
                لا تستطيع ادخال اكثر من منتج من 100 في المرة الواحدة
                </span>
            </div>
            {{ Form::label('to','الى') }}
        </div>
    </div>
    </div>
</div>
     </div>
     <div class="modal-footer">
         <button ng-show="range == 'oneByone'" ng-disabled="hasSerial(new.serial)"
                 type="button"
                 ng-click="addItemHasSerial($scope.item.quantity)"
                 class="waves-effect btn">
             اضف
         </button >
         <button ng-show="range == 'range'" ng-disabled="new.to<new.form || (new.to - new.form) >100 || new.serial"
                 href="#addItem"  type="button"
                 ng-click="addItemHasSerial($scope.item.quantity) "
                 class="waves-effect btn modal-action modal-close">
             اضف
         </button >
<div></div>
         <button type="button"  ng-click="finishAddItemHasSerial()" class="modal-action modal-close btn">انهاء</button>
     </div>
 </div>