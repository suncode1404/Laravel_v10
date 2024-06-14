@include('backend.dashboard.component.breadcrumb', [
    'title' => $config['method'] == 'create' ? $config['seo']['create']['title'] : $config['seo']['edit']['title'],
])

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@php
    $url = $config['method'] == 'create' ? route('user.catalogue.store') : route('user.catalogue.update', $userCatalogues->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin chung của nhóm thành viên</p>
                        <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="inbox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="name" class="control-label text-right">Tên nhóm <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $userCatalogues->name ?? '') }}" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="description" class="control-label text-right">Ghi chú</label>
                                    <input type="text" id="description" name="description"
                                        value="{{ old('description', $userCatalogues->description ?? '') }}" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mt20">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>

<script>
    var province_id = '{{ isset($userCatalogue->province_id) ? $userCatalogue->province_id : old('province_id') }}'
    var district_id = '{{ isset($userCatalogue->district_id) ? $userCatalogue->district_id : old('district_id') }}'
    var ward_id = '{{ isset($userCatalogue->ward_id) ? $userCatalogue->ward_id : old('ward_id') }}'
</script>
