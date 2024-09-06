@extends('admin.index')
@section('title', 'Danh mục')
@section('dm(index)')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Danh mục</h1>
    <div class="mb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
            Thêm mới
        </button>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Danh mục</th>
                            <th>Tên Danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dm as $i)
                        @if($i->parentid == null)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>
                                {{ $i->ten }}
                            </td>
                            <td style="width:500px;">
                                @if($dm->where('parentid', $i->id)->count() > 0)
                                <span class="toggle-button">
                                    <button class="btn btn-secondary" id="toggle-button-{{ $i->id }}" onclick="toggleSubcategories('{{ $i->id }}')">Xem danh mục con</button>
                                </span>
                                @endif
                                <a href="{{ route('admin.editdm', ['id' => $i->id]) }}" class="btn btn-info">Sửa</a>
                                <a href="{{ route('admin.deletedm', ['id' => $i->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                            </td>
                        </tr>
                        @foreach($dm->where('parentid', $i->id) as $subcategory)
                        <tr class="subcategory-row" id="subcategory-{{ $i->id }}">
                            <td></td>
                            <td>ID: {{ $subcategory->id }}, {{ $subcategory->ten }}</td>
                            <td>
                                <a href="{{ route('admin.editdm', ['id' => $subcategory->id]) }}" class="btn btn-info">Sửa</a>
                                <a href="{{ route('admin.deletedm', ['id' => $subcategory->id]) }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>

                </table>


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Thêm mới Danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addForm" method="post" action="{{ route('admin.storedm') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="ten">Tên Danh mục</label>
                        <input type="text" class="form-control" id="ten" name="ten">
                    </div>
                    <div class="mb-3">
                        <label for="danhmuc" class="form-label">Danh mục cha:</label>
                        <select name="dmcha" class="form-control form-control-sm">
                            <option value="">Không</option>
                            @foreach($dmcha as $item)
                            <option value="{{ $item->id }}">{{ $item->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .subcategory-row {
        display: none;
        padding-left: 20px;
    }

    .subcategory-row.show {
        display: table-row;

    }

    .toggle-button {
        cursor: pointer;
        color: #007bff;
    }
</style>

<script>
    function toggleSubcategories(parentId) {
        var rows = document.querySelectorAll('#subcategory-' + parentId);
        var toggleButton = document.querySelector('#toggle-button-' + parentId);

        rows.forEach(row => {
            if (row.style.display === 'table-row') {
                row.style.display = 'none';
                toggleButton.textContent = 'Xem danh mục con';
            } else {
                row.style.display = 'table-row';
                toggleButton.textContent = 'Ẩn danh mục con';
            }
        });
    }
</script>


@if(session('suc'))
<div id="alertBox" class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
    {{ session('suc') }}
</div>

<script>
    setTimeout(function() {
        $('#alertBox').alert('close');
    }, 5000);
</script>
@php
session()->forget('suc');
@endphp
@endif
@if(session('err'))
<div id="alertBox" class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
    {{ session('err') }}
</div>
<script>
    setTimeout(function() {
        $('#alertBox').alert('close');
    }, 5000);
</script>
@php
session()->forget('err');
@endphp
@endif
@endsection
