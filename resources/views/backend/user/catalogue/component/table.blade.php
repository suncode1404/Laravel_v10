<table class="table table-bordered mt20">
    <thead>
        <tr>
            <th class="text-center">
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th class="text-center">Tên nhóm thành viên</th>
            <th class="text-center">Số thành viên</th>
            <th class="text-center">Mô tả</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @if (isset($userCatalogues) && is_object($userCatalogues))
            @foreach ($userCatalogues as $userCatalogue)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" value="{{ $userCatalogue->id }}" class="input-checkbox checkBoxItem">
                    </td>
                    <td class="text-center">{{ $userCatalogue->name }}</td>
                    <td class="text-center">{{ $userCatalogue->users_count }} người </td>
                    <td class="text-center">{{ $userCatalogue->description }}</td>
                    <td class="text-center js-switch-{{$userCatalogue->id}}">
                        <input type="checkbox" value="{{ $userCatalogue->publish }}" class="js-switch status"
                            data-field="publish" data-model="UserCatalogue" {{ $userCatalogue->publish == 2 ? 'checked' : '' }}
                            data-modelId = "{{ $userCatalogue->id }}" />
                    </td>
                    <td class="text-center">
                        <a href="{{ route('user.catalogue.edit', $userCatalogue->id) }}" class="btn btn-success"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ route('user.catalogue.delete', $userCatalogue->id) }}" class="btn btn-danger"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        @endif

    </tbody>
</table>
<div class="uk-flex uk-flex-middle">
    {{ $userCatalogues->links('pagination::bootstrap-4') }}
</div>
