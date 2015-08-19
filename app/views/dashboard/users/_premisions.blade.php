
       <div class="col m12 s12">
            <h4>الصلاحيات</h4>
        </div>


        <div class="row">
            <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>استعراض </th>
                      <th> حفظ </th>
                      <th>حذف</th>
                      <th>طباعة</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>المبيعات</th>
                      <td>
                             <div class="input-field">
                                    {{ Form::hidden('add_article','0') }}
                                 {{ Form::checkbox('add_article','1',@$permission['article']['add'] or 0,array('id'=>'add_article')) }}

                             <label for="add_article"> استعراض</label>
                           <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                 <li class="parsley-required">{{ $errors ->First('add_article') }} </li>
                           </ul>
                             </div>
                      </td>
                      <td>
                           <div class="input-field">
                                    {{ Form::hidden('edit_article','0') }}
                               {{ Form::checkbox('edit_article','1',@$permission['article']['edit'] or 0 ,array('id'=>'edit_article')) }}
                               {{--{{{ $permission['article']['asaddd'] or 'dsadsadsa'  }}}--}}
                           <label for="edit_article"> حفظ</label>
                         <ul class="parsley-errors-list filled" id="parsley-id-5202">
                               <li class="parsley-required">{{ $errors ->First('edit_article') }} </li>
                         </ul>
                           </div>
                      </td>
                      <td>
                             <div class="input-field">
                                    {{ Form::hidden('delete_article','0') }}
                                 {{ Form::checkbox('delete_article','1',@$permission['article']['delete'] or 0,array('id'=>'delete_article')) }}
                             <label for="delete_article"> حذف</label>
                           <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                 <li class="parsley-required">{{ $errors ->First('delete_article') }} </li>
                           </ul>
                             </div>

                      </td>
                       <td>
                             <div class="input-field">
                                    {{ Form::hidden('delete_article','0') }}
                                 {{ Form::checkbox('delete_article','1',@$permission['article']['delete'] or 0,array('id'=>'delete_article')) }}
                             <label for="delete_article"> طباعة</label>
                           <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                 <li class="parsley-required">{{ $errors ->First('delete_article') }} </li>
                           </ul>
                             </div>

                      </td>
                    </tr>
                    <tr>
                        <th>تسويات</th>
                        <td>
                            <div class="input-field">
                                    {{ Form::hidden('add_news','0') }}
                                {{ Form::checkbox('add_news','1',@$permission['news']['add'] or 0,array('id'=>'add_news')) }}
                                <label for="add_news"> استعراض</label>
                                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                    <li class="parsley-required">{{ $errors ->First('add_news') }} </li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="input-field">
                                    {{ Form::hidden('edit_news','0') }}
                                {{ Form::checkbox('edit_news','1',@$permission['news']['edit'] or 0,array('id'=>'edit_news')) }}
                                <label for="edit_news"> حفظ</label>
                                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                    <li class="parsley-required">{{ $errors ->First('edit_news') }} </li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <div class="input-field">
                                    {{ Form::hidden('delete_news','0') }}
                                {{ Form::checkbox('delete_news','1',@$permission['news']['delete'] or 0,array('id'=>'delete_news')) }}
                                <label for="delete_news"> حذف</label>
                                <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                    <li class="parsley-required">{{ $errors ->First('delete_news') }} </li>
                                </ul>
                            </div>

                        </td>
                                               <td>
                                                     <div class="input-field">
                                                            {{ Form::hidden('delete_article','0') }}
                                                         {{ Form::checkbox('delete_article','1',@$permission['article']['delete'] or 0,array('id'=>'delete_article')) }}
                                                     <label for="delete_article"> طباعة</label>
                                                   <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                                         <li class="parsley-required">{{ $errors ->First('delete_article') }} </li>
                                                   </ul>
                                                     </div>

                                              </td>
                </tr>
                    <tr>
<th>مشتريات</th>
<td>
    <div class="input-field">
                                    {{ Form::hidden('add_document','0') }}
        {{ Form::checkbox('add_document','1',@$permission['document']['add'] or 0,array('id'=>'add_document')) }}
        <label for="add_document"> استعراض</label>
        <ul class="parsley-errors-list filled" id="parsley-id-5202">
            <li class="parsley-required">{{ $errors ->First('add_document') }} </li>
        </ul>
    </div>
</td>
<td>
    <div class="input-field">
                                    {{ Form::hidden('edit_document','0') }}
        {{ Form::checkbox('edit_document','1',@$permission['document']['edit'] or 0,array('id'=>'edit_document')) }}
        <label for="edit_document"> حفظ</label>
        <ul class="parsley-errors-list filled" id="parsley-id-5202">
            <li class="parsley-required">{{ $errors ->First('edit_document') }} </li>
        </ul>
    </div>
</td>
<td>
    <div class="input-field">
                                    {{ Form::hidden('delete_document','0') }}
        {{ Form::checkbox('delete_document','1',@$permission['document']['delete'] or 0,array('id'=>'delete_document')) }}
        <label for="delete_document"> حذف</label>
        <ul class="parsley-errors-list filled" id="parsley-id-5202">
            <li class="parsley-required">{{ $errors ->First('delete_document') }} </li>
        </ul>
    </div>

</td>
                       <td>
                             <div class="input-field">
                                    {{ Form::hidden('delete_article','0') }}
                                 {{ Form::checkbox('delete_article','1',@$permission['article']['delete'] or 0,array('id'=>'delete_article')) }}
                             <label for="delete_article"> طباعة</label>
                           <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                 <li class="parsley-required">{{ $errors ->First('delete_article') }} </li>
                           </ul>
                             </div>

                      </td>
</tr>
                    <tr>
<th>تحولايات</th>
<td>
    <div class="input-field">
                                    {{ Form::hidden('add_event','0') }}
        {{ Form::checkbox('add_event','1',@$permission['event']['add'] or 0,array('id'=>'add_event')) }}
        <label for="add_event"> استعراض</label>
        <ul class="parsley-errors-list filled" id="parsley-id-5202">
            <li class="parsley-required">{{ $errors ->First('add_event') }} </li>
        </ul>
    </div>
</td>
<td>
    <div class="input-field">
                                    {{ Form::hidden('edit_event','0') }}
        {{ Form::checkbox('edit_event','1',@$permission['event']['edit'] or 0,array('id'=>'edit_event')) }}
        <label for="edit_event"> حفظ</label>
        <ul class="parsley-errors-list filled" id="parsley-id-5202">
            <li class="parsley-required">{{ $errors ->First('edit_event') }} </li>
        </ul>
    </div>
</td>
<td>
    <div class="input-field">
                                    {{ Form::hidden('delete_event','0') }}
        {{ Form::checkbox('delete_event','1',@$permission['event']['delete'] or 0,array('id'=>'delete_event')) }}
        <label for="delete_event"> حذف</label>
        <ul class="parsley-errors-list filled" id="parsley-id-5202">
            <li class="parsley-required">{{ $errors ->First('delete_event') }} </li>
        </ul>
    </div>

</td>
                       <td>
                             <div class="input-field">
                                    {{ Form::hidden('delete_article','0') }}
                                 {{ Form::checkbox('delete_article','1',@$permission['article']['delete'] or 0,array('id'=>'delete_article')) }}
                             <label for="delete_article"> طباعة</label>
                           <ul class="parsley-errors-list filled" id="parsley-id-5202">
                                 <li class="parsley-required">{{ $errors ->First('delete_article') }} </li>
                           </ul>
                             </div>

                      </td>
</tr>
              </tbody>
            </table>




