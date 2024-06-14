<form action="{{ route('user.index') }}">
    <div class="filter">
        <div class="uk-flex uk-flex-space-between">
            <div class="perpage">
                @php
                    $perpage = request('perpage') ?: old('perpage');
                @endphp
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <select name="perpage" class="form-control perpage filter mr10" id="">
                        @for ($i = 20; $i <= 200; $i += 20)
                            <option {{ $perpage == $i ? 'selected' : '' }} value="{{ $i }}">
                                {{ $i }}
                                bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="action">
                <div class="uk-flex">
                    @php
                        $publish = request('publish') ?: old('publish');
                    @endphp
                    <select name="publish" class="form-control setupSelect2">
                        @foreach (config('apps.general.publish') as $key => $val)
                            <option {{ $publish == $key ? 'selected' : '' }} value="{{ $key }}">
                                {{ $val }}</option>
                        @endforeach
                    </select>
                    <select name="user_catalogue_id" class="form-control setupSelect2">
                        <option value="0" selected="selected">Chọn Nhóm Thành Viên</option>
                        <option value="1">Quản trị viên</option>
                    </select>
                    <div class="uk-search mr10">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ request('keyword') ?: old('keyword') }}"
                                placeholder="Nhập từ khóa bạn muốn tìm kiếm ..." class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" name="search" value="search" class="btn btn-primary">Tìm
                                    kiếm</button>
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('user.create') }} " class="btn btn-danger"><i class="fa fa-plus"> Thêm mới thành
                            viên</i></a>
                </div>
            </div>
        </div>
    </div>
</form>
