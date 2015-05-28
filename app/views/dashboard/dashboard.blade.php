@extends('dashboard.main')

@section('content')

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
  <div class="search-bar">
    <div class="layer-overlay"></div>
    <div class="layer-content">
      <form action="#!">
        <!-- Header -->
        <a class="search-bar-toggle grey-text text-darken-2" href="#!"><i class="mdi-navigation-close"></i></a>

        <!-- Search Input -->
        <div class="input-field">
          <i class="mdi-action-search prefix"></i>
          <input type="text" name="con-search" placeholder="Search...">
        </div>

        <!-- Search Results -->
        <div class="search-results">

          <div class="row">
            <div class="col s12 l4">
              <h4>Users</h4>

              <div class="each-result">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user2.jpg') }}" alt="Felecia Castro" class="circle photo">
                <div class="title">Felecia Castro</div>
                <div class="label">Content Manager</div>
              </div>

              <div class="each-result">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user3.jpg') }}" alt="Max Brooks" class="circle photo">
                <div class="title">Max Brooks</div>
                <div class="label">Programmer</div>
              </div>

              <div class="each-result">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user4.jpg') }}" alt="Patsy Griffin" class="circle photo">
                <div class="title">Patsy Griffin</div>
                <div class="label">Support</div>
              </div>

              <div class="each-result">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user6.jpg') }}" alt="Vernon Garrett" class="circle photo">
                <div class="title">Vernon Garrett</div>
                <div class="label">Photographer</div>
              </div>
            </div>
            <div class="col s12 l4">
              <h4>Articles</h4>

              <div class="each-result">
                <div class="icon circle blue white-text">MD</div>
                <div class="title">Material Design</div>
                <div class="label nowrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi consequatur debitis veritatis dolorum, enim libero!</div>
              </div>

              <div class="each-result">
                <div class="icon circle teal white-text">
                  <i class="fa fa-dashboard"></i>
                </div>
                <div class="title">Admin Dashboard</div>
                <div class="label nowrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi consequatur debitis veritatis dolorum, enim libero!</div>
              </div>

              <div class="each-result">
                <div class="icon circle orange white-text">RD</div>
                <div class="title">Responsive Design</div>
                <div class="label nowrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi consequatur debitis veritatis dolorum, enim libero!</div>
              </div>

              <div class="each-result">
                <div class="icon circle red white-text">
                  <i class="fa fa-tablet"></i>
                </div>
                <div class="title">Mobile First</div>
                <div class="label nowrap">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi consequatur debitis veritatis dolorum, enim libero!</div>
              </div>
            </div>
            <div class="col s12 l4">
              <h4>Posts</h4>

              <div class="no-result">No results were found ;(</div>
            </div>
          </div>

        </div>

      </form>
    </div>
  </div>
  <!-- /Search Bar -->



  <!--
  Chat
    .chat-light - light color scheme
-->
  <div class="chat">
    <div class="layer-overlay"></div>

    <div class="layer-content">

      <!-- Contacts -->
      <div class="contacts">
        <!-- Top Bar -->
        <div class="topbar">
          <a href="#!" class="text">Chat</a>
          <a href="#!" class="chat-toggle"><i class="mdi-navigation-close"></i></a>
        </div>
        <!-- /Top Bar -->

        <div class="nano">
          <div class="nano-content">

            <span class="label">Online</span>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user2.jpg') }}" alt="Felecia Castro" class="circle photo">

              <div class="name">Felecia Castro</div>
              <div class="status">Lorem status</div>

              <div class="online"><i class="green-text fa fa-circle"></i>
              </div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user3.jpg') }}" alt="Max Brooks" class="circle photo">

              <div class="name">Max Brooks</div>
              <div class="status">Lorem status</div>

              <div class="online"><i class="green-text fa fa-circle"></i>
              </div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user4.jpg') }}" alt="Patsy Griffin" class="circle photo">

              <div class="name">Patsy Griffin</div>
              <div class="status">Lorem status</div>

              <div class="online"><i class="green-text fa fa-circle"></i>
              </div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user5.jpg') }}" alt="Chloe Morgan" class="circle photo">

              <div class="name">Chloe Morgan</div>
              <div class="status">Lorem status</div>

              <div class="online"><i class="green-text fa fa-circle"></i>
              </div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user6.jpg') }}" alt="Vernon Garrett" class="circle photo">

              <div class="name">Vernon Garrett</div>
              <div class="status">Lorem status</div>

              <div class="online"><i class="yellow-text fa fa-circle"></i>
              </div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user7.jpg') }}" alt="Greg Mcdonalid" class="circle photo">

              <div class="name">Greg Mcdonalid</div>
              <div class="status">Lorem status</div>

              <div class="online"><i class="yellow-text fa fa-circle"></i>
              </div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user8.jpg') }}" alt="Christian Jackson" class="circle photo">

              <div class="name">Christian Jackson</div>
              <div class="status">Lorem status</div>

              <div class="online"><i class="yellow-text fa fa-circle"></i>
              </div>
            </div>


            <span class="label">Offline</span>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user9.jpg') }}" alt="Willie Kelly" class="circle photo">

              <div class="name">Willie Kelly</div>
              <div class="status">Lorem status</div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user10.jpg') }}" alt="Jenny Phillips" class="circle photo">

              <div class="name">Jenny Phillips</div>
              <div class="status">Lorem status</div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user11.jpg') }}" alt="Darren Cunningham" class="circle photo">

              <div class="name">Darren Cunningham</div>
              <div class="status">Lorem status</div>
            </div>

            <div class="user">
             <img src="{{ URL::asset('dashboard/assets/_con/images/user12.jpg') }}" alt="Sandra Cole" class="circle photo">

              <div class="name">Sandra Cole</div>
              <div class="status">Lorem status</div>
            </div>

          </div>
        </div>
      </div>
      <!-- /Contacts -->

      <!-- Messages -->
      <div class="messages">

        <!-- Top Bar with back link -->
        <div class="topbar">
          <a href="#!" class="chat-toggle"><i class="mdi-navigation-close"></i></a>
          <a href="#!" class="chat-back"><i class="mdi-hardware-keyboard-arrow-left"></i> Back</a>
        </div>
        <!-- /Top Bar with back link -->

        <!-- All messages list -->
        <div class="list">
          <div class="nano scroll-bottom">
            <div class="nano-content">

              <div class="date">Monday, Feb 23, 8:23 pm</div>

              <div class="from-me">
                Hi, Felicia.
                <br>How are you?
              </div>

              <div class="clear"></div>

              <div class="from-them">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user2.jpg') }}" alt="John Doe" class="circle photo">Hi! I am good!
              </div>

              <div class="clear"></div>

              <div class="from-me">
                Glad to see you :)
                <br>This long text is intended to show how the chat will display it.
              </div>

              <div class="clear"></div>

              <div class="from-them">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user2.jpg') }}" alt="John Doe" class="circle photo">Also, we will send the longest word to show how it will fit in the chat window: <strong>Pneumonoultramicroscopicsilicovolcanoconiosis</strong>
              </div>

              <div class="date">Friday, Mar 10, 5:07 pm</div>

              <div class="from-me">
                Hi again!
              </div>

              <div class="clear"></div>

              <div class="from-them">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user2.jpg') }}" alt="John Doe" class="circle photo">Hi! Glad to see you.
              </div>

              <div class="clear"></div>

              <div class="from-me">
                I want to add you in my Facebook.
              </div>

              <div class="clear"></div>

              <div class="from-me">
                Can you give me your page?
              </div>

              <div class="clear"></div>

              <div class="from-them">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user2.jpg') }}" alt="John Doe" class="circle photo">I do not use Facebook. But you can follow me in Twitter.
              </div>

              <div class="clear"></div>

              <div class="from-me">
                It's good idea!
              </div>

              <div class="clear"></div>

              <div class="from-them">
               <img src="{{ URL::asset('dashboard/assets/_con/images/user2.jpg') }}" alt="John Doe" class="circle photo">You can find me here - <a href="https://twitter.com/nkdevv">https://twitter.com/nkdevv</a>
              </div>

            </div>
          </div>
        </div>
        <!-- /All messages list -->

        <!-- Send message -->
        <div class="send">
          <form action="#!">
            <div class="input-field">
              <input id="chat-message" type="text" name="chat-message">
            </div>

            <button class="btn waves-effect z-depth-0"><i class="mdi-content-send"></i>
            </button>
          </form>
        </div>
        <!-- /Send message -->

      </div>
      <!-- /Messages -->
    </div>

  </div>
  <!-- /Chat -->
@stop