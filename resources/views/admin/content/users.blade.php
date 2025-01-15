<script>
    var locale = '{{ app()->getLocale() }}';
    console.log(locale);
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="card easion-card">
            <div class="card-header">
                <div class="easion-card-icon">
                    <i class="fas fa-table"></i>
                </div>
                <div class="easion-card-title">{{ __('admin.employee_list') }}</div>
            </div>
            <div class="card-body">
                <table id="usersTable" class="">
                    <thead>
                        <tr>
                            <th>{{ __('admin.index') }}</th>
                            <th>{{ __('admin.employee_name') }}</th>
                            <th>{{ __('admin.department') }}</th>
                            <th>{{ __('admin.user_name') }}</th>
                            <th>{{ __('admin.role') }}</th>
                            <th class="text-center">{{ __('admin.start_date') }}</th>
                            <th class="text-center">{{ __('admin.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->department_name }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->is_admin == 0 ?  __('admin.employee_role')  :  __('admin.admin_role')  }}</td>
                                <td class="text-center">{{ $user->formatted_start_date }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.editUsers', ['id' => $user->id]) }}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.deleteUser', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('{{ __('admin.delete_user_confirm') }}');" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>var locale = '{{ app()->getLocale() }}';</script>
