<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card easion-card">
                <div class="card-header">
                    <div class="easion-card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="easion-card-title">{{ __('admin.add_employee') }}</div>
                </div>
                <div class="card-body ">
                    <form action="{{ route('admin.storeUsers') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">{{ __('admin.first_name') }} <span class="text-danger">(*)</span></label>
                                <input name="first_name" type="text" class="form-control" id="first_name" 
                                placeholder="{{ __('admin.first_name_input') }}" value="{{ old('first_name') }}" required>
                                @if ($errors->has('first_name'))
                                <span class="text-danger ds-alert">* {{ $errors->first('first_name') }}</span>
                            @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">{{ __('admin.last_name') }} <span class="text-danger">(*)</span></label>
                                <input name="last_name" type="text" class="form-control" id="last_name" 
                                placeholder="{{ __('admin.last_name_input') }}" value="{{ old('last_name') }}" required>
                                @if ($errors->has('last_name'))
                                <span class="text-danger ds-alert">* {{ $errors->first('last_name') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="department_id">{{ __('admin.department') }} <span class="text-danger">(*)</span></label>
                                <select name="department_id" id="department_id" class="form-control" required >
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" 
                                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="is_admin">{{ __('admin.role') }} <span class="text-danger">(*)</span></label>
                                <select name="is_admin" id="is_admin" class="form-control" required>
                                    <option value="1" {{ old('is_admin') == 1 ? 'selected' : '' }}>{{ __('admin.admin_role') }}</option>
                                    <option value="0" {{ old('is_admin') == 0 ? 'selected' : '' }}>{{ __('admin.employee_role') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="user_name">{{ __('admin.user_name') }} <span class="text-danger">(*)</span></label>
                                <input name="user_name" type="text" class="form-control" id="user_name" 
                                placeholder="{{ __('admin.user_name_input') }}" value="{{ old('user_name') }}" required>
                                @if ($errors->has('user_name'))
                                <span class="text-danger ds-alert">* {{ $errors->first('user_name') }}</span>
                            @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">{{ __('admin.password') }} <span class="text-danger">(*)</span></label>
                                <input name="password" type="password" class="form-control" id="password" 
                                placeholder="{{ __('admin.password_input') }}" required>
                                @if ($errors->has('password'))
                                <span class="text-danger ds-alert">* {{ $errors->first('password') }}</span>
                            @endif
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="start_date">{{ __('admin.start_date') }}</label>
                                <input name="start_date" type="date" class="form-control" id="start_date" value="{{ old('start_date') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">{{ __('admin.re_password') }} <span class="text-danger">(*)</span></label>
                                <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" 
                                placeholder="{{ __('admin.re_password_input') }}" required>
                                @if ($errors->has('password.confirmed'))
                                <span class="text-danger ds-alert">* {{ $errors->first('password') }}</span>
                            @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('admin.register') }}</button>
                        <button type="reset" class="btn btn-secondary">{{ __('admin.clear') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>