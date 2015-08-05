     @extends('dashboard.main')
 @section('content')
     <!-- Breadcrumb -->
     <div class="ecommerce-title">

       <div class="row">
         <div class="col s12 m9 l10">
           {{--<h1>gfbn</h1>--}}
           <nav>

             <ul class="left">
             <li>
             <a href="/admin/hr">شئون العاملين </a>
             </li>
            <li class="active">
            <a href="/admin/accounts">الحسابات </a>
            </li>
            <li>
               <a href="/admin/product">الاصناف </a>
               </li>
               <li>
               <a href="/admin/setting">بيانات الموقع</a>
               </li>
                <li>
               <a href="/admin">الرئيسية</a>
               </li>

             </ul>
           </nav>

         </div>

       </div>

     </div>
     <!-- /Breadcrumb -->


    <div class="row">
      <div class="col s12">
        <ul class="tabs">
          <li class="tab col s3"><a href="#account_customers ">العملاء</a></li>
          <li class="tab col s3"><a  href="#account_supplier">الموردين </a></li>
          <li class="tab col s3"><a  href="#account_bank">البنك</a></li>
          <li class="tab col s3"><a href="#account_expenses">المصروفات</a></li>
          <li class="tab col s3"><a href="#account_partners"> الشركاء</a></li>
        </ul>
      </div>

            {{--العملاء--}}
            @include('dashboard.account_customers')
                     {{-- الموردين--}}
            @include('dashboard.account_supplier')
              {{--البنك--}}
            @include('dashboard.account_bank')
              {{--المصروفات--}}
            @include('dashboard.account_expenses')
                {{--الشركاء--}}
            @include('dashboard.account_partners')


    </div>



  </section>
  <!-- /Main Content -->

@include('include.search')


@stop