<!--
  Yay Sidebar
  Options [you can use all of theme classnames]:
    .yay-hide-to-small         - no hide menu, just set it small with big icons
    .yay-static                - stop using fixed sidebar (will scroll with content)
    .yay-gestures              - to show and hide menu using gesture swipes
    .yay-light                 - light color scheme
    .yay-hide-on-content-click - hide menu on content click

  Effects [you can use one of these classnames]:
    .yay-overlay  - overlay content
    .yay-push     - push content to right
    .yay-shrink   - shrink content width
-->
<?php

$branches = BaseController::getBranchId();
$company = CoData::find(Auth::user()->co_id);
?>

<aside class="yaybar yay-shrink yay-hide-to-small yay-gestures">
    <div class="top">
        <div>
            <!-- Sidebar toggle -->
            <a href="#" class="yay-toggle">
                <div class="burg1"></div>
                <div class="burg2"></div>
                <div class="burg3"></div>
            </a>
            <!-- Sidebar toggle -->
            <!-- Logo -->
            <a href="#!" class="brand-logo">
                {{ URL::asset('dashboard/assets/_con/images/logo-white.png') }}" alt="Con">
            </a>
            <!-- /Logo -->
        </div>
    </div>
    <div class="nano has-scrollbar">
        <div class="nano-content">

            <ul>

                <li class="label">
                    <h5>
                        @lang('main.mainInfo')
                    </h5>

                </li>

                <li class="{{@$asideOpen}}">
                    <a class="yay-sub-toggle waves-effect waves-blue"><i
                                class="fa fa-dashboard"></i> @lang('main.mainList')<span
                                class="yay-collapse-icon mdi-navigation-expand-more"></span></a>

                    <ul>
                        @if(PerC::isSession('main_info','company','add'))
                            <li>
                                <a href="{{ URL::route('editCompanyInfo') }}"
                                   class="waves-effect waves-blue">  @lang('main.companyInfo') </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ URL::route('addBranch') }}"
                               class="waves-effect waves-blue"> @lang('main.branchInfo')  </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('addCategory') }}"
                               class="waves-effect waves-blue"> @lang('main.itemCat') </a>
                        </li>
                        @if($company->co_use_season == 1)
                            <li>
                                <a href="{{ URL::route('addSeason') }}"
                                   class="waves-effect waves-blue"> @lang('main.seasons') </a>
                            </li>
                        @endif

                        @if($company->co_use_markes_models == 1)
                            <li>
                                <a href="{{ URL::route('addMark') }}"
                                   class="waves-effect waves-blue">  @lang('main.markes') </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('addModel') }}"
                                   class="waves-effect waves-blue">  @lang('main.models') </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ URL::route('addItem') }}"
                               class="waves-effect waves-blue"> @lang('main.items')</a>
                        </li>
                        <li>
                            <a href="{{  URL::route('addAccount','customers') }}"
                               class="waves-effect waves-blue"> @lang('main.accounts') </a>
                        </li>
                        <li>
                            <a href="{{  URL::route('addUser') }}"
                               class="waves-effect waves-blue"> @lang('main.users')   </a>
                        </li>
                        <li>
                            <a href="{{  URL::route('set_Password') }}"
                               class="waves-effect waves-blue">     @lang('main.change_password')  </a>
                        </li>

                    </ul>
                </li>
                </li>
                <li class="{{@$itemBalance}}">
                    <a class="yay-sub-toggle waves-effect waves-blue"><i
                                class="fa fa-dashboard"></i> @lang('main.balances') <span
                                class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>
                        @if(@$branches['all_br'] == "all_br")
                            <li>
                                <a class="yay-sub-toggle waves-effect waves-blue">   @lang('main.itemBalance') <span
                                            class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                                <ul>
                                    <li>
                                        @foreach($branches['branches'] as $branch)
                                            <a href="{{ URL::route('addTrans',array("itemBalance",$branch->id)) }}"
                                               class="waves-effect waves-blue">
                                                فرع {{$branch->br_name}}
                                            </a>
                                        @endforeach
                                    </li>

                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{ URL::route('addTrans',array("itemBalance",$branches)) }}"
                                   class="waves-effect waves-blue"> @lang('main.itemBalance')</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ URL::route('addAccountsBalances') }}"
                               class="waves-effect waves-blue"> @lang('main.balanceAccount')</a>
                        </li>
                    </ul>
                </li>
                <li class="{{@$TransOpen}}">
                    <a class="yay-sub-toggle waves-effect waves-blue"><i
                                class="fa fa-dashboard"></i> @lang('main.stores')<span
                                class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>
                        @if(@$branches['all_br'] == "all_br")
                            <li>
                                <a class="yay-sub-toggle waves-effect waves-blue">   @lang('main.settleAdd') <span
                                            class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                                <ul>
                                    <li>
                                        @foreach($branches['branches'] as $branch)
                                            <a href="{{ URL::route('addTrans',array("settleAdd",$branch->id)) }}"
                                               class="waves-effect waves-blue">
                                                فرع {{$branch->br_name}}
                                            </a>
                                        @endforeach
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a class="yay-sub-toggle waves-effect waves-blue">   @lang('main.settleDown') <span
                                            class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                                <ul>
                                    <li>
                                        @foreach($branches['branches'] as $branch)
                                            <a href="{{ URL::route('addTrans',array("settleDown",$branch->id)) }}"
                                               class="waves-effect waves-blue">
                                                فرع {{$branch->br_name}}
                                            </a>
                                        @endforeach
                                    </li>

                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{ URL::route('addTrans',array("settleAdd",$branches)) }}"
                                   class="waves-effect waves-blue"> @lang('main.settleAdd')</a>
                                <a href="{{ URL::route('addTrans',array("settleDown",$branches)) }}"
                                   class="waves-effect waves-blue">@lang('main.settleDown')</a>
                            </li>
                        @endif

                    </ul>
                </li>
                <li class="{{@$employees}}">
                    <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> شؤون العاملين
                        <span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>
                        <li><a href="{{ URL::route('addDep') }}" class="waves-effect waves-blue">الاقسام </a></li>
                        <li><a href="{{ URL::route('addJob') }}" class="waves-effect waves-blue">الوظائف </a></li>
                        <li><a href="{{ URL::route('addEmp') }}" class="waves-effect waves-blue"> اضف موظف </a></li>
                        <li><a href="{{ URL::route('addLoans') }}" class="waves-effect waves-blue">القروض </a></li>
                        <li><a href="{{ URL::route('addDesded') }}" class="waves-effect waves-blue">بنود
                                الاستحقاقات </a></li>
                        <li><a href="{{ URL::route('addEmpdesded') }}" class="waves-effect waves-blue"> بنود الاستحقاقات
                                للموظف </a></li>
                        <li><a href="{{ URL::route('addMonthChange') }}" class="waves-effect waves-blue">التغيرات
                                الشهريه</a></li>
                        <li><a href="{{ URL::route('monthSalarySearch') }}" class="waves-effect waves-blue">تجهيز
                                المرتبات الشهريه </a></li>
                    </ul>
                </li>
                <li class="{{@$invoices_open}}">
                    <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> الفواتير <span
                                class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>

                        @if(@$branches['all_br'] == "all_br")
                            <li>
                                <a class="yay-sub-toggle waves-effect waves-blue"> فاتورة مبيعات <span
                                            class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                                <ul>
                                    <li>
                                        @foreach($branches['branches'] as $branch)
                                            <a href="{{ URL::route('addTrans',array("sales",$branch->id)) }}"
                                               class="waves-effect waves-blue">
                                                فرع {{$branch->br_name}}
                                            </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="yay-sub-toggle waves-effect waves-blue"> فاتورة مشتريات <span
                                            class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                                <ul>
                                    <li>
                                        @foreach($branches['branches'] as $branch)
                                            <a href="{{ URL::route('addTrans',array("buy",$branch->id)) }}"
                                               class="waves-effect waves-blue">
                                                فرع {{$branch->br_name}}
                                            </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{ URL::route('addTrans',array("sales",$branches)) }}"
                                   class="waves-effect waves-blue"> فاتورة مبيعات</a>
                                <a href="{{ URL::route('addTrans',array("buy",$branches)) }}"
                                   class="waves-effect waves-blue"> فاتورة مشتريات</a>
                            </li>
                        @endif
                        @if(@$branches['all_br'] == "all_br")
                            <li>
                                <a class="yay-sub-toggle waves-effect waves-blue"> فاتورة مرتجعات مبيعات <span
                                            class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                                <ul>
                                    <li>
                                        @foreach($branches['branches'] as $branch)
                                            <a href="{{ URL::route('addTrans',array("salesReturn",$branch->id)) }}"
                                               class="waves-effect waves-blue">
                                                فرع {{$branch->br_name}}
                                            </a>
                                        @endforeach
                                    </li>
                                    {{--<li><a href="{{ URL::route('purchasesReturns') }}" class="waves-effect waves-blue"> فواتير المبيعات  </a></li>--}}
                                    {{--<li><a href="{{ URL::route('salesReturns') }}" class="waves-effect waves-blue">  فواتير المشتريات </a></li>--}}
                                </ul>
                            </li>
                            <li>
                                <a class="yay-sub-toggle waves-effect waves-blue"> فاتورة مرتجعات مشتريات <span
                                            class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                                <ul>
                                    <li>
                                        @foreach($branches['branches'] as $branch)
                                            <a href="{{ URL::route('addTrans',array("buyReturn",$branch->id)) }}"
                                               class="waves-effect waves-blue">
                                                فرع {{$branch->br_name}}
                                            </a>
                                        @endforeach
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{ URL::route('addTrans',array("salesReturn",$branches)) }}"
                                   class="waves-effect waves-blue"> فاتورة مبيعات</a>
                                <a href="{{ URL::route('addTrans',array("buyReturn",$branches)) }}"
                                   class="waves-effect waves-blue"> فاتورة مشتريات</a>
                            </li>
                        @endif

                    </ul>
                </li>
                <li class="">
                    <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> الحسابات العامة
                        <span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>
                        <li>
                            <a class="yay-sub-toggle waves-effect waves-blue">الخزينة <span
                                        class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                            <ul>

                                <li>
                                    <a href="{{ URL::route('dailyTreasurySearch') }}" class="waves-effect waves-blue">
                                        يومية الخزينة </a>
                                    <a href="{{ URL::route('addDirectMovement') }}" class="waves-effect waves-blue">
                                        الحركات المباشرة </a>
                                </li>
                            </ul>
                        </li>

                        <li><a href="{{ URL::route('searchAccounts','customers') }}"
                               class="waves-effect waves-blue"> @lang('main.accounts_customers')</a></li>
                        <li><a href="{{ URL::route('searchAccounts','suppliers') }}"
                               class="waves-effect waves-blue"> @lang('main.accounts_suppliers') </a></li>
                        <li><a href="{{ URL::route('searchAccounts','bank') }}"
                               class="waves-effect waves-blue">   @lang('main.accounts_bank')</a></li>
                        <li><a href="{{ URL::route('searchAccounts','partners') }}"
                               class="waves-effect waves-blue">  @lang('main.accounts_partners') </a></li>
                        <li><a href="{{ URL::route('searchAccounts','multiple_revenue') }}"
                               class="waves-effect waves-blue">  @lang('main.accounts_multiple_revenue') </a></li>
                        <li><a href="{{ URL::route('searchAccounts','expenses') }}"
                               class="waves-effect waves-blue">  @lang('main.accounts_expenses') </a></li>
                    </ul>
                </li>

                <li class="">
                    <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> التقارير <span
                                class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                    <ul>
                        <li>
                            <a class="yay-sub-toggle waves-effect waves-blue">شئون العاملين <span
                                        class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                            <ul>

                                <li>
                                    <a href="{{ URL::route('searchOutgoingSalariesReport') }}"
                                       class="waves-effect waves-blue"> المرتبات المنصرفة </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="yay-sub-toggle waves-effect waves-blue"> المخازن <span
                                        class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                            <ul>

                                <li>
                                    <a href="{{ URL::route('reportSettleSearch','settleAdd') }}"
                                       class="waves-effect waves-blue"> تسويات الإضافة </a>
                                    <a href="{{ URL::route('reportSettleSearch','settleDown') }}"
                                       class="waves-effect waves-blue"> تسويات الخصم </a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('searchItemCard') }}"
                                       class="waves-effect waves-blue">   @lang('main.itemCart') </a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('searchTheBalanceOfTheStores','inventory_store') }}"
                                       class="waves-effect waves-blue">  @lang('main.inventoryStore')   </a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('searchTheBalanceOfTheStores','balance_stores') }}"
                                       class="waves-effect waves-blue">@lang('main.balance_stores')  </a>
                                    <a href="{{ URL::route('searchTheBalanceOfTheStores','evaluation_stores') }}"
                                       class="waves-effect waves-blue">@lang('main.evaluation_stores')  </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="yay-sub-toggle waves-effect waves-blue"> الفواتير <span
                                        class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                            <ul>
                                <li>
                                    <a href="{{ URL::route('searchReportInvoices',array('sales',NULL)) }}"
                                       class="waves-effect waves-blue"> المبيعات ( تحليلى ) </a>
                                    <a href="{{ URL::route('searchReportInvoices',array('sales','sum')) }}"
                                       class="waves-effect waves-blue"> المبيعات ( إجمالى) </a>
                                    <a href="{{ URL::route('searchReportInvoices',array('salesReturn',NULL)) }}"
                                       class="waves-effect waves-blue">     مرتجعات المبيعات  (تحليلى)</a>
                                    <a href="{{ URL::route('searchReportInvoices',array('salesReturn','sum')) }}"
                                       class="waves-effect waves-blue">    مرتجعات المبيعات  (إجمالى) </a>
                                    <a href="{{ URL::route('searchReportInvoices','buy') }}"
                                       class="waves-effect waves-blue"> المشتريات ( تحليلى ) </a>
                                    <a href="{{ URL::route('searchReportInvoices',array('buy','sum')) }}"
                                       class="waves-effect waves-blue"> المشتريات ( إجمالى) </a>
                                    <a href="{{ URL::route('searchReportInvoices',array('buyReturn',NULL)) }}"
                                       class="waves-effect waves-blue">مردودات المشتريات (تحليلى)</a>
                                    <a href="{{ URL::route('searchReportInvoices',array('buyReturn','sum')) }}"
                                       class="waves-effect waves-blue">مردودات المشتريات (إجمالى)  </a>
                                    <a href="{{ URL::route('searchReportInvoices','sales-earnings') }}"
                                       class="waves-effect waves-blue">أرباح المبيعات</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>


        </div>
    </div>
</aside>
<!-- /Yay Sidebar -->