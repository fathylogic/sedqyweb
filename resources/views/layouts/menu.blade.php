  <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="/home" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img width="20" src="{{$root}}/assets/img/branding/logo.png" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold">أوقاف صدقي</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner border">

          <!--  Pages -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-city fa-xl"></i>
              <div data-i18n="ادارة المراكز الربحية">ادارة المراكز الربحية  </div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item">
                <a href="{{ route('centers.index') }}" class="menu-link">
                  <i class="menu-ico fa-solid fa-building"></i>
                  <div data-i18n="المراكز الرئيسية">المراكز الرئيسية</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('units.index') }}" class="menu-link">
                    <i class="menu-ico fa-solid fa-sack-dollar"></i>
                  <div data-i18n="الوحدات الربحية">الوحدات الربحية</div>
                </a>
              </li>
              <li class="menu-item ">
                <a href="{{ route('employees.index') }}" class="menu-link">
                    <i class="menu-ico fa-solid fa-user-tie"></i>
                  <div data-i18n="الموظفين">الموظفين</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('renters.index') }}" class="menu-link">
                    <i class="menu-ico fa-solid fa-users"></i>
                  <div data-i18n="المستأجرين">المستأجرين</div>
                </a>
              </li>
            </ul>
          </li>

          <!--  Pages -->
          <li class="menu-item  ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon fa-solid fa-vault px-1"></i>
              <div data-i18n="ادارة الاموال">ادارة الاموال</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ route('sarfs.index') }}" class="menu-link">
                  <i class="menu-ico fa-solid fa-file-invoice-dollar"></i>
                  <div data-i18n="المصروفات">المصروفات</div>
                </a>
              </li>
              <li class="menu-item  ">
                <a href="{{ route('payrolls.index') }}" class="menu-link">
                  <i class="menu-ico fa-solid fa-wallet"></i>
                  <div data-i18n="المرتبات">المرتبات</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('payments.index') }}" class="menu-link">
                    <i class="menu-ico fa-solid fa-money-bill-trend-up"></i>
                  <div data-i18n="الايرادات">الايرادات</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="menu-ico fa-solid fa-file-export"></i>
                  <div data-i18n="تقارير">تقارير</div>
                </a>
              </li>
            </ul>
          </li>
          @if($current_user->is_admin)
           <li class="menu-item  ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class="menu-icon fa-solid fa-sliders"></i>
              <div data-i18n="اعدادات عامة">  اعدادات عامة</div>
            </a>

            <ul class="menu-sub">
              <li class="menu-item ">
                <a href="{{ route('users.index')}}" class="menu-link">
                 <i class="menu-ico  fa-solid fa-user-gear"></i>
                  <div data-i18n="المستخدمين">المستخدمين</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="{{ route('recipients.index') }}" class="menu-link">
                    <i class="menu-ico fa-solid fa-user-group"></i>
                  <div data-i18n="المستفيدين">المستفيدين</div>
                </a>
              </li>

            </ul>
          </li>


          @endif
        </ul>
        </li>


        </ul>
        </li>
        </ul>

        <div class="col-md-12 text-center">

          <DIV class="col-md-12 border">
            <div class="py-2" id="dayname"></div>
          </DIV>
          <div class="col-md-12 border">
            <h6 id="date" class="date d-none"></h6>
            <div class="py-2" id="monthname"></div>
          </div>
          <div class="col-md-12" style="background-color: #489164;">
            <h6 id="time" class="py-2" style="color:  #ffffff;;"></h6>
          </div>
        </div>
      </aside>
