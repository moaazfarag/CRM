                     <!-- pop up  Structure -->
 <div id="addItem" class="modal">
     <div class="modal-content">
         <div class="alert blue lighten-2 white-text">
             <h4>هذا المنتج يحتاج الى ادخال سيريال</h4>
         </div>
         <div class="col s12 l4">
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
     </div>
     <br> <br>
     <div class="modal-footer">
         <button ng-disabled="hasSerial(new.serial)"
                 href="#addItem"  type="button"
                 ng-click="addItemHasSerial($scope.item.quantity)"
                 class="waves-effect btn">
             اضف
         </button >
<div></div>
         <button type="button"  ng-click="finishAddItemHasSerial()" class="modal-action modal-close btn">انهاء</button>
     </div>
 </div>