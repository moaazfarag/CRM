@extends('dashboard.main')

@section('content')
     <!-- Breadcrumb -->
     <div class="ecommerce-title">

       <div class="row">
         <div class="col s12 m9 l10">
           <!--h1>@@title</h1-->
           <nav>

             <ul class="left">
             <li>
             <a href="/admin/hr">شئون العاملين </a>
         </li>
            <li>
            <a href="/admin/accounts">الحسابات </a>
            </li>
            <li>
               <a href="/admin/product">الاصناف </a>
               </li>
               <li>
               <a href="/admin/setting">بيانات الموقع</a>
               </li>
                <li  class="active">
               <a href="/admin">الرئيسية</a>
               </li>

             </ul>
           </nav>

         </div>

       </div>

     </div>
     <!-- /Breadcrumb -->
<!-- Stats Panels -->
    <div class="row sortable">
      <div class="col l3 m6 s12">
        <div class="card-panel stats-card purple lighten-2 white-text">
          <i class="fa fa-line-chart"></i>
          <span class="count">38</span>
          <div class="name">Sales Today</div>
        </div>
      </div>
      <div class="col l3 m6 s12">
        <div class="card-panel stats-card indigo lighten-2 white-text">
          <i class="fa fa-money"></i>
          <span class="count">$13,547</span>
          <div class="name">Earnings Today</div>
        </div>
      </div>
      <div class="col l3 m6 s12">
        <div class="card-panel stats-card teal lighten-2 white-text">
          <i class="fa fa-trophy"></i>
          <span class="count">25,345</span>
          <div class="name">Total Sales</div>
        </div>
      </div>
      <div class="col l3 m6 s12">
        <div class="card-panel stats-card red lighten-2 white-text">
          <i class="fa fa-bar-chart"></i>
          <span class="count">$1,346,342</span>
          <div class="name">Total Earnings</div>
        </div>
      </div>
    </div>
    <!-- /Stats Panels -->


    <!-- Revenue -->
    <div class="row">
      <div class="col s12">
        <div class="card-panel">
          <div class="col s12 l9">
            <h5>Year Revenue</h5>
            <div id="revenueLineChart" style="height: 250px"></div>
          </div>
          <div class="col s12 l3">
            <h5>Today Revenue</h5>
            <div id="revenueBarChart" style="height: 250px"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Revenue -->


    <div class="row">
      <div class="col s12 l9">
        <div class="card">

          <!-- Popular -->
          <div class="title">
            <h5>Popular</h5>
          </div>
          <div class="content">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Product Title</th>
                  <th>Stock</th>
                  <th class="right-align">Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>
                   <img src="{{ URL::asset('dashboard/assets/_con/images/ecommerce-apple-iphone-30x30.jpg') }}" alt="Apple iPhone 6">
                  </th>
                  <td>
                    <strong>Apple iPhone 6</strong>
                    <div class="grey-text">2x1400 MHz, 64 Gb, 1024 Mb, 4.7", IPS, 1334x750, Cam 8 MP, 3G, 4G, BT, Wi-Fi, GPS, 1810 mAh</div>
                  </td>
                  <td>765</td>
                  <td class="right-align">$699.00</td>
                </tr>
                <tr>
                  <th>
                   <img src="{{ URL::asset('dashboard/assets/_con/images/ecommerce-apple-macbook-30x30.jpg') }}" alt="Apple Macbook Air Mid 14">
                  </th>
                  <td>
                    <strong>Apple Macbook Air Mid 14</strong>
                    <div class="grey-text">WXGA+, 1440x900, TN+film, Intel Core i5 4260U, 2x1400 MHz, RAM 4 Gb, SSD 512 Gb, Intel HD 5000, Wi-Fi, BT, Mac OS X</div>
                  </td>
                  <td>400</td>
                  <td class="right-align">$1,299.00</td>
                </tr>
                <tr>
                  <th>
                   <img src="{{ URL::asset('dashboard/assets/_con/images/ecommerce-apple-watch-30x30.jpg') }}" alt="Apple Watch">
                  </th>
                  <td>
                    <strong>Apple Watch</strong>
                    <div class="grey-text">No Description</div>
                  </td>
                  <td>1184</td>
                  <td class="right-align">$449.00</td>
                </tr>
                <tr>
                  <th>
                   <img src="{{ URL::asset('dashboard/assets/_con/images/ecommerce-apple-imac-30x30.jpg') }}" alt="Apple iMac">
                  </th>
                  <td>
                    <strong>Apple iMac 27"</strong>
                    <div class="grey-text">Intel Core i5 4670, 4x3400 MHz, IPS/2560х1440, 8 Gb, 1 Tb, NVIDIA GeForce GT 775M, Wi-Fi, Ethernet, Mac OS X</div>
                  </td>
                  <td>217</td>
                  <td class="right-align">$1,799.00</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /Popular -->

        </div>
      </div>
      <div class="col s12 l3">
        <div class="card">
          <!-- Top Geographic -->
          <div class="title">
            <h5>Top Geographic</h5>
          </div>
          <div class="content">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <td>
                   <img src="{{ URL::asset('dashboard/assets/flagIcons/in.png') }}" alt="India">&ensp; India</td>
                  <td class="right-align">
                    <strong>1,795</strong>  <small>(11.57%)</small>
                  </td>
                </tr>
                <tr>
                  <td>
                   <img src="{{ URL::asset('dashboard/assets/flagIcons/us.png') }}" alt="Unated States">&ensp; Unated States</td>
                  <td class="right-align">
                    <strong>1,773</strong>  <small>(11.43%)</small>
                  </td>
                </tr>
                <tr>
                  <td>
                   <img src="{{ URL::asset('dashboard/assets/flagIcons/br.png') }}" alt="Brazil">&ensp; Brazil</td>
                  <td class="right-align">
                    <strong>883</strong>  <small>(5.69%)</small>
                  </td>
                </tr>
                <tr>
                  <td>
                   <img src="{{ URL::asset('dashboard/assets/flagIcons/tr.png') }}" alt="Turkey">&ensp; Turkey</td>
                  <td class="right-align">
                    <strong>871</strong>  <small>(5.61%)</small>
                  </td>
                </tr>
                <tr>
                  <td>
                   <img src="{{ URL::asset('dashboard/assets/flagIcons/ru.png') }}" alt="Russia">&ensp; Russia</td>
                  <td class="right-align">
                    <strong>829</strong>  <small>(5.34%)</small>
                  </td>
                </tr>
                <tr>
                  <td>
                   <img src="{{ URL::asset('dashboard/assets/flagIcons/de.png') }}" alt="Germany">&ensp; Germany</td>
                  <td class="right-align">
                    <strong>485</strong>  <small>(3.13%)</small>
                  </td>
                </tr>
                <tr>
                  <td>
                   <img src="{{ URL::asset('dashboard/assets/flagIcons/fr.png') }}" alt="France">&ensp; France</td>
                  <td class="right-align">
                    <strong>473</strong>  <small>(3.05%)</small>
                  </td>
                </tr>
                <tr>
                  <td>
                   <img src="{{ URL::asset('dashboard/assets/flagIcons/it.png') }}" alt="Italy">&ensp; Italy</td>
                  <td class="right-align">
                    <strong>356</strong>  <small>(2.29%)</small>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /Top Geographic -->
        </div>
      </div>
    </div>

  </section>
  <!-- /Main Content -->

  <!-- Search Bar -->

  <!-- /Search Bar -->

@stop