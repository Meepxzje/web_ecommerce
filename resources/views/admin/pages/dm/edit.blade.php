@extends('admin.index')
@section('title', 'Sửa Danh mục')
@section('dm(edit)')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h1 mb-2 text-gray-800">Sửa Danh mục</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form id="editForm" method="POST" action="{{ route('admin.updatedm', ['id' => $dm->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="ten">Tên Danh mục</label>
                    <input type="text" class="form-control" id="ten" name="ten" value="{{ $dm->ten }}">
                </div>
                <div class="mb-3">
                        <label for="danhmuc" class="form-label">Danh mục cha:</label>
                        <select name="dmcha" class="form-control form-control-sm">
                            <option value="">Không</option>
                            @foreach($dmcha as $i)
                            <option value="{{ $i->id }}">{{ $i->ten }}</option>
                            @endforeach
                        </select>
                    </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </div>
</div>

@endsection
