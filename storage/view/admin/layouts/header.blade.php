<div id="kt_header" class="header  header-fixed " >
	<div class=" container  d-flex align-items-stretch justify-content-between">
		<div class="d-none d-lg-flex align-items-center mr-3">
			<button class="btn btn-icon aside-toggle ml-n3 mr-10" id="kt_aside_desktop_toggle">
				<i class="flaticon2-soft-icons icon-xl"></i>
			</button>

			<a href="{{ url('admin') }}">
				<img alt="Logo" src="{{ asset('backend/media/logos/Logo.png') }}" class="logo-sticky max-h-35px"/>
			</a>
		</div>
		<div class="topbar">
			<div class="dropdown">
				<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
					<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
						<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
						<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
							{{ !empty(auth()) ? auth()['name'] : 'User' }}
						</span>
						<span class="symbol symbol-lg-35 symbol-25">
							<span class="symbol-label font-size-h5 font-weight-bold">
								{{ !empty(auth()) ? substr(auth()['name'], 0, 1) : 'U' }}
							</span>
						</span>
					</div>
				</div>

				<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi navi-hover py-4">
                        <li class="navi-item">
                            <a href="{{ url('admin/logout') }}" class="navi-link">
                                <span class="symbol symbol-20 mr-3"><i class="flaticon-logout"></i></span>
                                <span class="navi-text">Logout</span>
                            </a>
                        </li>
                    </ul>
		    	</div>
			</div>
		</div>
	</div>
</div>