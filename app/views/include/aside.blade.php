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
                        @if(PerC::isShow('main_info','company','show_edit_add'))
                            <li>
                                <a href="{{ URL::route('editCompanyInfo') }}"
                                   class="waves-effect waves-blue">  @lang('main.companyInfo') </a>
                            </li>
                        @endif
                        @if(PerC::isShow('main_info','branch','show_edit_add'))
                            <li>
                                <a href="{{ URL::route('addBranch') }}"
                                   class="waves-effect waves-blue"> @lang('main.branchInfo')  </a>
                            </li>
                        @endif
                        @if(PerC::isShow('main_info','cat','show_edit_add'))
                            <li>
                                <a href="{{ URL::route('addCategory') }}"
                                   class="waves-effect waves-blue"> @lang('main.itemCat') </a>
                            </li>
                        @endif

                        @if($company->co_use_season == 1)
                            @if(PerC::isShow('main_info','season','show_edit_add'))
                                <li>
                                    <a href="{{ URL::route('addSeason') }}"
                                       class="waves-effect waves-blue"> @lang('main.seasons') </a>
                                </li>
                            @endif
                        @endif

                        @if($company->co_use_markes_models == 1)
                            @if(PerC::isShow('main_info','mark_model','show_edit_add'))
                                <li>
                                    <a href="{{ URL::route('addMark') }}"
                                       class="waves-effect waves-blue">  @lang('main.markes') </a>
                                </li>
                                <li>
                                    <a href="{{ URL::route('addModel') }}"
                                       class="waves-effect waves-blue">  @lang('main.models') </a>
                                </li>
                            @endif
                        @endif
                        @if(PerC::isShow('main_info','item','show_edit_add'))
                            <li>
                                <a href="{{ URL::route('addItem') }}"
                                   class="waves-effect waves-blue"> @lang('main.items')</a>
                            </li>
                        @endif
                        @if(PerC::isShow('main_info','add_account','show_edit_add'))
                            <li>
                                <a href="{{  URL::route('addAccount','customers') }}"
                                   class="waves-effect waves-blue"> @lang('main.accounts') </a>
                            </li>
                        @endif
                        @if(PerC::isShow('main_info','users','show_edit_add'))
                            <li>
                                <a href="{{  URL::route('addUser') }}"
                                   class="waves-effect waves-blue"> @lang('main.users')   </a>
                            </li>{{-- users --}}
                        @endif
                        <li>
                            <a href="{{  URL::route('set_Password') }}"
                               class="waves-effect waves-blue">     @lang('main.change_password')  </a>
                        </li>

                    </ul>
                </li>
                @if(PerC::isMainPerm('balances','show_add'))
                    <li class="{{@$itemBalance}}">
                        <a class="yay-sub-toggle waves-effect waves-blue"><i
                                    class="fa fa-dashboard"></i> @lang('main.balances') <span
                                    class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>
                            @if(PerC::isShow('balances','itemBalance','add_show'))
                                @if(@$branches['all_br'] == "all_br")
                                    <li>
                                        <a class="yay-sub-toggle waves-effect waves-blue">   @lang('main.itemBalance')
                                            <span
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
                                @endif{{-- item balance رصيد افتتاحي--}}
                            @endif
                            @if(PerC::isShow('balances','accountsBalances','add_show'))
                                <li>
                                    <a href="{{ URL::route('addAccountsBalances') }}"
                                       class="waves-effect waves-blue"> @lang('main.balanceAccount')</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(PerC::isMainPerm('settles','show_add'))
                    <li class="{{@$TransOpen}}">
                        <a class="yay-sub-toggle waves-effect waves-blue"><i
                                    class="fa fa-dashboard"></i> @lang('main.stores')<span
                                    class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>
                            @if(@$branches['all_br'] == "all_br")
                                @if(PerC::isShow('settles','settleAdd','add_show'))
                                    <li>
                                        <a class="yay-sub-toggle waves-effect waves-blue">   @lang('main.settleAdd')
                                            <span
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
                                @endif
                                @if(PerC::isShow('settles','settleDown','add_show'))
                                    <li>
                                        <a class="yay-sub-toggle waves-effect waves-blue">   @lang('main.settleDown')
                                            <span
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
                                @endif
                            @else
                                <li>
                                    @if(PerC::isShow('settles','settleAdd','add_show'))
                                        <a href="{{ URL::route('addTrans',array("settleAdd",$branches)) }}"
                                           class="waves-effect waves-blue"> @lang('main.settleAdd')</a>
                                    @endif
                                    @if(PerC::isShow('settles','settleDown','add_show'))
                                        <a href="{{ URL::route('addTrans',array("settleDown",$branches)) }}"
                                           class="waves-effect waves-blue">@lang('main.settleDown')</a>
                                    @endif
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if(PerC::isMainPerm('hr','show_add_edit'))
                    <li class="{{@$employees}}">
                        <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> شؤون العاملين
                            <span class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>
                            @if(PerC::isShow('hr','Departments','add_show_edit'))
                                <li><a href="{{ URL::route('addDep') }}" class="waves-effect waves-blue">الاقسام </a>
                                </li>
                            @endif
                            @if(PerC::isShow('hr','jobs','add_show_edit'))
                                <li><a href="{{ URL::route('addJob') }}" class="waves-effect waves-blue">الوظائف </a>
                                </li>
                            @endif
                            @if(PerC::isShow('hr','Employee','add_show_edit'))
                                <li><a href="{{ URL::route('addEmp') }}" class="waves-effect waves-blue"> اضف موظف </a>
                                </li>
                            @endif
                            @if(PerC::isShow('hr','loans','add_show_edit'))
                                <li><a href="{{ URL::route('addLoans') }}" class="waves-effect waves-blue">القروض </a>
                                </li>
                            @endif
                            @if(PerC::isShow('hr','Desdeds','add_show_edit'))
                                <li><a href="{{ URL::route('addDesded') }}" class="waves-effect waves-blue">بنود
                                        الاستحقاقات </a></li>
                            @endif
                            @if(PerC::isShow('hr','Empdesded','add_show_edit'))
                                <li><a href="{{ URL::route('addEmpdesded') }}" class="waves-effect waves-blue"> بنود
                                        الاستحقاقات
                                        للموظف </a></li>
                            @endif
                            @if(PerC::isShow('hr','MonthChange','add_show_edit'))
                                <li><a href="{{ URL::route('addMonthChange') }}" class="waves-effect waves-blue">التغيرات
                                        الشهريه</a></li>
                            @endif
                            @if(PerC::isShow('hr','salariesProcessing','add_show_edit'))
                                <li><a href="{{ URL::route('monthSalarySearch') }}" class="waves-effect waves-blue">تجهيز
                                        المرتبات الشهريه </a></li>
                            @endif

                        </ul>
                    </li>{{-- HR شئون العاملين--}}
                @endif
                @if(PerC::isMainPerm('invoices','show_add'))
                    <li class="{{@$invoices_open}}">
                        <a class="yay-sub-toggle waves-effect waves-blue"><i class="fa fa-dashboard"></i> الفواتير <span
                                    class="yay-collapse-icon mdi-navigation-expand-more"></span></a>
                        <ul>

                            @if(@$branches['all_br'] == "all_br")
                                @if(PerC::isShow('invoices','sales','add_show'))
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
                                    </li>{{-- sales invoice فاتورة مشتريات للفروع--}}
                                @endif
                                @if(PerC::isShow('invoices','buy','add_show'))
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
                                    </li>{{-- sales invoice فاتورة مبيعات للفروع--}}
                                @endif
                            @else
                                <li>
                                    @if(PerC::isShow('invoices','sales','add_show'))
                                        <a href="{{ URL::route('addTrans',array("sales",$branches)) }}"
                                           class="waves-effect waves-blue"> فاتورة مبيعات</a>
                                    @endif{{-- sales invoice فاتورة مشتريات--}}
                                    @if(PerC::isShow('invoices','buy','add_show'))
                                        <a href="{{ URL::route('addTrans',array("buy",$branches)) }}"
                                           class="waves-effect waves-blue"> فاتورة
                                            مشتريات</a>{{-- sales invoice فاتورة مبيعات--}}
                                    @endif{{-- sales invoice فاتورة مبيعات--}}
                                </li>
                            @endif
                            @if(@$branches['all_br'] == "all_br")
                                @if(PerC::isShow('invoices','salesReturn','add_show'))
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
                                    </li> {{-- sales invoice فاتورة مرتجع مشتريات للفروع--}}
                                @endif
                                @if(PerC::isShow('invoices','buyReturn','add_show'))
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
                                    </li>{{-- sales invoice فاتورة مرتجع مبيعات للفروع--}}
                                @endif
                            @else
                                <li>
                                    @if(PerC::isShow('invoices','salesReturn','add_show'))
                                        <a href="{{ URL::route('addTrans',array("salesReturn",$branches)) }}"
                                           class="waves-effect waves-blue"> فاتورة مبيعات</a>
                                    @endif{{-- sales invoice فاتورة مترجع مشتريات--}}
                                    @if(PerC::isShow('invoices','buyReturn','add_show'))
                                        <a href="{{ URL::route('addTrans',array("buyReturn",$branches)) }}"
                                           class="waves-effect waves-blue"> فاتورة مشتريات</a>
                                    @endif{{-- sales invoice فاتورة مترجع مبيعات--}}
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif
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
                                       class="waves-effect waves-blue"> مرتجعات المبيعات (تحليلى)</a>
                                    <a href="{{ URL::route('searchReportInvoices',array('salesReturn','sum')) }}"
                                       class="waves-effect waves-blue"> مرتجعات المبيعات (إجمالى) </a>
                                    <a href="{{ URL::route('searchReportInvoices','buy') }}"
                                       class="waves-effect waves-blue"> المشتريات ( تحليلى ) </a>
                                    <a href="{{ URL::route('searchReportInvoices',array('buy','sum')) }}"
                                       class="waves-effect waves-blue"> المشتريات ( إجمالى) </a>
                                    <a href="{{ URL::route('searchReportInvoices',array('buyReturn',NULL)) }}"
                                       class="waves-effect waves-blue">مردودات المشتريات (تحليلى)</a>
                                    <a href="{{ URL::route('searchReportInvoices',array('buyReturn','sum')) }}"
                                       class="waves-effect waves-blue">مردودات المشتريات (إجمالى) </a>
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