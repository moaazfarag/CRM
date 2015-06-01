      <div id="product_cat" class="col s12">
 <!-- الفروع -->
        <div class="card minimized">
          <div class="title">
            <h5><i class="mdi mdi-notification-event-available"></i> اضف فئة جديدة</h5>
            <a class="minimize" href="#">
              <i class="mdi-navigation-expand-less"></i>
            </a>
          </div>
          <div class="content">
        <div class="row no-margin-top">
          <div class="col s12 l2">
            <label for="branch-name">
اسم الفرع
            </label>
          </div>
          <div class="col s12 m6 l6">
            <div class="input-field">
              <i class="mdi mdi-social-person prefix"></i>
              <input id="branch-name" type="text" placeholder="  اسم الفرع">
            </div>
          </div>

        </div>
                <div class="row no-margin-top">
                  <div class="col s12 l2">
                    <label for="branch-address">
عنوان الفرع
                    </label>
                  </div>
                  <div class="col s12 m6 l8">
                    <div class="input-field">
                      <i class="mdi mdi-social-person prefix"></i>
                      <input id="branch-address" type="text" placeholder="عنوان  الفرع">
                    </div>
                  </div>

                </div>

                  <div class="row">
                    <div class="col s12 l12">


                        <button class="waves-effect btn">اضف </button>
                    </div>
                </div>
                </div>
</div>
                  @include('dashboard.product_table_view')
</div>
        <!-- /عرض الفروع -->

