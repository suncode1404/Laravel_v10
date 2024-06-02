<table class="table table-bordered mt20">
    <thead>
        <tr>
            <th class="text-center">
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th class="text-center">Họ Tên</th>
            <th class="text-center">Email</th>
            <th class="text-center">Số điện thoại</th>
            <th class="text-center">Địa Chỉ</th>
            <th class="text-center">Tình Trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($users) && is_object($users))
            @foreach ($users as $user)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" value="{{ $user->id }}" class="input-checkbox checkBoxItem">
                    </td>
                    <td class="text-center">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->phone }}</td>
                    <td class="text-center">{{ $user->address }}</td>
                    <td class="text-center js-switch-{{$user->id}}">
                        <input type="checkbox" value="{{ $user->publish }}" class="js-switch status"
                            data-field="publish" data-model="User" {{ $user->publish == 1 ? 'checked' : '' }}
                            data-modelId = "{{ $user->id }}" />
                    </td>
                    <td class="text-center">
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif

    </tbody>
</table>
<div class="uk-flex uk-flex-middle">
    {{ $users->links('pagination::bootstrap-4') }}
</div>
