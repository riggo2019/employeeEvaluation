<div class="container-fluid">
    <div class="d-flex flex-column justify-content-start gap-4">
        <h1 class="fs-3">{{ __('admin.admin_title') }}</h1>
        <p>{{ __('admin.welcome') }} {{ Auth::user()->last_name }}!</p>
        <div class="mb-3 d-flex flex-row align-items-center">
            <button class="toggle-admin-option w-25 btn btn-primary p-3">{{ __('admin.employee_manager') }}</button>
            <div class="group-items ms-2">
                <a href="{{ route('admin.users') }}" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.employee_list') }}</a>
                <a href="{{ route('admin.addUsers') }}" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.add_employee') }}</a>
            </div>
        </div>
        <div class="mb-3 d-flex flex-row align-items-center">
            <button class="toggle-admin-option w-25 btn btn-success p-3">{{ __('admin.scoreListbyCategory') }}</button>
            <div class="group-items ms-2">
                <a href="{{ route('admin.scoreListbyCategory', ['department_id' => 1]) }}" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.department_1') }}</a>
                <a href="{{ route('admin.scoreListbyCategory', ['department_id' => 2]) }}" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.department_2') }}</a>
                <a href="{{ route('admin.scoreListbyCategory', ['department_id' => 3]) }}" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.department_3') }}</a>
                <a href="{{ route('admin.scoreListbyCategory', ['department_id' => 4]) }}" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.department_4') }}</a>
            </div>
        </div>
        <div class="mb-3 d-flex flex-row align-items-center">
            <button class="toggle-admin-option w-25 btn btn-warning p-3">{{ __('admin.scoreListByEmployee') }}</button>
            <div class="group-items ms-2">
                <a href="#" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.department_1') }}</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.department_2') }}</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.department_3') }}</a>
                <a href="#" class="btn btn-primary p-3 w-20 text-white">{{ __('admin.department_4') }}</a>
            </div>
        </div>
    </div>
</div>
