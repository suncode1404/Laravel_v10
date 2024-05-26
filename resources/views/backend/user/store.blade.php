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
    $url = $config['method'] == 'create' ? route('user.store') : route('user.update', $user->id);
@endphp
<form action="{{ $url }}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin chung của người sử dụng</p>
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
                                    <label for="email" class="control-label text-right">Email <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" id="email" name="email"
                                        value="{{ old('email', $user->email ?? '') }}" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="name" class="control-label text-right">Họ tên<span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $user->name ?? '') }}" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>

                        @php
                            $userCatalogue = ['Chọn nhóm thành viên', 'Quản trị viên', 'Cộng tác viên'];
                        @endphp
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="user_catalogue_id" class="control-label text-right">Nhóm thành viên
                                        <span class="text-danger">(*)</span></label>
                                    <select name="user_catalogue_id" id="user_catalogue_id"
                                        class="form-control setupSelect2">
                                        @foreach ($userCatalogue as $key => $item)
                                            <option
                                                {{ $key == old('user_catalogue_id', isset($user->user_catalogue_id) ? $user->user_catalogue_id : '') ? 'selected' : '' }}
                                                value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="birthday" class="control-label text-right">Ngày sinh</label>
                                    <input type="date" id="birthday" name="birthday"
                                        value="{{ old('birthday', isset($user->birthday) ? date('Y-m-d', strtotime($user->birthday)) : '') }}"
                                        class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        @if ($config['method'] == 'create')
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="password" class="control-label text-right">Mật khẩu <span
                                                class="text-danger">(*)</span></label>
                                        <input type="password" id="password" name="password" value=""
                                            class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="re_password" class="control-label text-right">Nhập lại mật khẩu
                                            <span class="text-danger">(*)</span></label>
                                        <input type="password" id="re_password" name="re_password" value=""
                                            class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="image" class="control-label text-right">Ảnh đại diện </label>
                                    <input type="text" id="image" name="image"
                                        value="{{ old('image', $user->image ?? '') }}" class="form-control input-image"
                                        autocomplete="off" data-upload="Images">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin liên hệ</div>
                    <div class="panel-descriptionb">
                        <p>-Nhập thông tin liên hệ của người sử dụng</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="inbox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="province_id" class="control-label text-right">Chọn thành phố <span
                                            class="text-danger">(*)</span></label>
                                    <select name="province_id" id="province_id"
                                        class="form-control setupSelect2 location province" data-target="districts">
                                        @if (isset($provinces))
                                            <option value="0">Chọn thành phố</option>
                                            @foreach ($provinces as $province)
                                                <option @if (old('province_id') == $province->code) selected @endif
                                                    value="{{ $province->code }}">{{ $province->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="district_id" class="control-label text-right">Quận/huyện<span
                                            class="text-danger">(*)</span></label>
                                    <select name="district_id" id="district_id"
                                        class="form-control districts setupSelect2 location" data-target="wards">
                                        <option value="0">Chọn Quận/huyện</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="ward_id" class="control-label text-right">Chọn Phường/Xã<span
                                            class="text-danger">(*)</span></label>
                                    <select name="ward_id" id="ward_id" class="form-control setupSelect2 wards">
                                        <option value="0">Phường/Xã</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="address" class="control-label text-right">Địa chỉ</label>
                                    <input type="text" id="address" name="address"
                                        value="{{ old('address') }}" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="phone" class="control-label text-right">Số điện thoại <span
                                            class="text-danger">(*)</span></label>
                                    <input type="text" id="phone" name="phone"
                                        value="{{ old('phone', $user->phone ?? '') }}" class="form-control"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="description" class="control-label text-right">Ghi chú</label>
                                    <input type="text" id="description" name="description"
                                        value="{{ old('description', $user->description ?? '') }}"
                                        class="form-control" autocomplete="off">
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
    var province_id = '{{ isset($user->province_id) ? $user->province_id : old('province_id') }}'
    var district_id = '{{ isset($user->district_id) ? $user->district_id : old('district_id') }}'
    var ward_id = '{{ isset($user->ward_id) ? $user->ward_id : old('ward_id') }}'
</script>
